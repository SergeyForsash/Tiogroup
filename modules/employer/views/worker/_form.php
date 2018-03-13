<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\admin\Citizenship;
use app\models\admin\VisaType;
use app\models\admin\PayType;
use app\models\admin\Degree;
use app\models\admin\StatusWorker;
use app\models\admin\PolishKnowledge;
use app\models\admin\DriverCategory;
use app\models\crm\User;
use app\models\admin\Specialisation;
use app\models\admin\Profession;
use app\models\crm\Worker;
use app\models\crm\Vacancy;
use kartik\date\DatePicker;
use kartik\file\FileInput;
/* @var $this yii\web\View */
/* @var $model app\models\crm\Worker */
/* @var $form yii\widgets\ActiveForm */
$dataHaveVisa =  Worker::getChoose();
?>
<style media="screen">
  .file-input{
    width: 260px;
  }
</style>

<div class="worker-form my-form">

  <?php $form = ActiveForm::begin([
    'options' => ['enctype' => 'multipart/form-data'],
    'layout' => 'horizontal',
    'fieldConfig' => [
        'horizontalCssClasses' => [
            'label' => 'col-sm-3',
            'wrapper' => 'col-sm-8',
            'error' => '',
            'hint' => '',
        ],
    ],
]); ?>


    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'smoke')->dropDownList($dataHaveVisa,['value'=>$model->smoke]) ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'steal')->dropDownList($dataHaveVisa,['value'=>$model->steal]) ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'team_work')->dropDownList($dataHaveVisa,['value'=>$model->team_work])  ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'punctuality')->dropDownList($dataHaveVisa,['value'=>$model->punctuality]) ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'work_behave')->textInput(['maxlength' => true]) ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'employer_opinion')->textInput(['maxlength' => true])  ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'alcohol')->dropDownList($dataHaveVisa,['value'=>$model->alcohol]) ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'drugs')->dropDownList($dataHaveVisa,['value'=>$model->drugs])  ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'is_healthy')->dropDownList($dataHaveVisa,['value'=>$model->is_healthy]) ?>
    <div class="hr-line-dashed"></div>

    <?php
          echo $form->field($model, 'medical_board')->widget(FileInput::classname(), [
            'pluginOptions' => [
              'showCaption' => false,
              'showRemove' => false,
              'showUpload' => false,
              'showClose' => false,
              'showDragHandle' => false,
              'deleteUrl'=>'/employer/worker/del-doc?id='.$model->id.'&type=6' ,
              'browseClass' => 'btn btn-primary btn-block',
              'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
               'browseLabel' =>  Yii::t('app', 'Select image'),
               'initialPreview'=>$model->medical_board == null ? false : $model->medical_board,
               'initialPreviewAsData'=>true,
           ],
           'options' => ['accept' => 'image/*']
      ]);
    ?>
    <div class="hr-line-dashed"></div>

    <?php
          echo $form->field($model, 'insurance')->widget(FileInput::classname(), [
            'pluginOptions' => [
              'showCaption' => false,
              'showRemove' => false,
              'showUpload' => false,
              'showClose' => false,
              'showDragHandle' => false,
              'deleteUrl'=>'/employer/worker/del-doc?id='.$model->id.'&type=7' ,
              'browseClass' => 'btn btn-primary btn-block',
              'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
               'browseLabel' =>  Yii::t('app', 'Select image'),
               'initialPreview'=>$model->insurance == null ? false : $model->insurance,
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
