<?php

use yii\bootstrap\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\bootstrap\Modal;
echo Modal::widget([
    'id' => 'company-mas',
    'toggleButton' => false,
]);
/* @var $this yii\web\View */
/* @var $searchModel app\models\admin\CompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Companies');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-index">

  <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

  <p>
      <?= Html::a(Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
  </p>
<?php Pjax::begin() ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function ($model, $key, $index, $grid) {
          return ['class' => 'text_vacancy'];
          },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'user_id',
            'firm_name',
            'nip',
            'director_name',
            [
              'attribute' => 'updated_at',
              'format' =>  ['date', 'dd.MM.YYYY'],
            ],
            //'address',
            // 'regon',
            // 'krs',
            // 'phone_number',
            // 'mobile_number',
            // 'email:email',
            // 'website',
            // 'file',
            // 'created_at',
            // 'ident',
            // 'status',

            [
              'class' => 'yii\grid\ActionColumn',
              'template' => '{massag} {view} {update} {delete}',
              'options' => ['style' => 'width: 125px; max-width: 125px;'],
              'contentOptions' => ['style' => 'width: 125px; max-width: 125px;'],
              'buttons' => [
                'massag' => function ($url, $model) {
                    return Html::a(
                      '<i class="fa fa-envelope"></i>',
                      ['/admin/default/cmassage','id'=>$model->id],
                      [
                        'class'=>'btn btn-success btn-xs',
                        'title'=>Yii::t('app', 'singnup-massage'),
                        'data-toggle' => 'modal',
                        'data-target' => '#company-mas',
                        'onclick' => "$('#company-mas .modal-dialog .modal-content .modal-body').load($(this).attr('href'))",
                      ]
                    );
                  },
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
  <?php Pjax::end() ?>
</div>
