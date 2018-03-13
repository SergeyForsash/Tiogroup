<?php

/* @var $this yii\web\View */

$this->title = 'Главная';
?>
<div class="site-index">

    <div class="jumbotron text-center">
        <h1>Здравствуйте, <?= app\models\crm\User::getUserName(['id'=>Yii::$app->user->id]) ?>!</h1>

        <p class="lead">Вы вошли в нашу систему как агентство. Вы можете перейти к списку своих работников по ссылке ниже</p>

        <p><a class="btn btn-lg btn-success" href="<?= \yii\helpers\Url::to(['/agency/worker']) ?>"><i class="fa fa-users"></i> Мои работники</a></p>

        <p class="lead">Или посмотреть доступные на данный момент вакансии</p>

        <p><a class="btn btn-lg btn-success" href="<?= \yii\helpers\Url::to(['/agency/vacancy']) ?>"><i class="fa fa-handshake-o"></i> Вакансии</a></p>
    </div>
</div>
