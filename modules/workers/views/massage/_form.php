<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\crm\Massage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="massage-form">
  <?php $form = ActiveForm::begin(); ?>
      <?= $form->field($model, 'subject')->textInput(['maxlength' => true,'placeholder' => 'Тема сообщения'])->label(false) ?>
      <?= $form->field($model, 'content')->textarea(['rows' => 6,'value'=>'','placeholder' => 'Начните набирать собщение...'])->label(false) ?>
  <div class="form-group text-center">
      <?= Html::submitButton('<i class="fa fa-paper-plane"></i> Отправить', ['class' => 'btn btn-primary']) ?>
      <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
  </div>
    <?php ActiveForm::end(); ?>
</div>
