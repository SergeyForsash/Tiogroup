<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel app\models\admin\ProfessioneSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Professions');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profession-index">

  <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

  <p>
      <?= Html::a(Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
  </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'title',
            'title_pl',
            [
      				'attribute' => 'spec_id',
              'content'=>function($data){
                  $item = app\models\admin\Specialisation::findOne(['id'=>$data->spec_id])->title;
                  return $item;
              },
              'filter' => ArrayHelper::map(app\models\admin\Specialisation::find()->all(), 'id', 'title')
      			],

            [
              'class' => 'yii\grid\ActionColumn',
              'options' => ['style' => 'width: 100px; max-width: 100px;'],
              'contentOptions' => ['style' => 'width: 100px; max-width: 100px;'],
              'buttons' => [
                  'view' => function ($url,$model) {
                      return Html::a('<i class="fa fa-eye" aria-hidden="true"></i>',$url ,['class'=>'btn btn-info btn-xs','title'=>Yii::t('app', 'view')]);
                  },
                  'update' => function ($url,$model) {
                      return Html::a('<i class="fa fa-pencil" aria-hidden="true"></i>',$url ,['class'=>'btn btn-primary btn-xs','title'=>Yii::t('app', 'update')]);
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
