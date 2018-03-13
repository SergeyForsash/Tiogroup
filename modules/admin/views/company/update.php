<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\admin\Company */

$this->title = Yii::t('app', 'update').' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Companies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'update');
?>
<div class="company-update">

    <?= $this->render('_form', [
        'model' => $model,
        'users'=> $users,
    ]) ?>

</div>
