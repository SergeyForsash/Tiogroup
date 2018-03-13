<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\admin\City;
use app\models\admin\VisaType;
use app\models\admin\PayType;
use app\models\admin\Degree;
use app\models\admin\StatusWorker;
use app\models\admin\PolishKnowledge;
use app\models\admin\DriverCategory;
use app\models\admin\Specialisation;
use app\models\crm\Vacancy;
use kartik\date\DatePicker;
use kartik\file\FileInput;
/* @var $this yii\web\View */
/* @var $model app\models\crm\Worker */
/* @var $form yii\widgets\ActiveForm */
$dataIndustry =  ArrayHelper::map(Specialisation::find()->all(), 'id', 'title');
$status = Vacancy::getStatus();
$dataChoose = Vacancy::getChoose();
$dataChooses = Vacancy::getChooses();
$dataGender = Vacancy::getGender();
$dataApartment = Vacancy::getApartment();
$dataPaymentAp = Vacancy::getPaymentAp();
$dataNumberPeople = Vacancy::getNumberPeople();
$dataTypeApartment = Vacancy::getTypeApartment();
$dataPaymentMethod = Vacancy::getPaymentMethod();
$dataBillingPeriod = Vacancy::getBillingPeriod();
$dataWorkingDays = Vacancy::getWorkingDays();
$dataNumberShifts = Vacancy::getNumberShifts();
$dataCity = ArrayHelper::map(City::find()->all(), 'id', 'title');
$dataVisaType = ArrayHelper::map(VisaType::find()->all(), 'id', 'title');
$dataDegree = ArrayHelper::map(Degree::find()->all(), 'id', 'title');
$dataPolish = ArrayHelper::map(PolishKnowledge::find()->all(), 'id', 'title');
$dataDriver = ArrayHelper::map(DriverCategory::find()->all(), 'id', 'title');
$dataStatus = ArrayHelper::map(StatusWorker::find()->all(), 'id', 'title');
$dataPayType = ArrayHelper::map(PayType ::find()->all(), 'id', 'title');
?>

  <div class="vacancy-form my-form">

    <?php $form = ActiveForm::begin([
      'options' => ['enctype' => 'multipart/form-data'],
      'layout' => 'horizontal',
      'fieldConfig' => [
          'horizontalCssClasses' => [
              'label' => 'col-sm-4',
              'wrapper' => 'col-sm-7',
              'error' => '',
              'hint' => '',
          ],
      ],
  ]); ?>
  <ul class="nav nav-tabs nav-justified">
    <li class="active"><a data-toggle="tab" href="#step_1"><strong>Информация</strong></a></li>
    <li class=""><a data-toggle="tab" href="#step_2"><strong>Требование</strong></a></li>
    <li class=""><a data-toggle="tab" href="#step_3"><strong>Условия</strong></a></li>
    <li class=""><a data-toggle="tab" href="#step_4"><strong>Проживание </strong></a></li>
    <li class=""><a data-toggle="tab" href="#step_5"><strong>Оплата </strong></a></li>
  </ul>
  <div class="tab-content">
    <div id="step_1" class="tab-pane fade in active">
    <p class="h3 text-center info-h"><?= Yii::t('app', 'GENERAL INFORMATION') ?> </p>
    <div class="form-group commentrequired text-center"><strong>
      <?=Yii::t('app', 'Fields marked with') ?> <span style="color:red;">*</span>,
      <?=Yii::t('app', 'Are required') ?></strong></div>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'status')->dropDownList($status,['value'=>$model->status]) ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'industry_id')->dropDownList($dataIndustry,['prompt'=>Yii::t('app', 'Choose industry')]) ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'title_pl')->textInput(['disabled'=>true,'maxlength' => true]) ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'duties_pl')->textInput(['disabled'=>true,'maxlength' => true]) ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'duties')->textInput(['maxlength' => true]) ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'description_pl')->textarea(['disabled'=>true,'rows' => 6]) ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'video')->textInput() ?>
    <div class="hr-line-dashed"></div>

    <?php
          echo $form->field($model, 'image')->widget(FileInput::classname(), [
            'pluginOptions' => [
              'showCaption' => false,
              'showRemove' => false,
              'showUpload' => false,
              'showClose' => false,
              'showDragHandle' => false,
              'deleteUrl'=>'/admin/vacancy/del-doc?id='.$model->id,
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

    <?= $form->field($model, 'worker')->textInput() ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'city_id')->dropDownList($dataCity,['value'=>$model->city_id,'prompt'=>Yii::t('app', 'Choose city')]) ?>
    <div class="hr-line-dashed"></div>

    <div class="text-center"> Шаг 1 из 5 </div>
    <div class="hr-line-dashed"></div>

    </div>
    <div id="step_2" class="tab-pane fade">

    <p class="h3 text-center info-h"><?= Yii::t('app', 'REQUIREMENTS (to the employee)') ?> </p>
    <div class="form-group commentrequired text-center"><strong><?=Yii::t('app', 'Fields marked with') ?> <span style="color:red;">*</span>, <?=Yii::t('app', 'Are required') ?></strong></div>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'sex')->dropDownList($dataGender,['value'=>$model->sex,'prompt'=>Yii::t('app', 'Choose gender')]) ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'education_id')
    ->dropDownList($dataDegree,['value'=>$model->education_id,'prompt'=>Yii::t('app', 'Choose education')]) ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'practice_pl')->textInput(['disabled'=>true,'maxlength' => true]) ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'practice')->textInput(['maxlength' => true]) ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'polish_id')->dropDownList($dataPolish,['value'=>$model->polish_id,'prompt'=>Yii::t('app', 'Choose polish')]) ?>
    <div class="hr-line-dashed"></div>

   <div class="form-group field-vacancy-age required">
     <label class="control-label col-sm-3" for="vacancy-education_id"><?= Yii::t('app', 'Age') ?></label>
    <div class="col-md-2">
       <?= $form->field($model, 'age_f')->textInput(['placeholder' => Yii::t('app', 'Age F')])->label(false) ?>
    </div>
    <div class="col-md-2">
       <?= $form->field($model, 'age_t')->textInput(['placeholder' => Yii::t('app', 'Age T')])->label(false)  ?>
    </div>
   </div>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'driver_license')->dropDownList($dataChoose,[
      'value'=>$model->driver_license,
      'onchange'=>'hideDriverLicense(this)',
    ])  ?>
    <?php if ($model->driver_license == 2) {
      $styles = 'display_none';
    }else {
      $styles = '';
    } ?>
    <div class="hr-line-dashed"></div>

    <div id="DriverLicense" class="<?=$styles?>">
      <?php
      $driver_c = explode(";", $model->driver_id);
       ?>
        <?= $form->field($model, 'driver_id[]')->checkboxList($dataDriver,['value'=>$driver_c]); ?>
        <div class="hr-line-dashed"></div>
    </div>

    <?= $form->field($model, 'other_permissions')->dropDownList($dataChoose,[
      'value'=>$model->other_permissions,
      'onchange'=>'hideOtherPermissions(this)',
    ])?>
    <div class="hr-line-dashed"></div>
    <div id="OtherPermissions">

    <?= $form->field($model, 'o_requirements_pl')->textInput(['disabled'=>true,'maxlength' => true]) ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'o_requirements')->textInput(['maxlength' => true]) ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'ot_requirements_pl')->textarea(['disabled'=>true,'rows' => 6]) ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'ot_requirements')->textarea(['rows' => 6]) ?>
    <div class="hr-line-dashed"></div>

    </div>

    <div class="text-center"> Шаг 2 из 5 </div>
    <div class="hr-line-dashed"></div>

    </div>
    <div id="step_3" class="tab-pane fade">

    <p class="h3 text-center info-h"><?= Yii::t('app', 'WORKING CONDITIONS') ?> </p>
    <div class="form-group commentrequired text-center"><strong><?=Yii::t('app', 'Fields marked with') ?> <span style="color:red;">*</span>, <?=Yii::t('app', 'Are required') ?></strong></div>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'hourinday')->textInput() ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'overtime')->dropDownList($dataChoose,['value'=>$model->overtime])  ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'night_hours')->dropDownList($dataChoose,['value'=>$model->night_hours])  ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'working_days')
    ->dropDownList($dataWorkingDays,['value'=>$model->working_days,'prompt'=>Yii::t('app', 'Choose quantity')]) ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'number_shifts')
    ->dropDownList($dataNumberShifts,['value'=>$model->number_shifts,'prompt'=>Yii::t('app', 'Choose quantity')]) ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'drive_work')->dropDownList($dataChooses,['value'=>$model->drive_work]) ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'individual_means')->dropDownList($dataChooses,[
      'value'=>$model->individual_means,
      'onchange'=>'hideIndividual(this)',
    ]) ?>
    <div class="hr-line-dashed"></div>
    <div id="Individual">
    <?= $form->field($model, 'work_clothes')->dropDownList($dataChoose,['value'=>$model->work_clothes]) ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'work_shoes')->dropDownList($dataChoose,['value'=>$model->work_shoes]) ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'work_other_pl')->textarea(['disabled'=>true,'rows' => 6]) ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'work_other')->textarea(['rows' => 6]) ?>
    <div class="hr-line-dashed"></div>

    </div>

    <?= $form->field($model, 'other_expenses_pl')->textarea(['disabled'=>true,'rows' => 6]) ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'other_expenses')->textarea(['rows' => 6]) ?>
    <div class="hr-line-dashed"></div>

    <div class="form-group field-vacancy-turn_to required ">
         <?= DatePicker::widget([
             'model' => $model,
             'attribute' => 'turn_to',
             'form' => $form,
             'removeButton' => false,
             'pluginOptions' => [
                 'format' => 'yyyy-mm-dd',
                 'autoclose' => true,
             ]
            ]);?>
    </div>
    <div class="hr-line-dashed"></div>

    <div class="text-center"> Шаг 3 из 5 </div>
    <div class="hr-line-dashed"></div>

  </div>
  <div id="step_4" class="tab-pane fade">

    <p class="h3 text-center info-h"><?= Yii::t('app', 'LIVING CONDITIONS') ?> </p>
    <div class="form-group commentrequired text-center"><strong><?=Yii::t('app', 'Fields marked with') ?> <span style="color:red;">*</span>, <?=Yii::t('app', 'Are required') ?></strong></div>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'apartment')->dropDownList($dataApartment, [
      'value'=>$model->apartment,
      'onchange'=>'hideApartment(this)',
    ]) ?>
    <?php if($model->apartment == 1){
      $styles_a = 'display_none';
    }else {
      $styles_a = '';
    } ?>
    <div class="hr-line-dashed"></div>
    <div id="Apartment" class="<?=$styles_a?>">
    <?= $form->field($model, 'type_allocation')
    ->dropDownList($dataTypeApartment,['value'=>$model->type_allocation,'prompt'=>Yii::t('app', 'Choose type')]) ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'payment_ap')->dropDownList($dataPaymentAp, [
      'value'=>$model->payment_ap,
      'onchange'=>'hidePaymentAp(this)',
    ]) ?>
    <?php if($model->apartment == 1){
      $styles_p = 'display_none';
    }else {
      $styles_p = '';
    } ?>
    <div class="hr-line-dashed"></div>
    <div id="PaymentAp" class="<?=$styles_p?>">
    <?= $form->field($model, 'cost_living')->textInput(['maxlength' => true]) ?>
    <div class="hr-line-dashed"></div>
    </div>

    <?= $form->field($model, 'number_people')->dropDownList($dataNumberPeople, ['value'=>$model->number_people]) ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'bathroom')->dropDownList($dataChoose,['value'=>$model->bathroom]) ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'internet')->dropDownList($dataChoose,['value'=>$model->internet]) ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'kitchen')->dropDownList($dataChoose,['value'=>$model->kitchen]) ?>
    <div class="hr-line-dashed"></div>
    </div>

    <?= $form->field($model, 'aliment')->dropDownList($dataChoose,['value'=>$model->aliment]) ?>
    <div class="hr-line-dashed"></div>

    <div class="text-center"> Шаг 4 из 5 </div>
    <div class="hr-line-dashed"></div>

    </div>
    <div id="step_5" class="tab-pane fade">

    <p class="h3 text-center info-h"><?= Yii::t('app', 'WAGE') ?> </p>
    <div class="form-group commentrequired text-center"><strong><?=Yii::t('app', 'Fields marked with') ?> <span style="color:red;">*</span>, <?=Yii::t('app', 'Are required') ?></strong></div>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'akord')->dropDownList($dataChoose,['value'=>$model->akord])  ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'hourly_rate')->textInput() ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'month_salary')->textInput() ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'payment_method')->dropDownList($dataPaymentMethod,['value'=>$model->payment_method]) ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'advance_option')->dropDownList($dataChoose,['value'=>$model->advance_option]) ?>
    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'billing_period')->dropDownList($dataBillingPeriod ,['value'=>$model->billing_period,'prompt'=>Yii::t('app', 'Choose billing_p')])  ?>
    <div class="hr-line-dashed"></div>

    <div class="text-center"> Шаг 5 из 5 </div>
    <div class="hr-line-dashed"></div>

    </div>
