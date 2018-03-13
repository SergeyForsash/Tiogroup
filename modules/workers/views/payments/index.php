<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel app\models\crm\search\Payments */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Payments M');
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
        'filterModel' => $searchModel,
        'rowOptions' => function ($model, $key, $index, $grid) {
            return ['class' => 'text_vacancy'];
          },
        'columns' => [
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
                  'value' => function ($model, $key, $index, $column) {
                    if ($model->status_id == 1) {
                        $statys_1 = '1';
                        $statys_2 = '';
                        $disab = true;
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

                                          ArrayHelper::map(app\models\crm\StatusPay::find()->where(['id'=>$statys_1])->orWhere(['id'=>$statys_2])->all(), 'id', 'title'),


                      [
                        'disabled'=>$disab,
                        'data-id' => $model->id,
                        'id'=>"payments-status_id-$model->id",
                        'class'=>'form-control input-sm',
                        'data' => [
                            'confirm' => Yii::t('app', 'Status Regest'),
                            'method' => 'post',
                        ],
                        'onchange' => "
                               $.ajax({
                                url: \"/workers/payments/statuse\",
                                type: \"post\",
                        data: { id:  $key, status_id: $(\"#payments-status_id-$model->id\").val()},
                                          });"
                      ]
                    );
                  },
                'format' => 'raw',
                'filter'=>  ArrayHelper::map(app\models\crm\StatusPay::find()->all(), 'id', 'title'),
              ],

            [
              'class' => 'yii\grid\ActionColumn',
              'template' => '{update}',
              'options' => ['style' => 'width: 50px; max-width: 50px;'],
              'contentOptions' => ['style' => 'width: 50px; max-width: 50px;'],
              'buttons' => [
                'update' => function ($url,$model) {
                    return $model->status_id >=2 ? '' : Html::a('<i class="fa fa-pencil" aria-hidden="true"></i>',$url ,['class'=>'btn btn-primary btn-xs','title'=>Yii::t('app', 'update')]);
                },
            ],

            ],
        ],
    ]); ?>
    <?php Pjax::end() ?>
</div>
