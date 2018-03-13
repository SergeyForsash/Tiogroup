<?php
use app\models\crm\User;
 ?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <?php if (!Yii::$app->getUser()->isGuest):?>

            <div class="pull-left info">
                <p><?= User::getUserName(['id'=>Yii::$app->user->id]) ?> </p>
                <p>
                  <span class="label label-info" style="margin-top:2px"><?= User::getUserType(['id'=>Yii::$app->user->id]) ?></span>
                </p>
            </div>
          <?php endif ?>
        </div>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                  'items' => [
                    ['label' => 'Menu', 'options' => ['class' => 'header']],
                    ['label' => 'Главная', 'icon' => 'home', 'url' => ['/'],],
                    ['label' => 'Мои тикеты', 'icon' => 'sticky-note', 'url' => ['/workers/tickets'],],
                    ['label' => 'Мои сообщения', 'icon' => 'envelope', 'url' => ['/workers/massage'],],
                    ['label' => 'Вакансии', 'icon' => 'id-card', 'url' => ['/workers/vacancy'],],
                    ['label' => 'Мои Расчёты', 'icon' => 'id-card', 'url' => ['/workers/payments'],],
                    ['label' => 'Мой профиль', 'icon' => 'id-card', 'url' => ['/workers/default/profile'],],
                    ['label' => 'История действий', 'icon' => 'history', 'url' => ['/workers/'],],
                  ]
            ]
        ) ?>

    </section>

</aside>
