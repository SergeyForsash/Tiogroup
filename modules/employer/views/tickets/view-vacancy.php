<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
?>
<div class="tickets-vacancy">
  <div class="col-md-12">
    <ul id='my-massage' class="chat-box">
<?php Pjax::begin(); ?>
      <?php echo ListView::widget([
        'dataProvider' => $dataProvider,
        'layout' => '{items}{pager}',
        'itemView' => '_vacancy',
      ]); ?>
<?php Pjax::end(); ?>
  </ul>
  </div>
  <div class="col-md-12">
    <?= $this->render('_form-vacancy', [
        'model' => $model,
        'models' => $models,
    ]) ?>
  </div>
   <div style="clear: left"></div>
</div>
