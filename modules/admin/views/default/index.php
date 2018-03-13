<?php

/* @var $this yii\web\View */

$this->title = 'Главная';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Здравствуйте, <?= app\models\crm\User::getUserName(['id'=>Yii::$app->user->id]) ?> !</h1>

        <p class="lead">Добро пожаловать в панель управления агентской системой. Чтобы перейти к списку партнеров перейдите по ссылке ниже</p>

        <p><a class="btn btn-lg btn-success" href="<?= \yii\helpers\Url::to(['partner/index']) ?>">Агентства - партнеры</a></p>
    </div>
</div>
