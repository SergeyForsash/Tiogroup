<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\crm\WorkerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Workers_a');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="worker-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function ($model, $key, $index, $grid) {
            $workers = app\models\crm\Worker::find()
                        ->where(['id' => $model->id,'statusarchive' =>4])
                        ->all();
            if(!empty($workers)){
                return ['class' => 'work_status'];
            }else{
              return ['class' => 'text_vacancy'];
            };

          },
        'columns' => [
          [
             'attribute' => 'id',
             'options' => ['style' => 'width: 50px; max-width: 50px;'],
             'contentOptions' => ['style' => 'width: 50px; max-width: 50px;'],
             'label'=>'',
             'format'=>'html',
             'value' => function($model) {
               $workers = app\models\crm\Worker::find()
                           ->where(['id' => $model->id,'statusarchive' =>4])
                           ->all();
               if (!empty($workers)) {
                   $items = '<a data-toggle="tooltip" title="Wymaga uwagi"><span class="badge" style="background-color: red">&nbsp;</span></a>';
               }else{
                 $items ='';
               }
               return  $items;
             },
               'filter' => ''
           ],
            [
              'attribute' => 'id',
              'options' => ['style' => 'width: 100px; max-width: 50px;'],
              'contentOptions' => ['style' => 'width: 100px; max-width: 50px;'],
            ],
            'full_name',
            'pass_number',
            [
      				'attribute' => 'vacancy_id',
              'label' => Yii::t('app', 'Vacancy Id'),
              'format'=>'html',
              'value'=>function($data){
                    if ($data->vacancy_id == 0) {
                      $items = Yii::t('app', 'vacancyNumber_w');
                    }else {
                      $items = Html::a(Yii::t('app', 'Vacancie_#').$data->vacancy_id , '/employer/vacancy/view?id='.$data->vacancy_id,['title'=>Yii::t('app', 'Go Vacancy')]);
                    }
                    return $items;
                },
      			],

            [
      				'attribute' => 'statusarchive',
              'content'=>function($data){
                  return $data->getStatusNamePl();
              },
              'filter' => app\models\crm\Worker::getStatusListPl()
      			],
             'date_start:date',
            [
              'class' => 'yii\grid\ActionColumn',
              'template' => '{view} {update}',
              'options' => ['style' => 'width: 80px; max-width: 80px;'],
              'contentOptions' => ['style' => 'width: 80px; max-width: 80px;'],
              'buttons' => [
                'view' => function ($url,$model) {
                    return Html::a('<i class="fa fa-eye" aria-hidden="true"></i>',$url ,['class'=>'btn btn-info btn-xs','title'=>Yii::t('app', 'view')]);
                },
                'update' => function ($url,$model) {
                    return $model->statusarchive ==7 ? Html::a('<i class="fa fa-pencil" aria-hidden="true"></i>',$url ,['class'=>'btn btn-primary btn-xs','title'=>Yii::t('app', 'update')]):'';
                },
            ],

            ],
        ],
    ]); ?>
</div>
