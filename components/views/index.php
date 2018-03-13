<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\crm\search\Payments */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Payments');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payments-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<?php if ($status == 7): ?>
    <?= $this->render('_form',[
        'model' => $model,
        'user_id' => $user_id,
        'vacancy'=>$vacancy,
        'vacancy_pl'=>$vacancy_pl,
        'company_id'=>$company_id,
    ]) ?>
<?php endif; ?>


   <?php Pjax::begin(['id' => 'payments']) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'rowOptions' => function ($model, $key, $index, $grid) {
            return ['class' => 'text_vacancy'];
          },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'user_id',

            [
              'attribute' => 'month_id',
              'content'=>function($data){
                    $item = app\models\admin\Month::find()->where(['id' => $data->month_id])->one()->title;
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
            ],
            [

              'class' => 'yii\grid\ActionColumn',
              'template' => '{update}',
              'options' => ['style' => 'width: 50px; max-width: 50px;'],
              'contentOptions' => ['style' => 'width: 50px; max-width: 50px;'],
              'buttons' => [
                'update' => function ($url,$model) {
                  $url ='/admin/payments/update?id='.$model->id;
                    return $model->status_id >=2 ? '' : Html::a('<i class="fa fa-pencil" aria-hidden="true"></i>',$url ,['class'=>'btn btn-primary btn-xs','title'=>Yii::t('app', 'update')]);
                },

            ],

            ],
        ],
    ]); ?>
    <?php Pjax::end() ?>
</div>
