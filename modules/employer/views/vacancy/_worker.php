<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
?>
<div class="worker-agreed">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'rowOptions' => function ($model, $key, $index, $grid) {
          if ($model->statusarchive == '4') {
            return ['class' => 'work_status'];
          }else{
            return ['class' => 'text_vacancy'];
          }
        },
        'columns' => [
          [
             'attribute' => 'id',
             'options' => ['style' => 'width: 50px; max-width: 50px;'],
             'contentOptions' => ['style' => 'width: 50px; max-width: 50px;'],
             'label'=>'',
             'format'=>'html',
             'value' => function($model) {
               if ($model->statusarchive == 4) {
                   $items = '<a data-toggle="tooltip" title="Wymaga uwagi"><span class="badge" style="background-color: red">&nbsp;</span></a>';
               }elseif ($model->statusarchive == 5) {
                 $items = '<a data-toggle="tooltip" title="Согласован"><span class="badge" style="background-color:#00a65a">&nbsp;</span></a>';
               }else {
                 $items ='';
               }
               return  $items;
             },
               'filter' => ''
           ],
            //'pass_number',
            'full_name',
            'updated_at:date',
            [
                  'attribute' => 'statusarchive',
                  'value' => function ($model, $key, $index, $column) {
                    if($model->statusarchive ==4){
                        $statys_1 = '4';
                        $statys_2 = '5';
                        $statys_3 = '100';
                        $statys_4 = '';
                        $disab = false;
                      }elseif($model->statusarchive == 5) {
                        $statys_1 = '5';
                        $statys_2 = '6';
                        $statys_3 = '';
                        $statys_4 = '';
                        $disab = false;
                      }
                      elseif($model->statusarchive == 6) {
                        $statys_1 = '6';
                        $statys_2 = '';
                        $statys_3 = '';
                        $statys_4 = '';
                        $disab = true;
                      }
                      elseif($model->statusarchive == 7) {
                        $statys_1 = '7';
                        $statys_2 = '8';
                        $statys_3 = '';
                        $statys_4 = '';
                        $disab = false;
                      }
                      elseif($model->statusarchive == 8) {
                        $statys_1 = '8';
                        $statys_2 = '';
                        $statys_3 = '';
                        $statys_4 = '';
                        $disab = true;
                      }

                      return Html::activeDropDownList($model, 'statusarchive',

                                          ArrayHelper::map(app\models\admin\StatusWorker::find()->where(['id'=>$statys_1])->orWhere(['id'=>$statys_2])->orWhere(['id'=>$statys_3])->orWhere(['id'=>$statys_4])->all(), 'id', 'title_pl'),


                      [
                        'disabled'=>$disab,
                        'data-id' => $model->id,
                        'id'=>"worker-statusarchive-$model->id",
                        'class'=>'form-control input-sm',
                        'data' => [
                            'confirm' => Yii::t('app', 'Status Regest'),
                            'method' => 'post',
                        ],
                        'onchange' => "
                               $.ajax({
                                url: \"/employer/worker/statuse\",
                                type: \"post\",
                        data: { worker_id:  $key, statusarchive : $(\"#worker-statusarchive-$model->id\").val()},
                                          });"
                      ]
                    );
                  },
                'format' => 'raw',
              ],


            [

              'class' => 'yii\grid\ActionColumn',
              'template' => '{view}',
              'options' => ['style' => 'width: 80px; max-width: 80px;'],
              'contentOptions' => ['style' => 'width: 80px; max-width: 80px;'],
              'buttons' => [
                'view' => function ($url,$model) {
                  $url ='/employer/worker/view?id='.$model->id;
                    return Html::a('<i class="fa fa-eye" aria-hidden="true"></i>',$url ,['class'=>'btn btn-info btn-xs','title'=>Yii::t('app', 'view')]);
                },
            ],

            ],
        ],
    ]); ?>
</div>
