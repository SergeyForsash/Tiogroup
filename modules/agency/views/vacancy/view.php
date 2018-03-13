<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\crm\Vacancy */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Vacancies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vacancy-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            //'company_id',
            [
              'attribute' => 'industry_id',
              'visible' => !empty($model->industry_id),
              'value'=>function($model){
                    $item = app\models\admin\Specialisation::find()->where(['id' => $model->industry_id])->one()->title;
                    return $item;
                },
            ],
            [
              'attribute' => 'title',
              'visible' => !empty($model->title),
            ],

            //'title_pl',

            [
              'attribute' => 'duties',
              'visible' => !empty($model->duties),
            ],
            //'duties_pl',
            [
              'attribute' => 'description',
              'format'=>'ntext',
              'visible' => !empty($model->description),
            ],

            //'description_pl:ntext',

            [
              'attribute' => 'worker',
              'visible' => !empty($model->worker),
              'value'=>function($model){
                    $item = $model->worker - $model->work_add;
                    return $item;
                },
            ],
            [
              'attribute' => 'city_id',
              'visible' => !empty($model->city_id),
              'value'=>function($model){
                    $item = app\models\admin\City::find()->where(['id' => $model->city_id])->one()->title;
                    return $item;
                },
            ],
            [
              'attribute' => 'sex',
                'value'=>function($model){
                    if ($model->sex == 1) {
                      $item = Yii::t('app', 'Male');
                    }elseif ($model->sex == 2) {
                      $item = Yii::t('app', 'Female');
                    }elseif ($model->sex == 3) {
                        $item = Yii::t('app', 'Male/Female');
                    }elseif ($model->sex == 4) {
                      $item = Yii::t('app', 'Vapor');
                    }else {
                      $item = Yii::t('app', 'Male/Female/Vapor');
                    }
                    return $item;
                  },
            ],
            [
              'attribute' => 'education_id',
              'visible' => !empty($model->education_id),
              'value'=>function($model){
                    $item = app\models\admin\Degree::find()->where(['id' => $model->education_id])->one()->title;
                    return $item;
                },
            ],
            [
              'attribute' => 'practice',
              'visible' => !empty($model->practice),
            ],

            //'practice_pl',
            [
              'attribute' => 'polish_id',
              'visible' => !empty($model->polish_id),
              'value'=>function($model){
                    $item = app\models\admin\PolishKnowledge::find()->where(['id' => $model->polish_id])->one()->title;
                    return $item;
                },
            ],
            [
              'attribute' => 'age_f',
              'visible' => !empty($model->age_f),
              'label' => Yii::t('app', 'Age'),
              'value'=>function($model){
                    $item = Yii::t('app', 'Age F').' '.$model->age_f.' '.Yii::t('app', 'Age T').' '.$model->age_t;
                    return $item;
                },
            ],


            [
              'attribute' => 'driver_license',
              'value'=>function($model){
                    if ($model->driver_license == 1) {
                      $items = Yii::t('app', 'Yes');
                    }else {
                      $items = Yii::t('app', 'No');
                    }
                    return $items;
                },
            ],
            [
              'attribute' => 'driver_id',
              'visible' =>($model->driver_license == 1),
              'value'=>function($model){
                $items[]='';
                $driver_c = explode(";", $model->driver_id);
                $datas= app\models\admin\DriverCategory::find()->where(['id' => $driver_c])->select(['title'])->all();
                foreach ($datas as $data) {
                  $items[]=$data->title;
                }
                $name = implode(' ', $items);
                return $name;
                },
            ],
            [
              'attribute' => 'o_requirements',
              'visible' => !empty($model->o_requirements),
            ],
            [
              'attribute' => 'ot_requirements',
              'format'=>'ntext',
              'visible' => !empty($model->o_requirements),
            ],
            //'o_requirements_pl',
            //'ot_requirements_pl:ntext',

            [
              'attribute' => 'hourinday',
              'visible' => !empty($model->hourinday),
            ],
            [
      				'attribute' => 'overtime',
              'visible' => !empty($model->overtime),
              'value'=>function($model){
                    if ($model->overtime == 1) {
                      $items = Yii::t('app', 'Yes');
                    }else {
                      $items = Yii::t('app', 'No');
                    }
                    return $items;
                },
      			],
            [
      				'attribute' => 'night_hours',
              'visible' => !empty($model->night_hours),
              'value'=>function($model){
                    if ($model->night_hours == 1) {
                      $items = Yii::t('app', 'Yes');
                    }else {
                      $items = Yii::t('app', 'No');
                    }
                    return $items;
                },
      			],

            [
              'attribute' => 'working_days',
              'visible' => !empty($model->working_days),
            ],
            [
              'attribute' => 'number_shifts',
              'visible' => !empty($model->number_shifts),
            ],

            [
      				'attribute' => 'drive_work',
              'visible' => !empty($model->drive_work),
              'value'=>function($model){
                    if ($model->drive_work == 1) {
                      $items = Yii::t('app', 'Not necessary');
                    }elseif($model->drive_work == 2){
                      $items = Yii::t('app', 'By the employee');
                    }else{
                      $items = Yii::t('app', 'On the employers side');
                    }
                    return $items;
                },
      			],
            [
              'attribute' => 'individual_means',
              'value'=>function($model){
                    if ($model->individual_means == 1) {
                      $items = Yii::t('app', 'Not necessary');
                    }elseif($model->individual_means == 2){
                      $items = Yii::t('app', 'By the employee');
                    }else{
                      $items = Yii::t('app', 'On the employers side');
                    }
                    return $items;
                },
            ],
            [
              'attribute' => 'work_clothes',
              'visible' => ($model->individual_means == 3),
              'value'=>function($model){
                    if ($model->work_clothes == 1) {
                      $items = Yii::t('app', 'Yes');
                    }else {
                      $items = Yii::t('app', 'No');
                    }
                    return $items;
                },
            ],
            [
              'attribute' => 'work_shoes',
              'visible' => ($model->individual_means == 3),
              'value'=>function($model){
                    if ($model->work_shoes == 1) {
                      $items = Yii::t('app', 'Yes');
                    }else {
                      $items = Yii::t('app', 'No');
                    }
                    return $items;
                },
            ],
            [
              'attribute' => 'work_other',
              'format'=>'ntext',
              'visible' => !empty($model->work_other),
            ],
            //'work_other_pl:ntext',
            [
              'attribute' => 'other_expenses',
              'format'=>'ntext',
              'visible' => !empty($model->other_expenses),
            ],
            //'other_expenses_pl:ntext',
            [
      				'attribute' => 'turn_to',
              'visible' => !empty($model->turn_to),
              'value'=>function($model){
                    $items = Yii::$app->formatter->asDate($model->turn_to, 'long');
                    return $items;
                },
      			],
            [
      				'attribute' => 'apartment',
              'visible' => !empty($model->apartment),
              'value'=>function($model){
                    if ($model->apartment == 1) {
                      $items = Yii::t('app', 'By the employee');
                    }else{
                      $items = Yii::t('app', 'On the employers side');
                    }
                    return $items;
                },
      			],
            [
      				'attribute' => 'type_allocation',
              'visible' => ($model->apartment == 2),
              'value'=>function($model){
                if ($model->type_allocation == 1) {
                  $items = Yii::t('app', 'Apartment');
                }elseif($model->type_allocation == 2){
                  $items = Yii::t('app', 'House');
                }else{
                  $items = Yii::t('app', 'Working hotel');
                }
                    return $items;
                },
      			],
              [
        				'attribute' => 'payment_ap',
                'visible' => ($model->apartment == 2),
                'value'=>function($model){
                  if ($model->payment_ap == 1) {
                    $items = Yii::t('app', 'Chargeable');
                  }else {
                    $items = Yii::t('app', 'Free');
                  }
                      return $items;
                  },
        			],
              [
        				'attribute' => 'cost_living',
                'visible' => ($model->payment_ap == 1),
                'value'=>function($model){
                  if($model->apartment == 2){
                      $items = $model->cost_living;
                  }else{
                    $items = '';
                  }
                      return $items;
                  },
        			],
              [
        				'attribute' => 'number_people',
                'visible' => ($model->apartment == 2),
                'value'=>function($model){
                  if($model->apartment == 2){
                      $items = $model->number_people;
                  }else{
                    $items = '';
                  }
                      return $items;
                  },
        			],
              [
                'attribute' => 'bathroom',
                'visible' => ($model->apartment == 2),
                'value'=>function($model){
                  if($model->apartment == 2){
                      if ($model->bathroom == 1) { $items = Yii::t('app', 'Yes'); }
                      else { $items = Yii::t('app', 'No'); }
                    }else{
                      $items = '';
                    }
                      return $items;
                  },
              ],
              [
                'attribute' => 'internet',
                'visible' => ($model->apartment == 2),
                'value'=>function($model){
                  if($model->apartment == 2){
                      if ($model->internet == 1) { $items = Yii::t('app', 'Yes'); }
                      else { $items = Yii::t('app', 'No'); }
                    }else{
                      $items = '';
                    }
                      return $items;
                  },
              ],
              [
                'attribute' => 'kitchen',
                'visible' => ($model->apartment == 2),
                'value'=>function($model){
                  if($model->apartment == 2){
                      if ($model->kitchen == 1) { $items = Yii::t('app', 'Yes'); }
                      else { $items = Yii::t('app', 'No'); }
                    }else{
                      $items = '';
                    }
                      return $items;
                  },
              ],


            [
      				'attribute' => 'aliment',
              'visible' => !empty($model->aliment),
              'value'=>function($model){
                    if ($model->aliment == 1) {
                      $items = Yii::t('app', 'Yes');
                    }else {
                      $items = Yii::t('app', 'No');
                    }
                    return $items;
                },
      			],
            [
      				'attribute' => 'akord',
              'visible' => !empty($model->akord),
              'value'=>function($model){
                    if ($model->aliment == 1) {
                      $items = Yii::t('app', 'Yes');
                    }else {
                      $items = Yii::t('app', 'No');
                    }
                    return $items;
                },
      			],

            [
              'attribute' => 'hourly_rate',
              'visible' => !empty($model->hourly_rate),
            ],
            [
              'attribute' => 'month_salary',
              'visible' => !empty($model->month_salary),
            ],
            [
              'attribute' => 'payment_method',
              'visible' => !empty($model->payment_method),
              'value'=>function($model){
                    if ($model->payment_method == 1) {
                      $items = Yii::t('app', 'Bank card');
                    }else {
                      $items = Yii::t('app', 'Cash payment');
                    }
                    return $items;
                },
            ],
            [
              'attribute' => 'advance_option',
              'visible' => !empty($model->advance_option),
              'value'=>function($model){
                    if ($model->advance_option == 1) {
                      $items = Yii::t('app', 'Yes');
                    }else {
                      $items = Yii::t('app', 'No');
                    }
                    return $items;
                },
            ],
            [
              'attribute' => 'billing_period',
              'visible' => !empty($model->billing_period),
              'value'=>function($model){
                    if ($model->billing_period == 1) {
                      $items = Yii::t('app', 'Week');
                    }elseif($model->billing_period == 2){
                      $items = Yii::t('app', 'Two weeks');
                    }else{
                      $items = Yii::t('app', 'Month');
                    }
                    return $items;
                },
            ],
            [
              'attribute' => 'video',
              'visible' => !empty($model->video),
              'value' => Html::a('<i class="fa fa-play-circle" style="font-size: 20px;"></i> '.Yii::t('app', 'Play Video'), ($model->video), ['target' => '_blank','title'=>Yii::t('app', 'Play Video')]),
              'format' => 'raw',
            ],
            [
              'attribute' => 'image',
              'format'=>'url',
              'visible' => !empty($model->image),
              'value' => Html::a('<button class="btn btn-info btn-sm" type="button" data-toggle="modal" data-target="#vImg">
              <i class="glyphicon glyphicon-camera"></i> Показать </button>'),
              'format' => 'raw',
            ],
        ],
    ]) ?>

</div>
<?php $date = app\models\crm\VacancyWorker::find()
      ->where(['vacancy_id' => $model->id])->all();
if(!empty($date)) { ?>
<hr>
<p class="h3 text-center info-h"><?= Yii::t('app', '(Not) Agreed employees') ?> </p>
<div class="vacancy-create">

    <?= $this->render('_worker.php', [
        'dataProvider' => $dataProvider,
    ]) ?>

</div>
<?php } ?>
<div id="vImg" class="modal fade">
<div class="modal-dialog"><div class="modal-content">
<div class="modal-header"><h4 class="modal-title"><?=Yii::t('app', 'image_w') ?></h4></div>
<div class="modal-body">  <img src="<?=$model->image ?>" width="100%"></div>
<div class="modal-footer"><button class="btn btn-default" type="button" data-dismiss="modal">Закрыть</button></div>
</div></div></div>
