<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\admin\Month */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="month-form">

    <?php $form = ActiveForm::begin(); ?>
<div class="col-md-4">
  <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
</div>
<div class="col-md-4">
  <?= $form->field($model, 'title_pl')->textInput(['maxlength' => true]) ?>
</div>
    <div class="col-md-4">
      <div class="form-group" style="margin-top:26px;">
          <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary btn-block']) ?>
      </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
