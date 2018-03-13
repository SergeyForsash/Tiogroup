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
                    ['label' => 'Strona główna', 'icon' => 'home', 'url' => ['/'],],
                    ['label' => 'Moje zadania', 'icon' => 'sticky-note', 'url' => ['/employer/tickets'],],
                    ['label' => 'Moje wiadomości', 'icon' => 'envelope', 'url' => ['/employer/massage'],],
                    ['label' => 'Oferty Pracy', 'icon' => 'handshake-o', 'url' => ['/employer/vacancy'],],
                    ['label' => 'Moi pracownicy', 'icon' => 'users', 'url' => ['/employer/worker'],],
                    [
                        'label' => 'Moje rachunki',
                        'icon' => 'money',
                        'url' => '#',
                        'items' => [
                          ['label' => 'Pracownicy', 'icon' => 'file-text','url' => ['/employer/payments'],],
                          ['label' => 'Agencja', 'icon' => 'file-text-o', 'url' => ['/employer/'],],
                        ],
                    ],
                    ['label' => 'Mój profil', 'icon' => 'id-card', 'url' => ['/employer/default/profile'],],

                ],
            ]
        ) ?>

    </section>

</aside>
