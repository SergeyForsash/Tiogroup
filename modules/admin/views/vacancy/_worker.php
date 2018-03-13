<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;
echo Modal::widget([
    'id' => 'worker-fix',
    'toggleButton' => false,
]);
?>
<div class="worker-agreed">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'rowOptions' => function ($model, $key, $index, $grid) {
          if ($model->statusarchive == '3') {
            return ['class' => 'work_corect'];
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
               if ($model->statusarchive == 3) {
                   $items = '<a data-toggle="tooltip" title="Требует редактирования данных"><span class="badge" style="background-color:#ffe200">&nbsp;</span></a>';
               }elseif ($model->statusarchive == 5) {
                 $items = '<a data-toggle="tooltip" title="Согласован"><span class="badge" style="background-color:#00a65a">&nbsp;</span></a>';
               }else {
                 $items ='';
               }
               return  $items;
             },
               'filter' => ''
           ],
            'pass_number',
            'full_name',
            [
      				'attribute' => 'created_by',
      				'label' => Yii::t('app', 'Agency_w'),
              'content'=>function($data){
                  return $data->getAgencyName();
              },
              'filter' => app\models\crm\Worker::getAgencyList()
      			],
            'updated_at:date',
            [
                  'attribute' => 'statusarchive',
                  'value' => function ($model, $key, $index, $column) {
                    if ($model->statusarchive == 2) {
                        $statys_1 = '2';
                        $statys_2 = '';
                        $statys_3 = '4';
                        $statys_4 = '';
                        $disab = false;
                      }elseif($model->statusarchive ==3){
                        $statys_1 = '3';
                        $statys_2 = '';
                        $statys_3 = '';
                        $statys_4 = '';
                        $disab = true;
                      }elseif($model->statusarchive ==4){
                        $statys_1 = '4';
                        $statys_2 = '';
                        $statys_3 = '';
                        $statys_4 = '';
                        $disab = true;
                      }elseif($model->statusarchive == 5) {
                        $statys_1 = '5';
                        $statys_2 = '';
                        $statys_3 = '';
                        $statys_4 = '';
                        $disab = true;
                      }
                      elseif($model->statusarchive == 6) {
                        $statys_1 = '6';
                        $statys_2 = '7';
                        $statys_3 = '';
                        $statys_4 = '';
                        $disab = false;
                      }
                      elseif($model->statusarchive == 7) {
                        $statys_1 = '7';
                        $statys_2 = '8';
                        $statys_3 = '';
                        $statys_4 = '';
                        $disab = true;
                      }
                      elseif($model->statusarchive == 8) {
                        $statys_1 = '8';
                        $statys_2 = '10';
                        $statys_3 = '';
                        $statys_4 = '';
                        $disab = false;
                      }
                      return Html::activeDropDownList($model, 'statusarchive',

                                          ArrayHelper::map(app\models\admin\StatusWorker::find()->where(['id'=>$statys_1])->orWhere(['id'=>$statys_2])->orWhere(['id'=>$statys_3])->orWhere(['id'=>$statys_4])->all(), 'id', 'title'),


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
                                url: \"/admin/worker/statuse\",
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
              'template' => '{tickets} {view} {update}',
              'options' => ['style' => 'width: 100px; max-width: 100px;'],
              'contentOptions' => ['style' => 'width: 100px; max-width: 100px;'],
              'buttons' => [
                'tickets' => function ($url, $model) {
                        return $model->statusarchive !== 2 ? '' : Html::a(
                          '<i class="fa fa-sticky-note" data-toggle="tooltip" title="" data-original-title="Отправить на коректировку и  указать причину" ,></i>',
                          $url, [
                            'class'=>'btn btn-warning btn-xs',
                            'data-toggle' => 'modal',
                            'data-target' => '#worker-fix',
                            'onclick' => "$('#worker-fix .modal-dialog .modal-content .modal-body').load($(this).attr('href'))",
                          ]
                        );
                      },
                'view' => function ($url,$model) {
                  $url ='/admin/worker/view?id='.$model->id;
                    return Html::a('<i class="fa fa-eye" aria-hidden="true"></i>',$url ,['class'=>'btn btn-info btn-xs','title'=>Yii::t('app', 'view')]);
                },
                'update' => function ($url,$model) {
                  $url ='/admin/worker/update?id='.$model->id;
                    return Html::a('<i class="fa fa-pencil" aria-hidden="true"></i>',$url ,['class'=>'btn btn-primary btn-xs','title'=>Yii::t('app', 'update')]);
                },
            ],

            ],
        ],
    ]); ?>
</div>
<?php
$js = <<< 'SCRIPT'
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
SCRIPT;
$this->registerJs($js);
 ?>
