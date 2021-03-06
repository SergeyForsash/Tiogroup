<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
echo Modal::widget([
    'id' => 'worker-win',
    'toggleButton' => false,
]);
echo Modal::widget([
    'id' => 'worker-mas',
    'toggleButton' => false,
]);
/* @var $this yii\web\View */
/* @var $searchModel app\models\crm\WorkerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Workers_a');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="worker-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'id'=>'worker-grid',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function ($model, $key, $index, $grid) {
            if($model->statusarchive == 2){
                return ['class' => 'work_status'];
            }elseif($model->statusarchive == 3) {
              return ['class' => 'work_corect'];
            }elseif($model->statusarchive == 6) {
              return ['class' => 'work_status'];
            }elseif($model->statusarchive == 8) {
              return ['class' => 'work_status'];
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
               if ($model->statusarchive == 2) {
                   $items = '<a data-toggle="tooltip" title="Требует  внимания"><span class="badge" style="background-color: red">&nbsp;</span></a>';
               }elseif($model->statusarchive == 6) {
                 $items = '<a data-toggle="tooltip" title="Требует  внимания"><span class="badge" style="background-color: red">&nbsp;</span></a>';
               }elseif($model->statusarchive == 8) {
                 $items = '<a data-toggle="tooltip" title="Требует  внимания"><span class="badge" style="background-color: red">&nbsp;</span></a>';
               }elseif($model->statusarchive == 3) {
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
            'options' => ['style' => 'width: 80px; max-width: 80px;'],
            'contentOptions' => ['style' => 'width: 80px; max-width: 80px;'],

          ],

            [
      				'attribute' => 'vacancy_id',
      				'label' => Yii::t('app', 'Vacancy Id'),
              'format'=>'html',
              'options' => ['style' => 'width: 50px; max-width: 50px;'],
              'contentOptions' => ['style' => 'width: 50px; max-width: 50px;'],
              'value'=>function($data){
                    if ($data->vacancy_id == 0) {
                      $items = Yii::t('app', 'Not assigned');
                    }else {
                      $items = Html::a(Yii::t('app', 'Vacancie_#').$data->vacancy_id , '/admin/vacancy/view?id='.$data->vacancy_id,['title'=>Yii::t('app', 'Go Vacancy')]);
                    }
                    return $items;
                },
      			],
            'pass_number',
            'full_name',
            [
      				'attribute' => 'vacancy_id',
      				'label' => Yii::t('app', 'employer'),
              'content'=>function($data){
                    if ($data->vacancy_id !==0) {
                      $vacancy = app\models\crm\Vacancy::find()->where(['id' =>$data->vacancy_id])->one()->company_id;
                      $item = app\models\admin\Company::find()->where(['user_id' => $vacancy])->one()->firm_name;
                    }else{
                      $item= '';
                    }
                    return $item;
                },
                'filter' => app\models\crm\Vacancy::getCompanyList()
      			],
            [
      				'attribute' => 'created_by',
      				'label' => Yii::t('app', 'Agency_w'),
              'content'=>function($data){
                  return $data->getAgencyName();
              },
              'filter' => app\models\crm\Worker::getAgencyList()
      			],
            //'updated_at:date',
            [
      				'attribute' => 'statusarchive',
              'content'=>function($data){
                  return $data->getStatusName();
              },
              'filter' => app\models\crm\Worker::getStatusList()
      			],

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
            //'created_at',
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
            // 'date_start',
            // 'date_finish',
            // 'type_pay',
            // 'rate',
            // 'payed',
            // 'summaagency',
            // 'payedagency',

            [
              'class' => 'yii\grid\ActionColumn',
              'template' => '{massag} {ticket} {view} {update}',
              'options' => ['style' => 'width: 125px; max-width: 125px;'],
              'contentOptions' => ['style' => 'width: 125px; max-width: 125px;'],
              'buttons' => [
                'massag' => function ($url, $model) {
                    return Html::a(
                      '<i class="fa fa-envelope"></i>',
                      ['/admin/default/wmassage','id'=>$model->id],
                      [
                        'class'=>'btn btn-success btn-xs',
                        'title'=>Yii::t('app', 'singnup-massage'),
                        'data-url'=>Url::to(['admin/worker']),
                        'data-toggle' => 'modal',
                        'data-target' => '#worker-mas',
                        'onclick' => "$('#worker-mas .modal-dialog .modal-content .modal-body').load($(this).attr('href'))",
                      ]
                    );
                  },
                'ticket' => function ($url, $model) {
                        return $model->statusarchive !== 2 ? '' : Html::a(
                          '<i class="fa fa-sticky-note"></i>',
                          $url, [
                            'class'=>'btn btn-warning btn-xs',
                            'title'=>Yii::t('app', 'ticket'),
                            'data-toggle' => 'modal',
                            'data-target' => '#worker-win',
                            'onclick' => "$('#worker-win .modal-dialog .modal-content .modal-body').load($(this).attr('href'))",
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
</div>
