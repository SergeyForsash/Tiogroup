<?php
use yii\helpers\Url;
use yii\bootstrap\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use app\models\crm\User;
use yii\bootstrap\Modal;
echo Modal::widget([
    'id' => 'partner-mas',
    'toggleButton' => false,
]);
/* @var $this yii\web\View */
/* @var $searchModel app\models\PartnerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Partner');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="partner-index">

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
            //['class' => 'yii\grid\SerialColumn'],

            [
				          'attribute' => 'id',
                  'label' => Yii::t('app', 'id_p'),
                  'options' => ['style' => 'width: 50px; max-width: 50px;'],
                  'contentOptions' => ['style' => 'width: 50px; max-width: 50px;'],
                  ],
      			[
      				'attribute' => 'user_id',
      				'label' => Yii::t('app', 'user_id_p'),
              'content'=>function($data){
                    $item = app\models\crm\User::find()->where(['id' => $data->user_id])->one()->username;
                    return $item;
                },
      			],
      			[
      				'attribute' => 'agency_name',
      				'label' => Yii::t('app', 'agency_name_p'),
      			],
            //'first_number',
            //'second_number',
            // 'legal_address',
            // 'actual_address',
            // 'email:email',
            // 'second_email:email',
            // 'director_name',
            // 'license_number',
            // 'agreement',
            // 'image',
            [
                'attribute' => 'status',
                'label' => Yii::t('app', 'status'),
                'filter'=>array("1"=>"Активный","0"=>"Не активный"),
                'value' => function ($model) {
                    return ($model->status == 1) ? Yii::t('app', 'actives') : Yii::t('app', 'not active');
                }
            ],
            // 'created_at',
            // 'updated_at',
            // 'ident',
            // 'contact_name',
            // 'web_site',

            [
              'class' => 'yii\grid\ActionColumn',
              'template' => '{massag} {view} {update} {delete}',
              'options' => ['style' => 'width: 125px; max-width: 125px;'],
              'contentOptions' => ['style' => 'width: 125px; max-width: 125px;'],
                'buttons' => [
                  'massag' => function ($url, $model) {
                      return Html::a(
                        '<i class="fa fa-envelope"></i>',
                        ['/admin/default/pmassage','id'=>$model->id],
                        [
                          'class'=>'btn btn-success btn-xs',
                          'title'=>Yii::t('app', 'singnup-massage'),
                          'data-url'=>Url::to(['admin/partner']),
                          'data-toggle' => 'modal',
                          'data-target' => '#partner-mas',
                          'onclick' => "$('#partner-mas .modal-dialog .modal-content .modal-body').load($(this).attr('href'))",
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
                      return Html::a('<i class="fa fa-trash-o" aria-hidden="true"></i>', $url, [
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
<?php
$js = <<< 'SCRIPT'

SCRIPT;
$this->registerJs($js);
 ?>
