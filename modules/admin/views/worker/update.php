<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\crm\Worker */

$this->title = Yii::t('app', 'update').' '. $model->full_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Workers_a'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->full_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'update');
?>
<div class="worker-update">
    <?= $this->render('_form', [
        'model' => $model,
        'users'=> $users,
    ]) ?>

</div>
