<?php
use yii\widgets\ListView;
use yii\widgets\Pjax;
use yii\helpers\Html;
$module =Yii::$app->controller->module->id;
?>
<?php Pjax::begin([
  'id' => 'have-update',
  'linkSelector'=>false,
  'options' => [
    'tag'=>'li',
    'class' => 'dropdown messages-menu',
  ],
  ]) ?>
<?php if ($dataProvider->totalCount > 0){ ?>
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-bell-o"></i>
        <span class="label label-warning">
            <?= $dataProvider->totalCount ?>
        </span>
    </a>
    <ul class="dropdown-menu">
        <li class="header text-center"><?=Yii::t('app', 'You have') ?>
            <?= $dataProvider->totalCount ?>
          <?=Yii::t('app', 'Ticket-i') ?></li>
        <li>
<!-- inner menu: contains the actual data -->

            <?php
            echo ListView::widget([
                 'options' => [
                   'tag'=>'ul',
                   'class' => 'menu',
                 ],
                 'itemOptions'=>['tag'=>'li'],
                 'dataProvider' => $dataProvider,
                 'layout' => "{items}\n",
                 'itemView' => '_tickets',
             ]); ?>
        </li>

   </ul>
<?php } else { ?>
  <a href="<?= yii\helpers\Url::to(['/'.$module.'/tickets/'])?>" > <i class="fa fa-bell-o"> </i></a>
<?php } ?>
<?php Pjax::end() ?>
