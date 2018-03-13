<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\admin\CitypSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Cities');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="city-index">

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
