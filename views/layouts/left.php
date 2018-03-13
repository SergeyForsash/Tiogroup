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
                    ['label' => 'Тикеты', 'icon' => 'sticky-note', 'url' => ['/admin/tickets'],],
                    ['label' => 'Сообщения', 'icon' => 'envelope', 'url' => ['/admin/massage'],],
                    ['label' => 'Все агенции', 'icon' => 'users', 'url' => ['/admin/partner'],],
                    ['label' => 'Работодатели', 'icon' => 'building-o', 'url' => ['/admin/company'],],
                    [
                        'label' => 'Работники',
                        'icon' => 'address-card',
                        'url' => '#',
                        'items' => [
                          ['label' => 'На вакансии', 'icon' => 'id-card', 'url' => ['/admin/worker'],],
                          ['label' => 'Все работники', 'icon' => 'address-card', 'url' => ['/admin/worker/old'],],
                        ],
                    ],
                    ['label' => 'Вакансии', 'icon' => 'handshake-o', 'url' => ['/admin/vacancy'],],
                    [
                        'label' => 'Списки',
                        'icon' => 'list',
                        'url' => '#',
                        'items' => [
                          ['label' => 'Гражданство','url' => ['/admin/citizenship'],],
                          ['label' => 'Образование', 'url' => ['/admin/degree'],],
                          ['label' => 'Категория прав', 'url' => ['/admin/driver-category'],],
                          ['label' => 'Знание польского', 'url' => ['/admin/polish-knowledge'],],
                          ['label' => 'Профессия', 'url' => ['/admin/profession'],],
                          ['label' => 'Отрасль', 'url' => ['/admin/specialisation'],],
                          ['label' => 'Города', 'url' => ['/admin/city'],],
                          ['label' => 'Тип визы', 'url' => ['/admin/visa-type'],],
                          ['label' => 'Статусы работника', 'url' => ['/admin/status-worker'],],
                          ['label' => 'Типы оплаты', 'url' => ['/admin/pay-type'],],
                          ['label' => 'Статусы платежей', 'url' => ['/admin/status-pay'],],
                          ['label' => 'Месяца', 'url' => ['/admin/month'],],
                        ],
                    ],
                    [
                        'label' => 'Документы',
                        'icon' => 'file-text-o',
                        'url' => '#',
                        'items' => [
                          ['label' => 'Работники','url' => ['#'],],
                          ['label' => 'Агентства', 'url' => ['#'],],
                          ['label' => 'Работодатели', 'url' => ['#'],],
                        ],
                    ],
                    [
                        'label' => 'Расчеты',
                        'icon' => 'money',
                        'url' => '#',
                        'items' => [
                          ['label' => 'Счета работников', 'icon' => 'file-text','url' => ['/admin/payments'],],
                          ['label' => 'Счета агентств', 'icon' => 'file-text', 'url' => ['#'],],
                          ['label' => 'Счета работодателей', 'icon' => 'file-text', 'url' => ['#'],],
                        ],
                    ],
                    ['label' => 'История действий', 'icon' => 'history', 'url' => ['#'],],

                    ['label' => 'Раздел Admin', 'options' => ['class' => 'header']],
                    [
                        'label' => 'Пользователи',
                        'icon' => 'users',
                        'url' => '#',
                        'items' => [
                          ['label' => 'Пользователи', 'icon' => 'user', 'url' => ['/user/admin/index '],],
                          ['label' => 'Назначение', 'icon' => 'user-circle', 'url' => ['/rbac/assignment'],],
                          ['label' => 'Роли', 'icon' => 'shield', 'url' => ['/rbac/role'],],
                          ['label' => 'Разрешения', 'icon' => 'sign-in', 'url' => ['/rbac/permission'],],
                          ['label' => 'Маршруты', 'icon' => 'sitemap', 'url' => ['/rbac/route'],],
                          ['label' => 'Правила', 'icon' => 'recycle', 'url' => ['/rbac/rule'],],
                        ],
                    ],
                    ['label' => 'Файловый Менеджер', 'icon' => 'file-image-o', 'url' => ['/admin/default/fmanager']],
                ],
            ]
        ) ?>

    </section>

</aside>
