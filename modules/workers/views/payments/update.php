<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\crm\Payments */

$this->title = Yii::t('app', 'update').' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Payments M'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'update');
?>
<div class="payments-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
