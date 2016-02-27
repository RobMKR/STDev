<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Resumes;
use app\models\userForm;
use app\models\UploadForm;
use yii\web\UploadedFile;


class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    
    public function actionIndex()
    {
      $model = new Resumes();
      $model->setScenario('search');
      $data = [];
      if ($model->load(Yii::$app->request->post()) && $model->validate()){
        $customers = Resumes::find();
        if(!empty($model->firstname)){
            $customers->where(['like' , 'firstname' , $model->firstname]);
        }
        if(!empty($model->lastname)){
          $customers->where(['like' , 'lastname' , $model->lastname]);
        }
        if(!empty($model->keywords)){
          $customers->where(['like' , 'keywords' , $model->keywords]);
        }
      $data = $customers->asArray()->all();
      }

      return $this->render('search', [
          'model' => $model,
          'data' =>$data
      ]);
    }
}
