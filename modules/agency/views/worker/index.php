<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\crm\WorkerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Workers_a');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="worker-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function ($model, $key, $index, $grid) {
            if($model->statusarchive == 3){
                return ['class' => 'work_corect'];
            }else{
              return ['class' => 'text_vacancy'];
            };
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
               }else {
                 $items ='';
               }
               return  $items;
             },
               'filter' => ''
           ],
            [
              'attribute' => 'id',
              'options' => ['style' => 'width: 100px; max-width: 50px;'],
              'contentOptions' => ['style' => 'width: 100px; max-width: 50px;'],
            ],
            'full_name',

            'pass_number',
            [
      				'attribute' => 'vacancy_id',
              'label' => Yii::t('app', 'Vacancy Id'),
              'format'=>'html',
              'value'=>function($data){
                    if ($data->vacancy_id == 0) {
                      $items = Yii::t('app', 'Not assigned');
                    }else {
                      $items = Html::a(Yii::t('app', 'Vacancie_#').$data->vacancy_id , '/agency/vacancy/view?id='.$data->vacancy_id,['title'=>Yii::t('app', 'Go Vacancy')]);
                    }
                    return $items;
                },
      			],
            [
              'attribute' => 'statusarchive',
              'content'=>function($data){
                  return $data->getStatusName();
              },
              'filter' => app\models\crm\Worker::getStatusList()
            ],
            //'updated_at:date',
            //'id',
            //'gender',
            //'birth_date',
            //'citizenship',
            // 'legal_location',
            // 'polish_location',

            // 'date_of_issue',
            // 'date_of_expiration',
            // 'pass_supplier',
            // 'have_visa',
            // 'visa_type',
            // 'visa_expiration',
            // 'visa_days',
            // 'resident_certificate',
            // 'degree',
            // 'profession',
            // 'specialisation',
            // 'degree_specialisation',
            // 'mobile_number',
            // 'email:email',
            // 'polish_knowledge',
            // 'driver_license',
            // 'driver_category',
            // 'active',
            // 'pass_scan',
            // 'visa_scan',
            // 'resume',
            // 'addition_certificate',
            // 'image',
            // 'created_at',
            // 'created_by',
            // 'smoke',
            // 'steal',
            // 'team_work',
            // 'punctuality',
            // 'work_behave',
            // 'employer_opinion',
            // 'alcohol',
            // 'drugs',
            // 'is_healthy',
            // 'medical_board',
            // 'insurance',
            // 'number_period',
            // 'is_working',
            // 'working_status',
            // 'working_agreement_start',
            // 'working_agreement',
            // 'employer',
            // 'polish_number',
            // 'ident',
            // 'agency_name',
            // 'date_agreeded',
             'date_start:date',
            // 'date_finish',
            // 'type_pay',
            // 'rate',
            // 'payed',
            // 'summaagency',
            // 'payedagency',

            [
              'class' => 'yii\grid\ActionColumn',
              'options' => ['style' => 'width: 100px; max-width: 100px;'],
              'contentOptions' => ['style' => 'width: 100px; max-width: 100px;'],
              'buttons' => [
                'view' => function ($url,$model) {
                    return Html::a('<i class="fa fa-eye" aria-hidden="true"></i>',$url ,['class'=>'btn btn-info btn-xs','title'=>Yii::t('app', 'view')]);
                },
                'update' => function ($url,$model) {
                    return $model->statusarchive >=5 ? '' : Html::a('<i class="fa fa-pencil" aria-hidden="true"></i>',$url ,['class'=>'btn btn-primary btn-xs','title'=>Yii::t('app', 'update')]);
                },
                'delete' => function ($url,$model) {
                    return $model->statusarchive > 2 ? '' : Html::a('<i class="fa fa-trash-o" aria-hidden="true"></i>', ['delete', 'id' => $model->id], [
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
