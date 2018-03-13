<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel app\models\crm\search\Payments */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Payments');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payments-index">

   <?php Pjax::begin(['id' => 'payments']) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function ($model, $key, $index, $grid) {
            return ['class' => 'text_vacancy'];
          },
        'columns' => [
            [
                'class' => 'yii\grid\CheckboxColumn',
            ],
            [
              'attribute' => 'id',
              'label' => Yii::t('app', 'Номер счёта'),
              'content'=>function($data){
                    $item =  'Rachunek nr. '.$data->id;
                    return $item;
                },
            ],
            [
              'attribute' => 'month_id',
              'content'=>function($data){
                    $item = app\models\admin\Month::find()->where(['id' => $data->month_id])->one()->title_pl;
                    return $item;
                },
                'filter'=>  ArrayHelper::map(app\models\admin\Month::find()->all(), 'id', 'title_pl'),
            ],
            [
              'attribute' => 'user_id',
              'label' => Yii::t('app', 'full_name_w'),
              'content'=>function($data){
                    $worke = app\models\crm\Worker::find()->where(['id' => $data->user_id])->one()->full_name;
                    if (!empty($worke)) {
                      $item = $worke;
                    }else {
                      $item = Yii::t('app', 'Уволен');
                    }
                    return $item;
                },
            ],
            'vacancy_name_pl',
            [
              'attribute' => 'hours',
            ],
            [
              'attribute' => 'rate',
              'content'=>function($data){
                    $item = $data->rate.' zl.';
                    return $item;
                },
            ],
            'total',

            [
                  'attribute' => 'status_id',
                  'value' => function ($model, $key, $index, $column) {
                    if ($model->status_id == 1) {
                        $statys_1 = '1';
                        $statys_2 = '2';
                        $disab = false;
                      }elseif($model->status_id == 2){
                        $statys_1 = '2';
                        $statys_2 = '3';
                        $disab = false;
                      }else{
                        $statys_1 = '3';
                        $statys_2 = '';
                        $disab = true;
                      }
                      return Html::activeDropDownList($model, 'status_id',

                                          ArrayHelper::map(app\models\crm\StatusPay::find()->where(['id'=>$statys_1])->orWhere(['id'=>$statys_2])->all(), 'id', 'title_pl'),


                      [
                        'disabled'=>$disab,
                        'data-id' => $model->id,
                        'id'=>"employer-status_id-$model->id",
                        'class'=>'form-control input-sm',
                        'data' => [
                            'confirm' => Yii::t('app', 'Status Regest'),
                            'method' => 'post',
                        ],
                        'onchange' => "
                               $.ajax({
                                url: \"/employer/payments/statuse\",
                                type: \"post\",
                        data: { id:  $key, status_id: $(\"#employer-status_id-$model->id\").val()},
                                          });"
                      ]
                    );
                  },
                'format' => 'raw',
                'filter'=>  ArrayHelper::map(app\models\crm\StatusPay::find()->all(), 'id', 'title_pl'),
              ],

              [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
                'options' => ['style' => 'width: 50px; max-width: 50px;'],
                'contentOptions' => ['style' => 'width: 50px; max-width: 50px;'],
                'buttons' => [
                  'update' => function ($url,$model) {
                      return $model->status_id >=2 ? '' :Html::a('<i class="fa fa-pencil" aria-hidden="true"></i>',$url ,['class'=>'btn btn-primary btn-xs','title'=>Yii::t('app', 'update')]);
                  },
              ],

              ],
        ],
    ]); ?>
    <?php Pjax::end() ?>
</div>
