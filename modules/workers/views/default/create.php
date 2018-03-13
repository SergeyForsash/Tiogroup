<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\crm\Worker */

$this->title = 'Создание профиля';
$this->params['breadcrumbs'][] = ['label' => 'Мой профиль', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="worker-create">
    <?= $this->render('_form', [
        'model' => $model,
        'users'=> $users,
    ]) ?>

</div>