</div>

    <div class="form-group">
      <div class="form-group text-center">
          <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
      </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script>
  function hideDriverLicense(obj) {
  var label = obj.value;
  if(label == '2') document.getElementById('DriverLicense').classList.add("display_none");
          else document.getElementById('DriverLicense').classList.remove("display_none");
  }
  hideDriverLicense(document.getElementById('vacancy-driverL_license'));

  function hideOtherPermissions(obj) {
  var label = obj.value;
  if(label == '2') document.getElementById('OtherPermissions').classList.add("display_none");
          else document.getElementById('OtherPermissions').classList.remove("display_none");
  }
  hideOtherPermissions(document.getElementById('vacancy-other_permissions'));

  function hideIndividual(obj) {
  var label = obj.value;
  if(label == '3') document.getElementById('Individual').classList.remove("display_none");
            else document.getElementById('Individual').classList.add("display_none");
  }
  hideIndividual(document.getElementById('vacancy-individual_means'));

  function hideApartment(obj) {
  var label = obj.value;
  if(label == '1') document.getElementById('Apartment').classList.add("display_none");
          else document.getElementById('Apartment').classList.remove("display_none");
  }
  hideApartment(document.getElementById('vacancy-apartment'));

  function hidePaymentAp(obj) {
  var label = obj.value;
  if(label == '2') document.getElementById('PaymentAp').classList.add("display_none");
          else document.getElementById('PaymentAp').classList.remove("display_none");
  }
  hidePaymentAp(document.getElementById('vacancy-payment_ap'));
</script>
