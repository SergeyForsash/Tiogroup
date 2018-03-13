<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model app\models\crm\Massage */

$this->title = 'Переписка с TIOGROUP';
$this->params['breadcrumbs'][] = ['label' => 'Мои сообщения', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="massage-view">
  <ul id="my-massage" class="chat-box">
  <?php Pjax::begin(['id' => 'massage']) ?>
    <?php echo ListView::widget([
      'dataProvider' => $dataProvider,
      'layout' => '{items}{pager}',
      'itemView' => '_massage',
    ]); ?>
  <?php Pjax::end() ?>

<?= $this->render('_my-form', [
    'new_model' => $new_model,
]) ?>
</ul>
</div>
<?php
$js = <<< 'SCRIPT'
var auto_refresh = setInterval(
function ()
{
$.pjax.reload({container:"#my-massage"});;
}, 10000);

SCRIPT;
$this->registerJs($js);
 ?>
