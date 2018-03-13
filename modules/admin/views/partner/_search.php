<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PartnerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="partner-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'agency_name') ?>

    <?= $form->field($model, 'first_number') ?>

    <?= $form->field($model, 'second_number') ?>

    <?php // echo $form->field($model, 'legal_address') ?>

    <?php // echo $form->field($model, 'actual_address') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'second_email') ?>

    <?php // echo $form->field($model, 'director_name') ?>

    <?php // echo $form->field($model, 'license_number') ?>

    <?php // echo $form->field($model, 'agreement') ?>

    <?php // echo $form->field($model, 'image') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'ident') ?>

    <?php // echo $form->field($model, 'contact_name') ?>

    <?php // echo $form->field($model, 'web_site') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
