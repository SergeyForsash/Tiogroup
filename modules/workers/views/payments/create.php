<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\crm\Payments */

$this->title = Yii::t('app', 'create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Payments M'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payments-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
