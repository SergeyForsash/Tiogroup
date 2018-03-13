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
<?php if ($dataProvider->totalCount > 0) { ?>
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-envelope-o"></i>
        <span class="label label-success">
            <?= $dataProvider->totalCount ?>
        </span>
    </a>
    <ul class="dropdown-menu">
        <li class="header text-center"><?=Yii::t('app', 'You have') ?>
            <?= $dataProvider->totalCount ?>
          <?=Yii::t('app', 'Messages') ?></li>
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
                 'itemView' => '_massage',
             ]); ?>
        </li>
      <?php $module =Yii::$app->controller->module->id;?>
      <li class="footer"><a href="<?= yii\helpers\Url::to(['/'.$module.'/massage'])?>"><?= Yii::t('app', 'See All Messages')?></a></li>
   </ul>
<?php } else { ?>
  <a href="<?= yii\helpers\Url::to(['/'.$module.'/massage/'])?>" > <i class="fa fa-envelope-o"></i></a>
<?php } ?>
<?php Pjax::end() ?>
