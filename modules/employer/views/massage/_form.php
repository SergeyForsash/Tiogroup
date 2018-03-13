<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\crm\Massage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="massage-form">
  <?php $form = ActiveForm::begin(); ?>
      <?= $form->field($model, 'subject')->textInput(['maxlength' => true,'placeholder' => Yii::t('app', 'Тема сообщения')])->label(false) ?>
      <?= $form->field($model, 'content')->textarea(['rows' => 6,'value'=>'','placeholder' => Yii::t('app', 'Начните набирать сообщение...')])->label(false) ?>
  <div class="form-group text-center">
      <?= Html::submitButton('<i class="fa fa-paper-plane"></i> '.Yii::t('app', 'Отправить'), ['class' => 'btn btn-primary']) ?>
      <button type="button" class="btn btn-default" data-dismiss="modal">Zamknij</button>
  </div>
    <?php ActiveForm::end(); ?>
</div>
