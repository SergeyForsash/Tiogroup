<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\crm\Payments */
/* @var $form yii\widgets\ActiveForm */
$dataMonth = ArrayHelper::map(app\models\admin\Month::find()->all(), 'id', 'title');

?>
<style media="screen">
  .no-error .help-block{
    display: none !important;
  }
</style>
<?php
    $this->registerJs(
        '$("document").ready(function(){
            $("#payments_note").on("pjax:end", function() {
            $.pjax.reload({container:"#payments"});  //Reload GridView
        });
    });'
    );
?>
<div class="payments-form">
<?php Pjax::begin(['id' => 'payments_note']) ?>
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'user_id')->hiddenInput(['value'=>$model->isNewRecord ? $user_id : $model->user_id ])->label(false) ?>
    <?= $form->field($model, 'company_id')->hiddenInput(['value'=> $model->isNewRecord ? $company_id : $model->company_id ])->label(false) ?>
    <?= $form->field($model, 'vacancy_name')->hiddenInput(['value'=>$model->isNewRecord ? $vacancy : $model->vacancy_name])->label(false) ?>
    <?= $form->field($model, 'vacancy_name_pl')->hiddenInput(['value'=> $model->isNewRecord ? $vacancy_pl : $model->vacancy_name_pl])->label(false) ?>
<div class="col-md-3">
  <?= $form->field($model, 'month_id')->dropDownList($dataMonth,['prompt'=>Yii::t('app', 'Choose month')]) ?>
</div>
<div class="col-md-2">
  <?= $form->field($model, 'hours')->textInput(['maxlength' => true,'onchange'=>'addition();']) ?>
</div>
<div class="col-md-2">
  <?= $form->field($model, 'rate')->textInput(['maxlength' => true,'onchange'=>'addition();']) ?>
</div>
<div class="col-md-2">
  <?= $form->field($model, 'total')->textInput(['maxlength' => true]) ?>
</div>
<div class="col-md-3">
  <div class="form-group" style="margin-top: 25px;">
      <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create')  : Yii::t('app', 'Update') , ['class' => $model->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-primary btn-block']) ?>
  </div>
</div>
    <?php ActiveForm::end(); ?>
<?php Pjax::end(); ?>
</div>
<script>

function addition() {
  var a = parseInt(document.getElementById('payments-hours').value);
  var b = parseInt(document.getElementById('payments-rate').value);

  if (isNaN(a)==true) a=0;
  if (isNaN(b)==true) b=0;

  var c = a * b;

  document.getElementById('payments-total').value = + c;
}
</script>
