<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\crm\User;
use kartik\file\FileInput;
?>
<style media="screen">
  .file-input{
    width: 260px;
  }
</style>
<div class="partner-form my-form">

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
    <?= Html::errorSummary($model)?>
    <div class="hr-line-heads"></div>
    <?php if ($model->isNewRecord ){ ?>
      <?= $form->field($users, 'username')->textInput(['maxlength' => true])->label(Yii::t('app', 'user_id_p')) ; ?>
      <div class="hr-line-dashed"></div>

      <?= $form->field($users, 'password')->passwordInput()->label(Yii::t('app', 'user_pass')) ?>
      <div class="hr-line-dashed"></div>
    <?php } else { ?>
      <?= $form->field($users, 'username')->textInput(['disabled'=>true,'maxlength' => true])->label(Yii::t('app', 'user_id_p')) ; ?>
      <div class="hr-line-dashed"></div>
    <?php } ?>

    <?= $form->field($model, 'status')->dropDownList([ 1 => Yii::t('app', 'actives'),0 => Yii::t('app', 'not active')]) ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'agency_name')->textInput(['maxlength' => true]) ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'first_number')->textInput(['maxlength' => true]) ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'second_number')->textInput(['maxlength' => true]) ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'legal_address')->textInput(['maxlength' => true]) ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'actual_address')->textInput(['maxlength' => true]) ?>
    <div class="hr-line-dashed"></div>

    <?php if ($model->isNewRecord ){ ?>
    <?= $form->field($users, 'email')->textInput(['maxlength' => true]) ?>
    <div class="hr-line-dashed"></div>
    <?php }else{ ?>
      <?= $form->field($users, 'email')->textInput(['disabled'=>true, 'maxlength' => true]) ?>
      <div class="hr-line-dashed"></div>
    <?php } ?>

    <?= $form->field($model, 'second_email')->textInput(['maxlength' => true]) ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'director_name')->textInput(['maxlength' => true]) ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'license_number')->textInput(['maxlength' => true]) ?>
    <div class="hr-line-dashed"></div>

<div style="height: 0px;">
    <?= $form->field($model, 'created_at')->hiddenInput(['value'=> $model->isNewRecord ? date('Y-m-d') : $model->created_at])->label(false) ?>

    <?= $form->field($model, 'updated_at')->hiddenInput(['value'=> $model->isNewRecord ? null : date('Y-m-d')])->label(false) ?>

    <?= $form->field($model, 'ident')->hiddenInput(['value'=> Yii::$app->user->id])->label(false) ?>

    <?= $form->field($users, 'type')->hiddenInput(['value'=> 2])->label(false) ?>

</div>

    <?= $form->field($model, 'contact_name')->textInput(['maxlength' => true]) ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'web_site')->textInput(['maxlength' => true]) ?>
    <div class="hr-line-dashed"></div>

    <?php
          echo $form->field($model, 'agreement')->widget(FileInput::classname(), [
            //'uploadUrl'=>"/file-upload-batch/1",
            'pluginOptions' => [
              'showCaption' => false,
              'showRemove' => false,
              'showUpload' => false,
              'showClose' => false,
              'showDragHandle' => false,
              'deleteUrl'=>'/admin/partner/del-doc?id='.$model->id.'&type=1' ,
              'browseClass' => 'btn btn-primary btn-block',
              'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
               'browseLabel' =>  Yii::t('app', 'Select agreement'),
               'initialPreview'=>$model->agreement == null ? false : $model->agreement,
               //'initialPreview'=>['http://kartik-v.github.io/bootstrap-fileinput-samples/samples/SampleDOCFile_100kb.doc',],
               'initialPreviewAsData'=>true,
               'initialPreviewConfig'=> [
                ['type' =>"office", 'size'=> '100', 'caption'=> 'dog_17_01_2018_user_id41.doc', 'url'=> '/uploads/dogovor_partner/', 'key'=> 4],

   ],
           ],
           //'options' => ['accept' => 'image/*']
      ]);
    ?>
    <div class="hr-line-dashed"></div>

    <?php
          echo $form->field($model, 'image')->widget(FileInput::classname(), [
            'pluginOptions' => [
              'showCaption' => false,
              'showRemove' => false,
              'showUpload' => false,
              'showClose' => false,
              'showDragHandle' => false,
              'deleteUrl'=>'/admin/partner/del-doc?id='.$model->id.'&type=2' ,
              'browseClass' => 'btn btn-primary btn-block',
              'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
               'browseLabel' =>  Yii::t('app', 'Select image'),
               'initialPreview'=>$model->image == null ? false : $model->image,
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
