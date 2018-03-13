<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\admin\Citizenship;
use app\models\admin\VisaType;
use app\models\admin\Degree;
use app\models\admin\PolishKnowledge;
use app\models\admin\DriverCategory;
use app\models\crm\User;
use app\models\crm\Worker;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\crm\Worker */
/* @var $form yii\widgets\ActiveForm */
$dataHaveVisa =  Worker::getChoose();
$dataGender =  Worker::getGender();
$dataCitizenship = ArrayHelper::map(Citizenship::find()->all(), 'id', 'title');
$dataVisaType = ArrayHelper::map(VisaType::find()->all(), 'id', 'title');
$dataDegree = ArrayHelper::map(Degree::find()->all(), 'id', 'title');
$dataPolish = ArrayHelper::map(PolishKnowledge::find()->all(), 'id', 'title');
$dataDriver = ArrayHelper::map(DriverCategory::find()->all(), 'id', 'title');

if ($model->statusarchive == 5) {
    $statys_1 = '5';
    $statys_2 = '6';
    $disab = false;
  }elseif($model->statusarchive ==6){
    $statys_1 = '6';
    $statys_2 = '7';
    $disab = false;
  }elseif($model->statusarchive ==7){
    $statys_1 = '7';
    $statys_2 = '8';
    $disab = false;
  }elseif($model->statusarchive == 8) {
    $statys_1 = '8';
    $statys_2 = '';
    $disab = true;
  }else {
    $statys_1 = '';
    $statys_2 = '';
    $disab = true;
  }
$dataStatus =   ArrayHelper::map(app\models\admin\StatusWorker::find()
->where(['id'=>$statys_1])
->orWhere(['id'=>$statys_2])
->all(), 'id', 'title');
?>

