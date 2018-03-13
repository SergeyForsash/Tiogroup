<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
echo Modal::widget([
    'id' => 'view-vacancy',
    'header'=>'<h4 class="text-center">'.Yii::t('app', 'Просмотр Тикета').'</h4>',
    'size'=>'modal-lg',
    'toggleButton' => false,
]);

/* @var $this yii\web\View */
/* @var $searchModel app\models\crm\search\Tickets */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Тикеты');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="">
  <div class="massage">
      <?= GridView::widget([
          'dataProvider' => $dataVacancy,
          //'filterModel' => $searchModel,
          'tableOptions' => [
              'class' => 'table table-normal'
          ],
          'columns' => [
              [
                'attribute' => 'id',
                'label'=>'# '.Yii::t('app', 'Тикет'),
                'contentOptions' => ['style' => 'width: 50px; max-width: 50px; text-align:center;'],
              ],
              [
                'attribute' => 'vacancy_id',
                'label'=>Yii::t('app', 'Vacancie'),
                'contentOptions' => ['style' => 'width: 200px; max-width: 200px; '],
                'format' => 'raw',
                'contentOptions' => ['style' => 'width: 200px; max-width: 200px; '],
                'value' => function($data){
                  $url='/employer/vacancy/view?id='.$data->vacancy_id ;
                  $company = app\models\crm\Vacancy::find()->where(['id'=>$data->vacancy_id])->one()->title_pl;
                  if ($data->vacancy_id == null) {
                    $item='';
                  }else {
                    $item =Html::a($company, $url,['class'=>'massage-view-url','data-toggle'=>'tooltip', 'title'=>'', 'data-original-title'=>'Перейти к вакансии' ]);
                  }
                  return $item;
                  }
              ],
              [
                'attribute' => 'subject',
                'label'=>Yii::t('app', 'Причина возврата'),
              ],
              [
                'attribute' => 'id',
                'label'=>'',
                'format' => 'raw',
                'options' => ['style' => 'width: 100px; max-width: 100px;'],
                'contentOptions' => ['style' => 'width: 100px; max-width: 100px; '],
                'value' => function($data){
                  $type = '<span class="label label-warning" style="margin-top:2px">'.Yii::t('app', 'Исправьте данные').'</span>';
                  return $type;
                  }
              ],
              [
                'attribute' => 'status',
                'label'=>Yii::t('app', 'Статус'),
                'format' => 'html',
                'contentOptions' => ['style' => 'width: 100px; max-width: 100px;text-align:center'],
                'content'=>function($data){
                    if ($data->status == 2) {
                      $item = '<span class="glyphicon glyphicon-ok text-success" data-toggle="tooltip" ,title="", data-original-title="'.Yii::t('app', 'Все правки внесены').'"></span>';
                    }else {
                      $item = '<span class="glyphicon glyphicon-remove text-danger" data-toggle="tooltip" ,title="", data-original-title="'.Yii::t('app', 'Правки ещё не внесены').'"></span>';

                    }
                    return $item;
                  }
              ],
              [
                'attribute' => 'id',
                'label'=>Yii::t('app', 'Отправленo'),
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
                    $item = Yii::$app->formatter->asDate($date,"php:d.F",'long').' '.'w '.Yii::$app->formatter->asDate($time,"php: H:i");
                  }
                  return $item;
                },

              ],
              //'users',
              //'del',

              [
                  'class' => 'yii\grid\ActionColumn',
                  'template' => '{view-vacancy}',
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
