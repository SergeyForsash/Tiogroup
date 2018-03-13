<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
?>
<div class="tickets-worker">
  <div class="col-md-12">
    <ul id='my-massage' class="chat-box">
<?php Pjax::begin(); ?>
      <?php echo ListView::widget([
        'dataProvider' => $dataProvider,
        'layout' => '{items}{pager}',
        'itemView' => '_worker',
      ]); ?>
<?php Pjax::end(); ?>
  </ul>
  </div>
  <?php if ($models->status == 1) { ?>
    <div class="col-md-12">
      <?= $this->render('_form-worker', [
          'model' => $model,
          'models' => $models,
      ]) ?>
    </div>
  <?php }else{ ?>
    <div class="text-center">
      <span class="label label-success">Тикет закрыт</span>
    </div>
  <?php } ?>
     <div style="clear: left"></div>
</div>
