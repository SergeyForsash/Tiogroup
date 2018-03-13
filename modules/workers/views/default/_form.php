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
use app\models\admin\Specialisation;
use app\models\admin\Profession;
use app\models\crm\User;
use app\models\crm\Worker;
use app\models\crm\Vacancy;
use kartik\date\DatePicker;
use kartik\file\FileInput;
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
$dataStatus = ArrayHelper::map(StatusWorker::find()->all(), 'id', 'title');
$dataPayType = ArrayHelper::map(PayType::find()->all(), 'id', 'title');
$dataIndustry =  ArrayHelper::map(Specialisation::find()->all(), 'id', 'title');
$dataVacancy = Vacancy::getVacancyId();
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
            'wrapper' => 'col-sm-7',
            'error' => '',
            'hint' => 'col-sm-2',
        ],
    ],
]); ?>
    <div class="form-group commentrequired"><strong>Поля, отмеченные <span style="color:red;">*</span>, обязательны для заполнения</strong></div>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'full_name')->textInput(['maxlength' => true])->hint('
    <div class="info-form-w">
    <a  data-toggle="popover" title="'.Yii::t('app', 'name_i').'" data-placement="top">
    <i class="fa fa-info-circle" style="font-size:25px"></i>
    </a></div>'); ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($users, 'email')->textInput(['maxlength' => true])->hint('
    <div class="info-form-w">
    <a  data-toggle="popover" title="'.Yii::t('app', 'email_i').'" data-placement="top">
    <i class="fa fa-info-circle" style="font-size:25px"></i>
    </a></div>'); ?>
    <div class="hr-line-dashed"></div>

    <?php if ($model->vacancy_id == 0 ){ ?>
    <?= $form->field($model, 'vacancy_id')->dropDownList($dataVacancy,[
      'prompt'=>[
        'text' =>Yii::t('app', 'Choose vacancy'),
        'options' =>['value'=>0],
        ],

      'onchange'=>'hideFormDeatils(this)',
      ])->label(Yii::t('app', 'Vacancy Id')) ->hint('
    <div class="info-form-w">
    <a  data-toggle="popover" title="'.Yii::t('app', 'vacancy_i').'" data-placement="top">
    <i class="fa fa-info-circle" style="font-size:25px"></i>
    </a></div>');?>
    <?php } else { ?>
    <?= $form->field($model, 'vacancy_id')->textInput(['disabled'=>true,'maxlength' => true])->label(Yii::t('app', 'Vacancy Id'))->hint('
    <div class="info-form-w">
    <a  data-toggle="popover" title="'.Yii::t('app', 'vacancy_i').'" data-placement="top">
    <i class="fa fa-info-circle" style="font-size:25px"></i>
    </a></div>'); ?>
    <?php } ?>
    <div class="hr-line-dashed"></div>
    <?php if ($model->vacancy_id == 0) {
      $styles_v ='display_none';
    }else {
      $styles_v ='';
    } ?>
<div id="FormDeatils" class="<?=$styles_v?>">
    <?= $form->field($model, 'ident')->textInput()->hint('
    <div class="info-form-w">
    <a data-toggle="popover" title="'.Yii::t('app', 'ident_i').'" data-placement="top">
    <i class="fa fa-info-circle" style="font-size:25px"></i>
    </a></div>') ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'gender')->dropDownList($dataGender,['prompt'=>Yii::t('app', 'Choose gender')])->hint('
    <div class="info-form-w">
    <a  data-toggle="popover" title="'.Yii::t('app', 'gender_i').'" data-placement="top">
    <i class="fa fa-info-circle" style="font-size:25px"></i>
    </a></div>'); ?>
    <div class="hr-line-dashed"></div>

    <div class="form-group field-worker-birth_date required">
        <?= DatePicker::widget([
            'model' => $model,
            'attribute' => 'birth_date',
            'language' => 'ru',
            'size' => 'md',
            'form' => $form,
            'removeButton' => false,
            'options' => ['placeholder' => Yii::t('app', 'Select a date')],
            'pluginOptions' => [
              'format' => 'yyyy-mm-dd',
              'autoclose' => true,
             ]
        ]);?>

       <div style="clear: left"></div>
       <div class="hr-line-dashed"></div>
    </div>

    <?=  $form->field($model, 'citizenship') ->dropDownList( $dataCitizenship, ['prompt'=>Yii::t('app', 'Choose citizenship')])->hint('
    <div class="info-form-w">
    <a  data-toggle="popover" title="'.Yii::t('app', 'citizenship_i').'" data-placement="top">
    <i class="fa fa-info-circle" style="font-size:25px"></i>
    </a></div>');; ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'legal_location')->textInput(['maxlength' => true])->hint('
    <div class="info-form-w">
    <a  data-toggle="popover" title="'.Yii::t('app', 'legal_location_i').'" data-placement="top">
    <i class="fa fa-info-circle" style="font-size:25px"></i>
    </a></div>'); ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'pass_number')->textInput(['maxlength' => true])->hint('
    <div class="info-form-w">
    <a  data-toggle="popover" title="'.Yii::t('app', 'pass_number_i').'" data-placement="top">
    <i class="fa fa-info-circle" style="font-size:25px"></i>
    </a></div>'); ?>
    <div class="hr-line-dashed"></div>

    <div class="form-group field-worker-'date_of_issue required">
         <?= DatePicker::widget([
             'model' => $model,
             'attribute' => 'date_of_issue',
             'language' => 'ru',
             'size' => 'md',
             'form' => $form,
             'removeButton' => false,
             'options' => ['placeholder' => Yii::t('app', 'Select a date')],
             'pluginOptions' => [
               'format' => 'yyyy-mm-dd',
               'autoclose' => true,
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
             'removeButton' => false,
             'options' => ['placeholder' => Yii::t('app', 'Select a date')],
             'pluginOptions' => [
               'format' => 'yyyy-mm-dd',
               'autoclose' => true,
              ]
         ]);?>
      <div style="clear: left"></div>
      <div class="hr-line-dashed"></div>
    </div>

    <?= $form->field($model, 'pass_supplier')->textInput(['maxlength' => true])->hint('
    <div class="info-form-w">
    <a  data-toggle="popover" title="'.Yii::t('app', 'pass_supplier_i').'" data-placement="top">
    <i class="fa fa-info-circle" style="font-size:25px"></i>
    </a></div>'); ?>
    <div class="hr-line-dashed"></div>

    <p class="h1 text-center"><?= Yii::t('app', 'Visa') ?> </p>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'have_visa')->dropDownList($dataHaveVisa,
      [
        'value'=>$model->isNewRecord ? 2 : $model->have_visa,
        'onchange'=>'hideVisaDeatils(this)',
      ])->hint('
      <div class="info-form-w">
      <a  data-toggle="popover" title="'.Yii::t('app', 'have_visa_i').'" data-placement="top">
      <i class="fa fa-info-circle" style="font-size:25px"></i>
      </a></div>'); ?>
      <?php if ($model->have_visa == 2) {
        $styles_v = 'display_none';
      }elseif($model->have_visa == null) {
        $styles_v = 'display_none';
      }else {
        $styles_v = '';
      } ?>
    <div class="hr-line-dashed"></div>



    <div id="VisaDeatils" class="<?=$styles_v?>">
      <?=  $form->field($model, 'visa_type') ->dropDownList( $dataVisaType, ['prompt'=>Yii::t('app', 'Choose VisaType')])->hint('
      <div class="info-form-w">
      <a  data-toggle="popover" title="'.Yii::t('app', 'visa_type_i').'" data-placement="top">
      <i class="fa fa-info-circle" style="font-size:25px"></i>
      </a></div>');; ?>
      <div class="hr-line-dashed"></div>

      <div class="form-group field-worker-visa_expiration">
        <label class="control-label col-sm-3" for="worker-visa_expiration"><?= Yii::t('app', 'Validity') ?></label>
        <div class="col-md-4">
          <?= DatePicker::widget([
              'model' => $model,
              'attribute' => 'visa_expiration',
              //'form' => $form,
              'options' => ['placeholder' => Yii::t('app', 'Age F')],
              'removeButton' => false,
              'pluginOptions' => [
                  'format' => 'yyyy-mm-dd',
                  'autoclose' => true,
              ]
             ]);?>
        </div>
        <div class="col-md-4">
          <?= DatePicker::widget([
              'model' => $model,
              'attribute' => 'visa_expiration_to',
              //'form' => $form,
              'options' => ['placeholder' => Yii::t('app', 'Age T')],
              'removeButton' => false,
              'pluginOptions' => [
                  'format' => 'yyyy-mm-dd',
                  'autoclose' => true,
              ]
             ]);?>
        </div>
        <div style="clear: left"></div>
        <div class="hr-line-dashed"></div>
      </div>

      <?= $form->field($model, 'visa_days')->textInput(['maxlength' => true])->hint('
      <div class="info-form-w">
      <a  data-toggle="popover" title="'.Yii::t('app', 'visa_days_i').'" data-placement="top">
      <i class="fa fa-info-circle" style="font-size:25px"></i>
      </a></div>'); ?>
      <div class="hr-line-dashed"></div>

      <?= $form->field($model, 'resident_certificate')->dropDownList($dataHaveVisa,['value'=>2])->hint('
      <div class="info-form-w">
      <a  data-toggle="popover" title="'.Yii::t('app', 'resident_certificate_i').'" data-placement="top">
      <i class="fa fa-info-circle" style="font-size:25px"></i>
      </a></div>'); ?>
      <div class="hr-line-dashed"></div>
    </div>

    <p class="h1 text-center"><?= Yii::t('app', 'Personal data') ?> </p>
    <div class="hr-line-dashed"></div>


    <?= $form->field($model, 'degree')->dropDownList($dataDegree) ->hint('
    <div class="info-form-w">
    <a  data-toggle="popover" title="'.Yii::t('app', 'degree_i').'" data-placement="top">
    <i class="fa fa-info-circle" style="font-size:25px"></i>
    </a></div>');?>
    <div class="hr-line-dashed"></div>

    <?php if ($model->specialisation == null) {
      $specialisation = 11;
      $profession = '';
      $styles_s = 'display_none';
      $dataProfession =  ArrayHelper::map(Profession::find()->all(), 'id', 'title');
    }else{
      if ($model->specialisation !==11) {
        $dataProfession =  ArrayHelper::map(Profession::find()->where(['spec_id'=>$model->specialisation])->all(), 'id', 'title');
        $specialisation = $model->specialisation;
        $profession = explode(";", $model->profession);
        $styles_s = '';
      }else{
        $dataProfession =  ArrayHelper::map(Profession::find()->all(), 'id', 'title');
        $specialisation = 11;
        $profession = '';
        $styles_s = 'display_none';
      }
    }?>
    <?= $form->field($model, 'specialisation')->dropDownList($dataIndustry,  [
        'value'=>$model->isNewRecord ? 11 : $specialisation,
        'prompt'=>Yii::t('app', 'Choose industry'),
        'onchange'=>'$.post( "'.Url::toRoute('worker/prof-list?id=').'"+$(this).val(), function( data ) {
        $( "#titl" ).html( data );});hideSpecialDeatils(this)'
      ])->hint('
      <div class="info-form-w">
      <a  data-toggle="popover" title="'.Yii::t('app', 'specialisation_i').'" data-placement="top">
      <i class="fa fa-info-circle" style="font-size:25px"></i>
      </a></div>'); ?>
    <div class="hr-line-dashed"></div>
    <div id="SpecialDeatils" class="<?=$styles_s?>">
    <?= $form->field($model, 'profession[]')->checkboxList($dataProfession,['value'=>$profession ,'id'=>'titl','multiple' => 'multiple'])->hint('
    <div class="info-form-w">
    <a  data-toggle="popover" title="'.Yii::t('app', 'profession_i').'" data-placement="top">
    <i class="fa fa-info-circle" style="font-size:25px"></i>
    </a></div>'); ?>
    <div class="hr-line-dashed"></div>
    </div>
    <?= $form->field($model, 'mobile_number')->textInput(['maxlength' => true])->hint('
    <div class="info-form-w">
    <a data-toggle="popover" title="'.Yii::t('app', 'mobile_number_i').'" data-placement="top">
    <i class="fa fa-info-circle" style="font-size:25px"></i>
    </a></div>'); ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'polish_knowledge')->dropDownList($dataPolish,['value'=>$model->isNewRecord ? 1 : $model->polish_knowledge,])->hint('
    <div class="info-form-w">
    <a  data-toggle="popover" title="'.Yii::t('app', 'polish_knowledge_i').'" data-placement="top">
    <i class="fa fa-info-circle" style="font-size:25px"></i>
    </a></div>'); ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'driver_license')->dropDownList($dataHaveVisa,[
      'value'=>$model->isNewRecord ? 2 : $model->driver_license,
      'onchange'=>'hideDriverDeatils(this)',
    ])->hint('
    <div class="info-form-w">
    <a  data-toggle="popover" title="'.Yii::t('app', 'driver_license_i').'" data-placement="top">
    <i class="fa fa-info-circle" style="font-size:25px"></i>
    </a></div>');  ?>
    <?php if ($model->driver_license == 2) {
      $styles_d = 'display_none';
    }elseif($model->driver_license  == null) {
      $styles_d = 'display_none';
    }else {
      $styles_d = '';
    } ?>
    <div class="hr-line-dashed"></div>

    <div id="DriverDeatils" class="<?=$styles_d?>">
      <?php
      if ($model->driver_category !== null) {
        $driver_c = explode(";", $model->driver_category);
      }else {
        $driver_c = '';
      }
       ?>
      <?= $form->field($model, 'driver_category[]')->checkboxList($dataDriver,['value'=>$driver_c,'multiple' => 'multiple','labelOptions' => [
          'style' => 'padding-left:20px;'
      ],]); ?>
      <div class="hr-line-dashed"></div>
    </div>

    <p class="h1 text-center"><?= Yii::t('app', 'Attachments') ?> </p>
    <div class="hr-line-dashed"></div>

   <?php
        echo $form->field($model, 'pass_scan')->widget(FileInput::classname(), [
            'pluginOptions' => [
               'showCaption' => false,
               'showRemove' => false,
               'showUpload' => false,
               'showClose' => false,
               'showDragHandle' => false,
               'browseClass' => 'btn btn-primary btn-block',
               'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
               'browseLabel' =>  Yii::t('app', 'Select pass_scan'),
                'initialPreview'=> $model->pass_scan == null ? false : $model->pass_scan,
                'initialPreviewAsData'=>true,
                'deleteUrl'=>'/agency/worker/del-doc?id='.$model->id.'&type=1' ,


           ],
           'options' => ['accept' => 'image/*']
    ])->hint('
    <div class="info-form-w">
    <a data-toggle="popover" title="'.Yii::t('app', 'pass_scan_i').'" data-placement="top">
    <i class="fa fa-info-circle" style="font-size:25px"></i>
    </a></div>');;
  ?>
  <div class="hr-line-dashed"></div>

  <?php
        echo $form->field($model, 'visa_scan')->widget(FileInput::classname(), [

          'pluginOptions' => [
            'showCaption' => false,
            'showRemove' => false,
            'showUpload' => false,
            'showClose' => false,
            'showDragHandle' => false,
            'deleteUrl'=>'/agency/worker/del-doc?id='.$model->id.'&type=2' ,
            'browseClass' => 'btn btn-primary btn-block',
            'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
             'browseLabel' =>  Yii::t('app', 'Select visa_scan'),
             'initialPreview'=>$model->visa_scan == null ? false : $model->visa_scan,
             'initialPreviewAsData'=>true,
         ],
         'options' => ['accept' => 'image/*']
    ])->hint('
    <div class="info-form-w">
    <a data-toggle="popover" title="'.Yii::t('app', 'visa_scan_i').'" data-placement="top">
    <i class="fa fa-info-circle" style="font-size:25px"></i>
    </a></div>');;
  ?>
  <div class="hr-line-dashed"></div>

  <?php
        echo $form->field($model, 'resume')->widget(FileInput::classname(), [
          'pluginOptions' => [
            'showCaption' => false,
            'showRemove' => false,
            'showUpload' => false,
            'showClose' => false,
            'showDragHandle' => false,
            'deleteUrl'=>'/agency/worker/del-doc?id='.$model->id.'&type=3' ,
            'browseClass' => 'btn btn-primary btn-block',
            'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
             'browseLabel' =>  Yii::t('app', 'Select resume'),
             'initialPreview'=> $model->resume == null ? false : $model->resume,
             'initialPreviewAsData'=>true,
         ],

    ])->hint('
    <div class="info-form-w">
    <a data-toggle="popover" title="'.Yii::t('app', 'resume_i').'" data-placement="top">
    <i class="fa fa-info-circle" style="font-size:25px"></i>
    </a></div>');;
  ?>
  <div class="hr-line-dashed"></div>

  <?php
        echo $form->field($model, 'addition_certificate')->widget(FileInput::classname(), [
          'pluginOptions' => [
            'showCaption' => false,
            'showRemove' => false,
            'showUpload' => false,
            'showClose' => false,
            'showDragHandle' => false,
            'deleteUrl'=>'/agency/worker/del-doc?id='.$model->id.'&type=4' ,
            'browseClass' => 'btn btn-primary btn-block',
            'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
             'browseLabel' =>  Yii::t('app', 'Select certif'),
             'initialPreview'=>$model->addition_certificate == null ? false : $model->addition_certificate,
             'initialPreviewAsData'=>true,
         ],
         'options' => ['accept' => 'image/*']
    ])->hint('
    <div class="info-form-w">
    <a data-toggle="popover" title="'.Yii::t('app', 'addition_certificate_i').'" data-placement="top">
    <i class="fa fa-info-circle" style="font-size:25px"></i>
    </a></div>');;
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
            'deleteUrl'=>'/agency/worker/del-doc?id='.$model->id.'&type=5' ,
            'browseClass' => 'btn btn-primary btn-block',
            'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
             'browseLabel' =>  Yii::t('app', 'Select image'),
             'initialPreview'=>$model->image == null ? false : $model->image,
             'initialPreviewAsData'=>true,
         ],
         'options' => ['accept' => 'image/*']
    ])->hint('
    <div class="info-form-w">
    <a data-toggle="popover" title="'.Yii::t('app', 'image_i').'" data-placement="top">
    <i class="fa fa-info-circle" style="font-size:25px"></i>
    </a></div>');;
  ?>
  <div class="hr-line-dashed"></div>
</div>
    <div class="form-group text-center">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$js = <<< 'SCRIPT'
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();
});
SCRIPT;
$this->registerJs($js);
 ?>
<script>
  function hideFormDeatils(obj) {
  var label = obj.value;
  if(label == '0') document.getElementById('FormDeatils').classList.add("display_none");
          else document.getElementById('FormDeatils').classList.remove("display_none");
  }
  hideVisaDeatils(document.getElementById('worker-form_chois'));

  hideVisaDeatils(document.getElementById('worker-visa_chois'));
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

  function hideSpecialDeatils(obj) {
  var label = obj.value;
  if(label == '11') document.getElementById('SpecialDeatils').classList.add("display_none");
          else document.getElementById('SpecialDeatils').classList.remove("display_none");
  }
  hideSpecialDeatils(document.getElementById('worker-specialisation_chois'));

</script>
