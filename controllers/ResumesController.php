<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Resumes;
use yii\web\UploadedFile;

class ResumesController extends Controller {
  public function actionDownload() {
    $file = Yii::$app->request->get()['file'];


    if (file_exists($file)) {

    Yii::$app->response->sendFile($file);

    }
  }

  public function actionAdd()
  {
    $model = new Resumes();
    $model->setScenario('insert');
    if ($model->load(Yii::$app->request->post()) && $model->validate()){
      if($_FILES['Resumes']['name']['file']!=''){
        Yii::$app->session->setFlash('success', 'You have already attached your CV');
        $model->file = UploadedFile::getInstance($model, 'file');
        $filepath = 'uploads/CV_'.$model->id.'_'.$model->firstname."_".$model->lastname.".".$model->file->extension;
        $model->url = $filepath;
        $model->save();
        $model->file->saveAs($filepath);

      } else {
        Yii::$app->session->setFlash('error', 'You haven\'t chosen the file to upload');
      }

    }

    return $this->render('task', [
        'model' => $model,
    ]);
  }
}
