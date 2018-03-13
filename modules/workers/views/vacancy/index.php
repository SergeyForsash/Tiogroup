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
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function ($model, $key, $index, $grid) {
          return ['class' => 'text_vacancy'];
          },
        'columns' => [
            [
      				'attribute' => 'id',
              'options' => ['style' => 'width: 100px; max-width: 100px;'],
              'contentOptions' => ['style' => 'width: 100px; max-width: 100px;'],
      			],
            //'company_id',

            [
      				'attribute' => 'industry_id',
      				'label' => Yii::t('app', 'Industry ID'),
              'content'=>function($data){
                    $item = app\models\admin\Specialisation::find()->where(['id' => $data->industry_id])->one()->title;
                    return $item;
                },
      			],
            'title',
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
                      $item = $data->worker - $data->work_add;
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
                }else{
                  $item = Yii::t('app', 'Female_i');
                };
                return  $item;
              },
              'filter'=>array("1"=>Yii::t('app', 'Male_i'),"2"=>Yii::t('app', 'Female_i')),
            ],
            [
              'attribute' => 'description',
              'content'=>function($data){
                if ($data->description == 'need translation') {
                  $item = Yii::t('app', 'need translation');
                }else {
                  $item = $data->description ;
                }
                    return $item;
                },
            ],
            //'title_pl',
            //'duties',
            //'duties_pl',
            // 'description_pl:ntext',
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
              'class' => 'yii\grid\ActionColumn',
              'template' => '{view}',
              'options' => ['style' => 'width: 50px; max-width: 50px;'],
              'contentOptions' => ['style' => 'width: 50px; max-width: 50px;'],
              'buttons' => [
                  'view' => function ($url,$model) {
                      return Html::a('<i class="fa fa-eye" aria-hidden="true"></i>',$url ,['class'=>'btn btn-info btn-xs','title'=>Yii::t('app', 'view')]);
                  },
              ],
            ],
        ],
    ]); ?>
</div>
