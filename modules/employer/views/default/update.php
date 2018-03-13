<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Partner */

$this->title = Yii::t('app', 'update');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'My profile'), 'url' => ['/employer/profile']];
$this->params['breadcrumbs'][] = Yii::t('app', 'update');
?>
<div class="partner-update">

    <?= $this->render('_form', [
      'model' => $model,
      'users'=> $users,
    ]) ?>

</div>
