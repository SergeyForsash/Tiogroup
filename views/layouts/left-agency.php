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

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                  ['label' => 'Menu', 'options' => ['class' => 'header']],
                  ['label' => 'Главная', 'icon' => 'home', 'url' => ['/'],],
                  ['label' => 'Мои тикеты', 'icon' => 'sticky-note', 'url' => ['/agency/tickets'],],
                  ['label' => 'Мои сообщения', 'icon' => 'envelope', 'url' => ['/agency/massage'],],
                  ['label' => 'Вакансии', 'icon' => 'handshake-o', 'url' => ['/agency/vacancy'],],
                  ['label' => 'Мои работники', 'icon' => 'users', 'url' => ['/agency/worker'],],
                  ['label' => 'Мой профиль', 'icon' => 'id-card', 'url' => ['/agency/profile'],],
                  ['label' => 'История действий', 'icon' => 'history', 'url' => ['/agency/default/history'],],
                ]
            ]
        ) ?>

    </section>

</aside>
