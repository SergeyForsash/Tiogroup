<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\crm\WorkerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="worker-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'full_name') ?>

    <?= $form->field($model, 'gender') ?>

    <?= $form->field($model, 'birth_date') ?>

    <?= $form->field($model, 'citizenship') ?>

    <?php // echo $form->field($model, 'legal_location') ?>

    <?php // echo $form->field($model, 'polish_location') ?>

    <?php // echo $form->field($model, 'pass_number') ?>

    <?php // echo $form->field($model, 'date_of_issue') ?>

    <?php // echo $form->field($model, 'date_of_expiration') ?>

    <?php // echo $form->field($model, 'pass_supplier') ?>

    <?php // echo $form->field($model, 'have_visa') ?>

    <?php // echo $form->field($model, 'visa_type') ?>

    <?php // echo $form->field($model, 'visa_expiration') ?>

    <?php // echo $form->field($model, 'visa_days') ?>

    <?php // echo $form->field($model, 'resident_certificate') ?>

    <?php // echo $form->field($model, 'degree') ?>

    <?php // echo $form->field($model, 'profession') ?>

    <?php // echo $form->field($model, 'specialisation') ?>

    <?php // echo $form->field($model, 'degree_specialisation') ?>

    <?php // echo $form->field($model, 'mobile_number') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'polish_knowledge') ?>

    <?php // echo $form->field($model, 'driver_license') ?>

    <?php // echo $form->field($model, 'driver_category') ?>

    <?php // echo $form->field($model, 'active') ?>

    <?php // echo $form->field($model, 'pass_scan') ?>

    <?php // echo $form->field($model, 'visa_scan') ?>

    <?php // echo $form->field($model, 'resume') ?>

    <?php // echo $form->field($model, 'addition_certificate') ?>

    <?php // echo $form->field($model, 'image') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'smoke') ?>

    <?php // echo $form->field($model, 'steal') ?>

    <?php // echo $form->field($model, 'team_work') ?>

    <?php // echo $form->field($model, 'punctuality') ?>

    <?php // echo $form->field($model, 'work_behave') ?>

    <?php // echo $form->field($model, 'employer_opinion') ?>

    <?php // echo $form->field($model, 'alcohol') ?>

    <?php // echo $form->field($model, 'drugs') ?>

    <?php // echo $form->field($model, 'is_healthy') ?>

    <?php // echo $form->field($model, 'medical_board') ?>

    <?php // echo $form->field($model, 'insurance') ?>

    <?php // echo $form->field($model, 'number_period') ?>

    <?php // echo $form->field($model, 'is_working') ?>

    <?php // echo $form->field($model, 'working_status') ?>

    <?php // echo $form->field($model, 'working_agreement_start') ?>

    <?php // echo $form->field($model, 'working_agreement') ?>

    <?php // echo $form->field($model, 'employer') ?>

    <?php // echo $form->field($model, 'polish_number') ?>

    <?php // echo $form->field($model, 'ident') ?>

    <?php // echo $form->field($model, 'agency_name') ?>

    <?php // echo $form->field($model, 'statusarchive') ?>

    <?php // echo $form->field($model, 'date_agreeded') ?>

    <?php // echo $form->field($model, 'date_start') ?>

    <?php // echo $form->field($model, 'date_finish') ?>

    <?php // echo $form->field($model, 'type_pay') ?>

    <?php // echo $form->field($model, 'rate') ?>

    <?php // echo $form->field($model, 'payed') ?>

    <?php // echo $form->field($model, 'summaagency') ?>

    <?php // echo $form->field($model, 'payedagency') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
