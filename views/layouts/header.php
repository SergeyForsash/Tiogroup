<?php
use yii\helpers\Html;
use app\models\crm\User;
use app\components\MassageWidget;
use app\components\TicketsWidget;
/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header" style="position: fixed !important;width: 100% !important;">

    <?= Html::a('<span class="logo-mini">TG</span><span class="logo-lg"> <img src="/uploads/logo.png" width="150" > </span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              <?= TicketsWidget::widget() ?>
              <!-- Messages: style can be found in dropdown.less-->
              <?= MassageWidget::widget() ?>
              <!-- User Account: style can be found in dropdown.less -->
                <?php if (!Yii::$app->getUser()->isGuest):?>
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="user-image" alt="User Image"/>
                        <span class="hidden-xs"><?= User::getUserName(['id'=>Yii::$app->user->id]) ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle"
                                 alt="User Image"/>

                            <p>
                                <?= User::getUserName(['id'=>Yii::$app->user->id]) ?> | <?= User::getUserType(['id'=>Yii::$app->user->id]) ?>
                                <small><?= Yii::t('app', 'Date_Register') .User::getUserDate(['id'=>Yii::$app->user->id]) ?></small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="text-center">
                                <?= Html::a(
                                    Yii::t('app', 'Sign out'),
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>
              <?php endif ?>
                <!-- User Account: style can be found in dropdown.less -->
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>

    </nav>
</header>
