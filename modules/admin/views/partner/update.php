<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Partner */

$this->title = Yii::t('app', 'update').' '. $model->agency_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Partner'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->agency_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'update');
?>
<div class="partner-update">

    <?= $this->render('_form', [
      'model' => $model,
      'users'=> $users,
    ]) ?>

</div>
