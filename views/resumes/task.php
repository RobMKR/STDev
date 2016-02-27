<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

if(Yii::$app->session->hasFlash('error')){
  echo "<div class='alert alert-danger'>".Yii::$app->session->getFlash('error')."</div>";
} else if (Yii::$app->session->hasFlash('success')){
  echo "<div class='alert alert-success'>".Yii::$app->session->getFlash('success')."</div>";

}

$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);
echo $form->field($model, 'firstname');
echo $form->field($model, 'lastname');
echo $form->field($model, 'keywords');
echo $form->field($model, 'file')->fileInput();
echo Html::submitButton('submit', ['class'=>'btn btn-submit']);
ActiveForm::end();
?>
<hr>
