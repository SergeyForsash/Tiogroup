<?php

/* @var $this yii\web\View */

$this->title = 'Главная';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Здравствуйте, <?= app\models\crm\User::getUserName(['id'=>Yii::$app->user->id]) ?>!</h1>

        <p class="lead">Добро пожаловать в личный кабинет. Чтобы перейти к своему профилю перейдите по ссылке ниже</p>

        <p><a class="btn btn-lg btn-success" href="<?= \yii\helpers\Url::to(['/workers/default/profile']) ?>">Профиль</a></p>
    </div>
</div>
