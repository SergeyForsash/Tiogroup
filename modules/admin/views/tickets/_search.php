<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\crm\search\Tickets */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tickets-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'admin_id') ?>

    <?= $form->field($model, 'admin_name') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'user_name') ?>

    <?php // echo $form->field($model, 'subject') ?>

    <?php // echo $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'tickets_id') ?>

    <?php // echo $form->field($model, 'agency_id') ?>

    <?php // echo $form->field($model, 'vacancy_id') ?>

    <?php // echo $form->field($model, 'viewed_admin') ?>

    <?php // echo $form->field($model, 'viewed_user') ?>

    <?php // echo $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'time') ?>

    <?php // echo $form->field($model, 'users') ?>

    <?php // echo $form->field($model, 'del') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
