<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\crm\Massage */
/* @var $form yii\widgets\ActiveForm */
?>

    <?php $form = ActiveForm::begin([
      'id' => 'mymodel-form',
      'enableAjaxValidation' => true,
    ]); ?>
    <?= $form->field($model, 'content')->textarea(['rows' => 6,'value'=>'','placeholder' => 'ответить...'])->label(false) ?>
    <div class="form-group text-center">
        <?= Html::a('<i class="fa fa-check-circle"></i> Закрыть Тикет', ['close-tickets', 'id' => $models->id], ['class' => 'btn btn-success']) ?>
        <?= Html::submitButton('<i class="fa fa-paper-plane"></i> Отправить Сообщение', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
<div class="text-center">
  Закрыть тикет возможно  только после  исправления данных
</div>
</div>
