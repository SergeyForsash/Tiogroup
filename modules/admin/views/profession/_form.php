<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\admin\Specialisation;
/* @var $this yii\web\View */
/* @var $model app\models\admin\Profession */
/* @var $form yii\widgets\ActiveForm */
$dataSpecialisation = ArrayHelper::map(Specialisation::find()->all(), 'id', 'title');
?>

<div class="profession-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="panel panel-default">
      <div class="panel-body">
        <div class="col-md-4">
          <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
          <?= $form->field($model, 'title_pl')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
          <?= $form->field($model, 'spec_id')->dropDownList($dataSpecialisation,['value'=>0])  ?>
        </div>
        <div class="col-md-12">
          <div class="form-group text-center">
              <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
          </div>
        </div>
      </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
