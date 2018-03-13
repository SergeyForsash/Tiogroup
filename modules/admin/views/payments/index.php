<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel app\models\crm\search\Payments */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Payments W');
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
                    $item =  'Счёт № '.$data->id;
                    return $item;
                },
            ],
            [
              'attribute' => 'month_id',
              'content'=>function($data){
                    $item = app\models\admin\Month::find()->where(['id' => $data->month_id])->one()->title;
                    return $item;
                },
                  'filter'=>  ArrayHelper::map(app\models\admin\Month::find()->all(), 'id', 'title'),
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
            [
              'attribute' => 'company_id',
              'content'=>function($data){
                    $item = app\models\admin\Company::find()->where(['user_id' => $data->company_id])->one()->firm_name;
                    return $item;
                },
            ],
            'vacancy_name',
            [
              'attribute' => 'hours',
              'content'=>function($data){
                    $item = $data->hours.' ч.';
                    return $item;
                },
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
              'content'=>function($data){
                    $item = app\models\crm\StatusPay::find()->where(['id' => $data->status_id])->one()->title;
                    return $item;
                },
              'filter'=>  ArrayHelper::map(app\models\crm\StatusPay::find()->all(), 'id', 'title'),
            ],

            [
              'class' => 'yii\grid\ActionColumn',
              'template' => '{update} {delete}',
              'options' => ['style' => 'width: 80px; max-width: 80px;'],
              'contentOptions' => ['style' => 'width: 80px; max-width: 80px;'],
              'buttons' => [
                'update' => function ($url,$model) {
                    return $model->status_id >=2 ? '' : Html::a('<i class="fa fa-pencil" aria-hidden="true"></i>',$url ,['class'=>'btn btn-primary btn-xs','title'=>Yii::t('app', 'update')]);
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
    <?php Pjax::end() ?>
</div>
