<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;

echo Modal::widget([

    'id' => 'view-worker',
    'header'=>'<h4 class="text-center">Просмотр Тикета </h4>',
    'size'=>'modal-lg',
    'toggleButton' => false,
]);
echo Modal::widget([
    'id' => 'view-vacancy',
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
  <h4>Тикеты по работникам</h4>
  <div class="massage">
      <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
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
                'attribute' => 'id',
                'label'=>'',
                'format' => 'raw',
                'options' => ['style' => 'width: 100px; max-width: 100px;'],
                'contentOptions' => ['style' => 'width: 100px; max-width: 100px; '],
                'value' => function($data){
                  if ($data->agency_id == null && $data->vacancy_id == null ) {
                    $type = '<span class="label label-info" style="margin-top:2px"> Работник </span>';
                  }else{
                    $type = '<span class="label label-primary" style="margin-top:2px"> Агенство </span>';
                  }
                  return $type;
                  }
              ],
              [
                'attribute' => 'user_name',
                'label'=>'Имя',
                'format' => 'raw',
                'contentOptions' => ['style' => 'width: 200px; max-width: 200px; '],
                'value' => function($data){
                  $worker = app\models\crm\Worker::find()->where(['full_name'=>$data->user_name])->one()->id;
                  $url='/admin/worker/view?id='.$worker;
                  $item =Html::a($data->user_name, $url,['class'=>'massage-view-url','data-toggle'=>'tooltip', 'title'=>'', 'data-original-title'=>'Перейти к работнику']);
                  return $item;
                  }
              ],
              [
                'attribute' => 'subject',
                'label'=>'Причина возврата',
              ],


              //'subject',
              //'content:ntext',
              //'tickets_id',
              [
                'attribute' => 'agency_id',
                'label'=>'Агенство',
                'contentOptions' => ['style' => 'width: 200px; max-width: 200px; '],
                'content'=>function($data){
                  $agency = app\models\admin\Partner::find()->where(['user_id'=>$data->agency_id])->one()->id;
                  $url='/admin/partner/view?id='.$agency;
                  if ($data->agency_id == null) {
                    $item='';
                  }else {
                    $item =app\models\admin\Partner::find()->where(['user_id'=>$data->agency_id])->one()->agency_name;
                  }
                  return Html::a($item, $url,['class'=>'massage-view-url','data-toggle'=>'tooltip', 'title'=>'', 'data-original-title'=>'Перейти к агенству']);
                }
              ],
              [
                'attribute' => 'status',
                'label'=>'Статус',
                'format' => 'raw',
                'options' => ['style' => 'width: 100px; max-width: 100px;'],
                'contentOptions' => ['style' => 'width: 100px; max-width: 100px; '],
                'value' => function($data){
                  if ($data->status == 1) {
                      $type = '<span class="label label-warning" style="margin-top:2px"> В работе </span>';
                  }elseif($data->status == 3) {
                    $type = '<span class="label label-success" style="margin-top:2px"> Закрыт </span>';
                  }
                  else {
                    $type = '<span class="label label-danger" style="margin-top:2px"> На модерацию </span>';
                  }

                  return $type;
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
                  'template' => '{view-worker} {delete}',
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
                    'delete' => function ($url,$model) {
                        return Html::a('<i class="fa fa-trash-o" aria-hidden="true"></i>', ['delete', 'id' => $model->id], [
                            'class' => 'btn btn-danger btn-xs',
                            'title'=>Yii::t('app', 'delete'),
                            'data' => [
                                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                'method' => 'post',
                            ],
                        ]);
                    },
                ],
              ],
          ],
      ]); ?>
  </div>
</div>
<div class="">
  <h4>Тикеты по вакансиям</h4>
  <div class="massage">
      <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
      <?= GridView::widget([
          'dataProvider' => $dataVacancy,
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
                'attribute' => 'id',
                'label'=>'',
                'format' => 'raw',
                'options' => ['style' => 'width: 100px; max-width: 100px;'],
                'contentOptions' => ['style' => 'width: 100px; max-width: 100px; '],
                'value' => function($data){
                  $type = '<span class="label label-success" style="margin-top:2px"> Вакакнсия </span>';
                  return $type;
                  }
              ],
              [
                'attribute' => 'user_name',
                'label'=>'Имя',
                'format' => 'raw',
                'contentOptions' => ['style' => 'width: 200px; max-width: 200px; '],
                'value' => function($data){
                  $company = app\models\admin\Company::find()->where(['firm_name'=>$data->user_name])->one()->id;
                  $url='/admin/company/view?id='.$company;
                  $item =Html::a($data->user_name, $url,['class'=>'massage-view-url','data-toggle'=>'tooltip', 'title'=>'', 'data-original-title'=>'Перейти к работодателю']);
                  return $item;
                  }
              ],
              [
                'attribute' => 'subject',
                'label'=>'Причина возврата',
              ],
              //'content:ntext',
              //'tickets_id',
              [
                'attribute' => 'vacancy_id',
                'label'=>'Название',
                'contentOptions' => ['style' => 'width: 200px; max-width: 200px; '],
                'format' => 'raw',
                'contentOptions' => ['style' => 'width: 200px; max-width: 200px; '],
                'value' => function($data){
                  $url='/admin/vacancy/view?id='.$data->vacancy_id ;
                  $company = app\models\crm\Vacancy::find()->where(['id'=>$data->vacancy_id])->one()->title;
                  if ($data->vacancy_id == null) {
                    $item='';
                  }else {
                    $item =Html::a($company, $url,['class'=>'massage-view-url','data-toggle'=>'tooltip', 'title'=>'', 'data-original-title'=>'Перейти к вакансии' ]);
                  }
                  return $item;
                  }
              ],
              //'viewed_admin',
              //'viewed_user',
              [
                'attribute' => 'status',
                'label'=>'Статус',
                'format' => 'raw',
                'options' => ['style' => 'width: 100px; max-width: 100px;'],
                'contentOptions' => ['style' => 'width: 100px; max-width: 100px; '],
                'value' => function($data){
                  if ($data->status == 1) {
                      $type = '<span class="label label-warning" style="margin-top:2px"> В работе </span>';
                  }elseif($data->status == 3) {
                    $type = '<span class="label label-success" style="margin-top:2px"> Закрыт </span>';
                  }
                  else {
                    $type = '<span class="label label-danger" style="margin-top:2px"> На модерацию </span>';
                  }

                  return $type;
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
                  'template' => '{view-vacancy} {delete}',
                  'contentOptions' => ['style' => 'width: 70px; max-width: 70px;'],
                  'buttons' => [
                    'view-vacancy' => function ($url, $model) {
                            return Html::a(
                              '<i class="fa fa-eye" data-toggle="tooltip" title="" data-original-title="Просмотреть тикет" ,></i>',
                              $url, [
                                'class'=>'btn btn-info btn-xs',
                                'data-toggle' => 'modal',
                                'data-target' => '#view-vacancy',
                                'onclick' => "$('#view-vacancy .modal-dialog .modal-content .modal-body').load($(this).attr('href'))",
                              ]
                            );
                          },
                    'delete' => function ($url,$model) {
                        return Html::a('<i class="fa fa-trash-o" aria-hidden="true"></i>', ['delete', 'id' => $model->id], [
                            'class' => 'btn btn-danger btn-xs',
                            'title'=>Yii::t('app', 'delete'),
                            'data' => [
                                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                'method' => 'post',
                            ],
                        ]);
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
