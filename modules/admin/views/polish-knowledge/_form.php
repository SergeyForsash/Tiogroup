<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\admin\PolishKnowledge */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="polish-knowledge-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="panel panel-default">
      <div class="panel-body">
        <div class="col-md-6">
          <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
          <?= $form->field($model, 'title_pl')->textInput(['maxlength' => true]) ?>
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
