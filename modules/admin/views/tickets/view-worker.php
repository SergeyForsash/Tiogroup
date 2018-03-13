<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
?>
<div class="tickets-worker">
  <div class="col-md-12">
    <h5 class="text-center">Тикет по  раотнику: <?= $models->user_name ?></h5>
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
  <div class="col-md-12">
    <?= $this->render('_form-worker', [
        'model' => $model,
        'models' => $models,
    ]) ?>
  </div>
   <div style="clear: left"></div>
</div>
