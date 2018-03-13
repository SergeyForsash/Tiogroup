<?php

use yii\helpers\Html;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel app\models\crm\search\VacancySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Vacancies');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vacancy-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
          <?= Html::a('<i class="fa fa-plus-circle" aria-hidden="true"></i> '.Yii::t('app', 'Create Vacancies'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function ($model, $key, $index, $grid) {
            $workers = app\models\crm\Worker::find()
                        ->where(['vacancy_id' => $model->id,'statusarchive' =>4])
                        ->all();
            if(!empty($workers)){
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
               $workers = app\models\crm\Worker::find()
                           ->where(['vacancy_id' => $model->id,'statusarchive' =>4])
                           ->all();
               if (!empty($workers)) {
                   $items = '<a data-toggle="tooltip" title="Wymaga uwagi"><span class="badge" style="background-color: red">&nbsp;</span></a>';
               }else{
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
            //[
      			//	'attribute' => 'company_id',
      			//	'label' => Yii::t('app', 'Company ID'),
            //  'content'=>function($data){
            //        $item = app\models\admin\Company::find()->where(['user_id' => $data->company_id])->one()->firm_name;
            //        return $item;
            //    },
      			//],

            [
      				'attribute' => 'industry_id',
      				'label' => Yii::t('app', 'Industry ID'),
              'content'=>function($data){
                    $item = app\models\admin\Specialisation::find()->where(['id' => $data->industry_id])->one()->title_pl;
                    return $item;
                },
      			],

            //'title',
            'title_pl',
            // 'duties',
            //'duties_pl',
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
                    $item = app\models\admin\City::find()->where(['id' => $data->city_id])->one()->title_pl;
                    return $item;
                },
      			],

            // 'description:ntext',
            // 'description_pl:ntext',
            // 'worker',

            // 'sex',
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
            // 'hourinday',
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
            'date_create:date',

            [
              'class' => 'yii\grid\ActionColumn',
              'template' => '{view} {update}',
              'options' => ['style' => 'width: 80px; max-width: 80px;'],
              'contentOptions' => ['style' => 'width: 80px; max-width: 80px;'],
              'buttons' => [
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
