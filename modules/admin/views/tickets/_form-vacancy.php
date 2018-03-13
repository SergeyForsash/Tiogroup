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
        <?= Html::submitButton('<i class="fa fa-paper-plane"></i> Отправить', ['class' => 'btn btn-primary']) ?>
        <?php if ($models->status == '2') {?>
        <?= Html::a('<i class="fa fa-check-circle"></i> Закрыть Тикет', ['close-tickets-vacancy', 'id' => $models->id], ['class' => 'btn btn-success']) ?>
        <?php } ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
