<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Partner */

$this->title = Yii::t('app', 'update').' '. $model->agency_name;
$this->params['breadcrumbs'][] = ['label' => 'Мой профиль', 'url' => ['/agency/profile']];
$this->params['breadcrumbs'][] = Yii::t('app', 'update');
?>
<div class="partner-update">

    <?= $this->render('_form', [
      'model' => $model,
      'users'=> $users,
    ]) ?>

</div>
