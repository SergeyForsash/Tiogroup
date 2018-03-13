<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
echo Modal::widget([
    'id' => 'view-worker',
    'header'=>'<h4 class="text-center">Просмотр Тикета</h4>',
    'size'=>'modal-lg',
    'toggleButton' => false,
]);

/* @var $this yii\web\View */
/* @var $searchModel app\models\crm\search\Tickets */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Тикеты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="">
  <div class="massage">
      <?= GridView::widget([
          'dataProvider' => $dataWorker,
          //'filterModel' => $searchModel,
          'tableOptions' => [
              'class' => 'table table-normal'
          ],
          'columns' => [
              [
                'attribute' => 'id',
                'label'=>'№ Тикета',
                'contentOptions' => ['style' => 'width: 50px; max-width: 50px; text-align:center;'],
              ],

              //'admin_id',
              //'admin_name',
              //'user_id',

              [
                'attribute' => 'user_name',
                'label'=>'Имя',
                'format' => 'raw',
                'contentOptions' => ['style' => 'width: 200px; max-width: 200px; '],
                'value' => function($data){
                  $worker = app\models\crm\Worker::find()->where(['user_id'=>$data->user_id])->one()->id;
                  $url='/agency/worker/view?id='.$worker;
                  $item =Html::a($data->user_name, $url,['class'=>'massage-view-url','data-toggle'=>'tooltip', 'title'=>'', 'data-original-title'=>'Перейти к работнику']);
                  return $item;
                  }
              ],
              [
                'attribute' => 'subject',
                'label'=>'Причина возврата',
              ],
              [
                'attribute' => 'status',
                'label'=>'',
                'format' => 'raw',
                'options' => ['style' => 'width: 100px; max-width: 100px;'],
                'contentOptions' => ['style' => 'width: 100px; max-width: 100px; '],
                'value' => function($data){
                  if ($data->status == 1) {
                    $type = '<span class="label label-warning" style="margin-top:2px"> Исправьте данных </span>';
                  }else {
                    $type = '<span class="label label-info" style="margin-top:2px"> На модерации </span>';
                  }

                  return $type;
                  }
              ],
              [
                'attribute' => 'status',
                'label'=>'Статус',
                'format' => 'html',
                'contentOptions' => ['style' => 'width: 120px; max-width: 120px;text-align:center'],
                'content'=>function($data){
                    if ($data->status == 2) {
                      $item = '<span class="glyphicon glyphicon-ok text-success" data-toggle="tooltip" ,title="", data-original-title="Все правки внесены"></span>';
                    }else {
                      $item = '<span class="glyphicon glyphicon-remove text-danger" data-toggle="tooltip" ,title="", data-original-title="Правки ещё не внесены"></span>';

                    }
                    return $item;
                  }
              ],
              [
                'attribute' => 'id',
                'label'=>'Отправленo',
                'format' =>  ['date', 'HH:mm:ss dd.MM.YYYY'],
                'options' => ['style' => 'width: 200px; max-width: 200px;'],
                'contentOptions' => ['style' => 'width: 200px; max-width: 200px;'],
                'content'=>function($data){
                  $date = $data->date;
                  $date_2= date('Y-m-d');
                  $time = $data->time;
                  Yii::$app->formatter->locale = 'ru-Ru';
                  if ($date == $date_2) {
                    $item = Yii::$app->formatter->asDate($time,"php: H:i");
                  }else {
                    $item = Yii::$app->formatter->asDate($date,"php:d.F",'long').' '.'в '.Yii::$app->formatter->asDate($time,"php: H:i");
                  }
                  return $item;
                },

              ],
              //'users',
              //'del',

              [
                  'class' => 'yii\grid\ActionColumn',
                  'template' => '{view-worker}',
                  'contentOptions' => ['style' => 'width: 70px; max-width: 70px;'],
                  'buttons' => [
                    'view-worker' => function ($url, $model) {
                            return Html::a(
                              '<i class="fa fa-eye" data-toggle="tooltip" title="" data-original-title="Просмотреть тикет" ,></i>',
                              $url, [
                                'class'=>'btn btn-info btn-xs',
                                'data-toggle' => 'modal',
                                'data-target' => '#view-worker',
                                'onclick' => "$('#view-worker .modal-dialog .modal-content .modal-body').load($(this).attr('href'))",
                              ]
                            );
                          },
                ],
              ],
          ],
      ]); ?>
  </div>
</div>


<?php
$js = <<< 'SCRIPT'
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});

SCRIPT;
$this->registerJs($js);
 ?>