<div class="worker-form my-form">

  <?php $form = ActiveForm::begin([
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
  <?php if ($model->statusarchive >= 5  && $model->statusarchive < 100) { ?>
  <?= $form->field($model, 'statusarchive')->dropDownList( $dataStatus, ['disabled'=>$disab,
    'value'=>$model->statusarchive,'onchange'=>'$.post( "'.Url::toRoute('/workers/default/statuse?id=').'"+$(this).val(), function( data ) {location.reload();});'
  ]); ?>
  <div class="hr-line-dashed"></div>
  <?php } ?>
  <?= $form->field($model, 'ident')->textInput(['disabled'=>true,'maxlength' => true])->label(Yii::t('app', 'ident_w')) ?>
  <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'full_name')->textInput(['disabled'=>true,'maxlength' => true]) ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'email')->textInput(['disabled'=>true,'maxlength' => true]) ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'gender')->dropDownList($dataGender,['disabled'=>true,'prompt'=>Yii::t('app', 'Choose gender')]) ?>
    <div class="hr-line-dashed"></div>

    <div class="form-group field-worker-birth_date required">
        <?= DatePicker::widget([
            'model' => $model,
            'attribute' => 'birth_date',
            'language' => 'ru',
            'size' => 'md',
            'form' => $form,
            'disabled'=>true,
            'removeButton' => false,
            'options' => ['placeholder' => Yii::t('app', 'Select a date')],
            'pluginOptions' => [
                 'autoclose'=>true
             ]
        ]);?>
       <div style="clear: left"></div>
       <div class="hr-line-dashed"></div>
    </div>

    <?=  $form->field($model, 'citizenship') ->dropDownList( $dataCitizenship, ['disabled'=>true,'prompt'=>Yii::t('app', 'Choose citizenship')]); ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'legal_location')->textInput(['disabled'=>true,'maxlength' => true]) ?>
    <div class="hr-line-dashed"></div>



    <?= $form->field($model, 'pass_number')->textInput(['disabled'=>true,'maxlength' => true]) ?>
    <div class="hr-line-dashed"></div>

    <div class="form-group field-worker-'date_of_issue required">
         <?= DatePicker::widget([
             'model' => $model,
             'attribute' => 'date_of_issue',
             'language' => 'ru',
             'size' => 'md',
             'form' => $form,
             'disabled'=>true,
             'removeButton' => false,
             'options' => ['placeholder' => Yii::t('app', 'Select a date')],
             'pluginOptions' => [
                  'autoclose'=>true
              ]
         ]);?>
      <div style="clear: left"></div>
      <div class="hr-line-dashed"></div>
    </div>

    <div class="form-group field-worker-date_of_expiration required">
         <?= DatePicker::widget([
             'model' => $model,
             'attribute' => 'date_of_expiration',
             'language' => 'ru',
             'size' => 'md',
             'form' => $form,
             'disabled'=>true,
             'removeButton' => false,
             'options' => ['placeholder' => Yii::t('app', 'Select a date')],
             'pluginOptions' => [
                  'autoclose'=>true
              ]
         ]);?>
      <div style="clear: left"></div>
      <div class="hr-line-dashed"></div>
    </div>

    <?= $form->field($model, 'pass_supplier')->textInput(['disabled'=>true,'maxlength' => true]) ?>
    <div class="hr-line-dashed"></div>

    <p class="h1 text-center"><?= Yii::t('app', 'Visa') ?> </p>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'have_visa')->dropDownList($dataHaveVisa,
      [
        'value'=>2,
        'onchange'=>'hideVisaDeatils(this)',
        'disabled'=>true,
      ]) ?>
    <div class="hr-line-dashed"></div>



    <div id="VisaDeatils" class="display_none">
      <?=  $form->field($model, 'visa_type') ->dropDownList( $dataVisaType, ['disabled'=>true,'prompt'=>Yii::t('app', 'Choose VisaType')]); ?>
      <div class="hr-line-dashed"></div>

      <div class="form-group field-worker-visa_expiration">
           <?= DatePicker::widget([
               'model' => $model,
               'attribute' => 'visa_expiration',
               'language' => 'ru',
               'size' => 'md',
               'form' => $form,
               'disabled'=>true,
               'removeButton' => false,
               'options' => ['placeholder' => Yii::t('app', 'Select a date')],
               'pluginOptions' => [
                    'autoclose'=>true
                ]
           ]);?>

        <div style="clear: left"></div>
        <div class="hr-line-dashed"></div>
      </div>

      <?= $form->field($model, 'visa_days')->textInput(['disabled'=>true,'maxlength' => true]) ?>
      <div class="hr-line-dashed"></div>

      <?= $form->field($model, 'resident_certificate')->dropDownList($dataHaveVisa,['disabled'=>true,'value'=>2]) ?>
      <div class="hr-line-dashed"></div>
    </div>

    <p class="h1 text-center"><?= Yii::t('app', 'Personal data') ?> </p>
    <div class="hr-line-dashed"></div>


    <?= $form->field($model, 'degree')->dropDownList($dataDegree,['disabled'=>true,]) ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'profession')->textInput(['disabled'=>true,]) ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'specialisation')->textInput(['disabled'=>true,]) ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'mobile_number')->textInput(['disabled'=>true,'maxlength' => true]) ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'polish_knowledge')->dropDownList($dataPolish,['disabled'=>true,'value'=>1]) ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'driver_license')->dropDownList($dataHaveVisa,[
      'value'=>2,
      'onchange'=>'hideDriverDeatils(this)',
      'disabled'=>true,
    ])  ?>
    <div class="hr-line-dashed"></div>

    <div id="DriverDeatils" class="display_none">
      <?= $form->field($model, 'driver_category')->checkboxList($dataDriver,['labelOptions' => [
          'style' => 'padding-left:20px;'
      ],]); ?>
      <div class="hr-line-dashed"></div>
    </div>

    <p class="h1 text-center"><?= Yii::t('app', 'Attachments') ?> </p>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'pass_scan')->fileInput(['disabled'=>true,]) ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'visa_scan')->fileInput(['disabled'=>true,]) ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'resume')->fileInput(['disabled'=>true,]) ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'addition_certificate')->fileInput(['disabled'=>true,]) ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'image')->fileInput(['disabled'=>true,])?>
    <div class="hr-line-dashed"></div>


    <?php ActiveForm::end(); ?>

</div>
<script>
  function hideVisaDeatils(obj) {
  var label = obj.value;
  if(label == '2') document.getElementById('VisaDeatils').classList.add("display_none");
          else document.getElementById('VisaDeatils').classList.remove("display_none");
  }
  hideVisaDeatils(document.getElementById('worker-visa_chois'));

  function hideDriverDeatils(obj) {
  var label = obj.value;
  if(label == '2') document.getElementById('DriverDeatils').classList.add("display_none");
          else document.getElementById('DriverDeatils').classList.remove("display_none");
  }
  hideDriverDeatils(document.getElementById('driver-visa_chois'));

</script>
