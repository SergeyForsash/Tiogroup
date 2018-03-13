<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
echo Modal::widget([
    'id' => 'vacancy-win',
    'toggleButton' => false,
]);
/* @var $this yii\web\View */
/* @var $searchModel app\models\crm\search\VacancySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Vacancies');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vacancy-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function ($model, $key, $index, $grid) {
            $workers = app\models\crm\Worker::find()
                        ->where(['vacancy_id' => $model->id,'statusarchive' =>2])
                        ->orWhere(['vacancy_id' => $model->id,'statusarchive' =>6])
                        ->orWhere(['vacancy_id' => $model->id,'statusarchive' =>8])
                        ->all();
            $corect = app\models\crm\Worker::find()
                      ->where(['vacancy_id' => $model->id,'statusarchive' =>3])
                      ->all();
            if(!empty($workers)){
                return ['class' => 'work_status'];
            }elseif(!empty($corect)) {
              return ['class' => 'work_corect'];
            }elseif($model->title == 'need translation') {
              return ['class' => 'translation_vacancy'];
            }else{
              return ['class' => 'text_vacancy'];
            };

          },

        'columns' => [

            //['class' => 'yii\grid\SerialColumn'],


            [
               'attribute' => 'id',
               'options' => ['style' => 'width: 50px; max-width: 50px;'],
               'contentOptions' => ['style' => 'width: 50px; max-width: 50px;'],
               'label'=>'',
               'format'=>'html',
               'value' => function($model) {
                 $workers = app\models\crm\Worker::find()
                             ->where(['vacancy_id' => $model->id,'statusarchive' =>2])
                             ->orWhere(['vacancy_id' => $model->id,'statusarchive' =>6])
                             ->orWhere(['vacancy_id' => $model->id,'statusarchive' =>8])
                             ->all();
                 $corect = app\models\crm\Worker::find()
                             ->where(['vacancy_id' => $model->id,'statusarchive' =>3])
                             ->all();
                 if (!empty($workers)) {
                     $items = '<a data-toggle="tooltip" title="Требует внимания"><span class="badge" style="background-color: red">&nbsp;</span></a>';
                 }elseif($model->title == 'need translation') {
                   $items = '<a data-toggle="tooltip" title="Нужен перевод"><span class="badge" style="background-color: #0b5fe2">&nbsp;</span></a>';
                 }elseif(!empty($corect)) {
                   $items = '<a data-toggle="tooltip" title="Требует редактирования данных"><span class="badge" style="background-color:#ffe200">&nbsp;</span></a>';
                 }else{
                   $items ='';
                 }
                 return  $items;
               },
                 'filter' => ''
             ],
             [
               'attribute' => 'id',
               'options' => ['style' => 'width: 100px; max-width: 100px;'],
               'contentOptions' => ['style' => 'width: 100px; max-width: 100px;'],
             ],
            [
      				'attribute' => 'title',
              'content'=>function($data){
                if ($data->title == 'need translation') {
                  $item = Yii::t('app', 'need translation');
                }else {
                  $item = $data->title ;
                }
                    return $item;
                },
      			],
            [
      				'attribute' => 'industry_id',
      				'label' => Yii::t('app', 'Industry ID'),
              'content'=>function($data){
                  return $data->getSpecialisationName();
              },
              'filter' => app\models\crm\Vacancy::getSpecialisationList()
      			],

            //'title_pl',
            // 'duties',
            // 'duties_pl',


            [
              'attribute' => 'company_id',
              'label' => Yii::t('app', 'employer'),
              'content'=>function($data){
                    $item = app\models\admin\Company::find()->where(['user_id' => $data->company_id])->one()->firm_name;
                    return $item;
                },
              'filter' => app\models\crm\Vacancy::getCompanyList()
            ],
            // 'description_pl:ntext',

            [
              'attribute' => 'worker',
              'options' => ['style' => 'width: 100px; max-width: 100px;'],
              'contentOptions' => ['style' => 'width: 100px; max-width: 100px;'],
              'label' => Yii::t('app', 'Worker_V'),
              'content'=>function($data){
                    if ($data->work_add == $data->worker && $data->worker !== 0 ) {
                        $item = Yii::t('app', 'Closed');
                    }elseif ($data->worker == 0 ) {
                        $item = Yii::t('app', 'Not indicated');
                    }else {
                      $item = $data->work_add.' '.Yii::t('app', 'Z').' '.$data->worker;
                    }
                    return $item;
                },
            ],
            [
              'attribute' => 'city_id',
              'content'=>function($data){
                  return $data->getCityName();
              },
              'filter' => app\models\crm\Vacancy::getCityList()
            ],

            [
              'attribute' => 'sex',
              'options' => ['style' =>'min-width: 130px;'],
              'contentOptions' => ['style' => 'min-width: 130px;'],
              'label' => Yii::t('app', 'Sex'),
              'content' => function($data) {
                if($data->sex == 1){
                  $item = Yii::t('app', 'Male_i');
                }elseif($data->sex == 2){
                  $item = Yii::t('app', 'Female_i');
                }elseif($data->sex == 3){
                  $item = Yii::t('app', 'Vapor');
                }elseif($data->sex == 4){
                  $item = Yii::t('app', 'Male/Female_i');
                }else{
                  $item = Yii::t('app', 'Male/Female/Vapor_i');
                };
                return  $item;
              },
              'filter'=>array(
                "1"=>Yii::t('app', 'Male_i'),
                "2"=>Yii::t('app', 'Female_i'),
                "3"=>Yii::t('app', 'Vapor'),
                "4"=>Yii::t('app', 'Male/Female_i'),
                "5"=>Yii::t('app', 'Male/Female/Vapor_i'),
              ),
            ],
            //[
            //  'attribute' => 'description',
            //  'content'=>function($data){
            //    if ($data->description == 'need translation') {
            //      $item = Yii::t('app', 'need translation');
            //    }else {
            //      $item = $data->description ;
            //    }
            //        return $item;
            //    },
            //],
            // 'education_id',
            // 'practice',
            // 'practice_pl',
            // 'polish_id',
            // 'age_f',
            // 'age_t',
            // 'driver_id',
            // 'o_requirements',
            // 'ot_requirements:ntext',
            // 'o_requirements_pl',
            // 'ot_requirements_pl:ntext',

             [
       				'attribute' => 'hourinday',
              'label' => Yii::t('app', 'Hourinday_V'),
               'options' => ['style' => 'width: 60px; max-width: 60px;'],
               'contentOptions' => ['style' => 'width: 60px; max-width: 60px;'],
       			],
            // 'overtime:datetime',
            // 'night_hours',
            // 'working_days',
            // 'number_shifts',
            // 'drive_work',
            // 'individual_means',
            // 'work_clothes',
            // 'work_shoes',
            // 'work_other:ntext',
            // 'work_other_pl:ntext',
            // 'other_expenses:ntext',
            // 'other_expenses_pl:ntext',
            // 'turn_to',
            // 'apartment',
            // 'type_allocation',
            // 'payment_ap',
            // 'cost_living',
            // 'number_people',
            // 'bathroom',
            // 'internet',
            // 'kitchen',
            // 'aliment',
            // 'akord',
            // 'hourly_rate:url',
            // 'month_salary',
            // 'payment_method',
            // 'advance_option',
            // 'billing_period',
            [
              'attribute' => 'status',
              'options' => ['style' => 'width: 150px; max-width: 150px;'],
              'contentOptions' => ['style' => 'width: 150px; max-width: 150px;'],
              'content'=>function($data){
                $id=$data->status;
                if ($id == '1') {
                 $data = 'info' ;
                }elseif ($id == '2') {
                  $data = 'danger';
                }elseif ($id == '3') {
                  $data = 'warning';
                }elseif ($id == '4') {
                  $data = 'success';
                }elseif ($id == '5') {
                  $data = 'default';
                }
                    $item = '<span class="label label-'.$data.'" style="margin-top:2px">'.app\models\crm\Vacancy::getStatusName($id).'</span>';
                    return $item;
                },
                'filter' => app\models\crm\Vacancy::getStatus(),
            ],
            [
              'class' => 'yii\grid\ActionColumn',
              'template' => '{ticket} {view} {update}',
              'options' => ['style' => 'width: 100px; max-width: 100px;'],
              'contentOptions' => ['style' => 'width: 100px; max-width: 100px;'],
              'buttons' => [
                'ticket' => function ($url, $model) {
                        return $model->status  >= '3' ? '' :Html::a(
                          '<i class="fa fa-sticky-note"></i>',
                          $url, [
                            'class'=>'btn btn-warning btn-xs',
                            'title'=>Yii::t('app', 'ticket'),
                            'data-toggle' => 'modal',
                            'data-target' => '#vacancy-win',
                            'onclick' => "$('#vacancy-win .modal-dialog .modal-content .modal-body').load($(this).attr('href'))",
                          ]
                        );
                      },
                  'view' => function ($url,$model) {
                      return Html::a('<i class="fa fa-eye" aria-hidden="true"></i>',$url ,['class'=>'btn btn-info btn-xs','title'=>Yii::t('app', 'view')]);
                  },
                  'update' => function ($url,$model) {
                      return Html::a('<i class="fa fa-pencil" aria-hidden="true"></i>',$url ,['class'=>'btn btn-primary btn-xs','title'=>Yii::t('app', 'update')]);
                  },
              ],
            ],
        ],
    ]); ?>
</div>
