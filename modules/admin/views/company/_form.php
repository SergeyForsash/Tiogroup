<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\crm\User;
use kartik\file\FileInput;
/* @var $this yii\web\View */
/* @var $model app\models\admin\Company */
/* @var $form yii\widgets\ActiveForm */
?>
<style media="screen">
  .file-input{
    width: 260px;
  }
</style>
<div class="company-form my-form">

  <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
        'fieldConfig' => [
            'horizontalCssClasses' => [
                'label' => 'col-sm-2',
                'wrapper' => 'col-sm-10',
                'error' => '',
                'hint' => '',
            ],
        ],
    ]); ?>

    <div class="hr-line-heads"></div>
    <?php if ($model->isNewRecord ){ ?>
      <?= $form->field($users, 'username')->textInput(['maxlength' => true])->label(Yii::t('app', 'user_id_p')) ; ?>
      <div class="hr-line-dashed"></div>

      <?= $form->field($users, 'password')->passwordInput([])->label(Yii::t('app', 'user_pass')) ?>
      <div class="hr-line-dashed"></div>
    <?php } else { ?>
      <?= $form->field($users, 'username')->textInput(['disabled'=>true,'maxlength' => true])->label(Yii::t('app', 'user_id_p')) ; ?>
      <div class="hr-line-dashed"></div>
    <?php } ?>

  <?= $form->field($model, 'status')->dropDownList([ 1 => Yii::t('app', 'actives'),0 => Yii::t('app', 'not active')]) ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'nip')->textInput(['maxlength' => true]) ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'firm_name')->textInput(['maxlength' => true]) ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'actual_address')->textInput(['maxlength' => true]) ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'regon')->textInput(['maxlength' => true]) ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'krs')->textInput(['maxlength' => true]) ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'phone_number')->textInput(['maxlength' => true]) ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'mobile_number')->textInput(['maxlength' => true]) ?>
    <div class="hr-line-dashed"></div>

    <?php if ($model->isNewRecord ){ ?>
    <?= $form->field($users, 'email')->textInput(['maxlength' => true]) ?>
    <div class="hr-line-dashed"></div>
    <?php }else{ ?>
      <?= $form->field($users, 'email')->textInput(['disabled'=>true, 'maxlength' => true]) ?>
      <div class="hr-line-dashed"></div>
    <?php } ?>

    <?= $form->field($model, 'director_name')->textInput(['maxlength' => true]) ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'website')->textInput(['maxlength' => true]) ?>
    <div class="hr-line-dashed"></div>

    <div style="height: 0px;">
        <?= $form->field($model, 'created_at')->hiddenInput(['value'=> $model->isNewRecord ? date('Y-m-d') : $model->created_at])->label(false) ?>

        <?= $form->field($model, 'updated_at')->hiddenInput(['value'=> $model->isNewRecord ? null : date('Y-m-d')])->label(false) ?>

        <?= $form->field($model, 'ident')->hiddenInput(['value'=> Yii::$app->user->id])->label(false) ?>

        <?= $form->field($users, 'type')->hiddenInput(['value'=> 1])->label(false) ?>
    </div>

   <?php
         echo $form->field($model, 'file')->widget(FileInput::classname(), [
           'pluginOptions' => [
             'showCaption' => false,
             'showRemove' => false,
             'showUpload' => false,
             'showClose' => false,
             'deleteUrl'=>'/admin/company/del-doc?id='.$model->id ,
             'browseClass' => 'btn btn-primary btn-block',
             'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
              'browseLabel' =>  Yii::t('app', 'Select file'),
              'initialPreview'=>$model->file == null ? false : $model->file,
              'initialPreviewAsData'=>true,
          ],
          'options' => ['accept' => 'image/*']
     ]);
   ?>
    <div class="hr-line-dashed"></div>

    <div class="form-group text-center">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
