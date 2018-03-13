<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\admin\City */

$this->title = Yii::t('app', 'Edit');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Мой профиль'), 'url' => ['default/profile']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="city-create">
    <?= $this->render('_form', [
        'model' => $model,
        'users'=> $users,
    ]) ?>

</div>
