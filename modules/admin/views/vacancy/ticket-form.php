<?php
use yii\helpers\Url;
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
    <?= $form->field($model, 'subject')->textInput(['maxlength' => true,'placeholder' => 'Укажите причину'])->label(false) ?>
    <?= $form->field($model, 'content')->textarea(['rows' => 6,'value'=>'','placeholder' => 'Опишите причину возврата...'])->label(false) ?>
    <div class="form-group text-center">
        <?= Html::submitButton('<i class="fa fa-paper-plane"></i> Отправить', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
