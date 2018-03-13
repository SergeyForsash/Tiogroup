<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\crm\StatusPay */

$this->title = Yii::t('app', 'create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Status Pays'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="status-pay-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
