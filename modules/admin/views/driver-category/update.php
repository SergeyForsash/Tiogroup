<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\admin\DriverCategory */

$this->title = Yii::t('app', 'update').' '. $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Driver Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'update');
?>
<div class="driver-category-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
