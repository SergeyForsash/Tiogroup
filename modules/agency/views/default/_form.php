<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\file\FileInput;
$this->title = 'Мой профиль';
?>

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

    <?= $form->field($model, 'agency_name')->textInput(['class'=>' form-control','value' => $model->agency_name]); ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'first_number')->textInput(['class'=>' form-control','value' => $model->first_number]); ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'second_number')->textInput(['class'=>' form-control','value' => $model->second_number]); ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'legal_address')->textInput(['class'=>' form-control','value' => $model->legal_address]); ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'actual_address')->textInput(['class'=>' form-control','value' => $model->actual_address]); ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'second_email')->textInput(['class'=>' form-control','value' => $model->second_email]); ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'director_name')->textInput(['class'=>' form-control','value' => $model->director_name]);?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'license_number')->textInput(['class'=>' form-control','value' => $model->license_number]);?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'contact_name')->textInput(['class'=>' form-control','value' => $model->contact_name]); ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'web_site')->textInput(['class'=>' form-control','value' => $model->web_site]); ?>
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
               'initialPreviewAsData'=>true,
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
