<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\crm\search\VacancySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vacancy-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'company_id') ?>

    <?= $form->field($model, 'industry_id') ?>

    <?= $form->field($model, 'code') ?>

    <?= $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'title_pl') ?>

    <?php // echo $form->field($model, 'duties') ?>

    <?php // echo $form->field($model, 'duties_pl') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'description_pl') ?>

    <?php // echo $form->field($model, 'worker') ?>

    <?php // echo $form->field($model, 'city_id') ?>

    <?php // echo $form->field($model, 'sex') ?>

    <?php // echo $form->field($model, 'education_id') ?>

    <?php // echo $form->field($model, 'practice') ?>

    <?php // echo $form->field($model, 'practice_pl') ?>

    <?php // echo $form->field($model, 'polish_id') ?>

    <?php // echo $form->field($model, 'age_f') ?>

    <?php // echo $form->field($model, 'age_t') ?>

    <?php // echo $form->field($model, 'driver_id') ?>

    <?php // echo $form->field($model, 'o_requirements') ?>

    <?php // echo $form->field($model, 'ot_requirements') ?>

    <?php // echo $form->field($model, 'o_requirements_pl') ?>

    <?php // echo $form->field($model, 'ot_requirements_pl') ?>

    <?php // echo $form->field($model, 'hourinday') ?>

    <?php // echo $form->field($model, 'overtime') ?>

    <?php // echo $form->field($model, 'night_hours') ?>

    <?php // echo $form->field($model, 'working_days') ?>

    <?php // echo $form->field($model, 'number_shifts') ?>

    <?php // echo $form->field($model, 'drive_work') ?>

    <?php // echo $form->field($model, 'individual_means') ?>

    <?php // echo $form->field($model, 'work_clothes') ?>

    <?php // echo $form->field($model, 'work_shoes') ?>

    <?php // echo $form->field($model, 'work_other') ?>

    <?php // echo $form->field($model, 'work_other_pl') ?>

    <?php // echo $form->field($model, 'other_expenses') ?>

    <?php // echo $form->field($model, 'other_expenses_pl') ?>

    <?php // echo $form->field($model, 'turn_to') ?>

    <?php // echo $form->field($model, 'apartment') ?>

    <?php // echo $form->field($model, 'type_allocation') ?>

    <?php // echo $form->field($model, 'payment_ap') ?>

    <?php // echo $form->field($model, 'cost_living') ?>

    <?php // echo $form->field($model, 'number_people') ?>

    <?php // echo $form->field($model, 'bathroom') ?>

    <?php // echo $form->field($model, 'internet') ?>

    <?php // echo $form->field($model, 'kitchen') ?>

    <?php // echo $form->field($model, 'aliment') ?>

    <?php // echo $form->field($model, 'akord') ?>

    <?php // echo $form->field($model, 'hourly_rate') ?>

    <?php // echo $form->field($model, 'month_salary') ?>

    <?php // echo $form->field($model, 'payment_method') ?>

    <?php // echo $form->field($model, 'advance_option') ?>

    <?php // echo $form->field($model, 'billing_period') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
