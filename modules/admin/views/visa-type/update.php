<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\admin\VisaType */

$this->title = Yii::t('app', 'update').' '. $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Visa Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'update');
?>
<div class="visa-type-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
