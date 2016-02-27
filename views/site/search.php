<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<h1 align="center">Search</h1>
<?php
$search = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);
echo $search->field($model, 'firstname');
echo $search->field($model, 'lastname');
echo $search->field($model, 'keywords');
echo Html::submitButton('Search', ['class'=>'btn btn-submit']);
ActiveForm::end();?>
<div class="container">
    <div class="row">
      <h2 align='center'  style="padding-bottom:50px">Search Results</h2>
        <table class="table">
          <thead>
            <tr>
              <th>Firstname</th>
              <th>Lastname</th>
              <th>Keywords</th>
              <th>Url</th>
            </tr>
          </thead>
          <?php foreach($data as $cv): ?>
          <tbody>
            <tr>
              <td><?=$cv["firstname"]?></td>
              <td><?=$cv["lastname"]?></td>
              <td><?=$cv["keywords"]?></td>
              <td><a href="resumes/download?file=<?=$cv['url']?>">Download CV</a></td>
            </tr>
                  </tbody>
          <?php endforeach; ?>
        </table>
    </div>
</div>
