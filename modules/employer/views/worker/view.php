<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\crm\Worker */

$this->title = $model->full_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Workers_a'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="worker-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'full_name',
            [
      				'attribute' => 'gender',
              'value'=>function($model){
                    if ($model->gender == 1) {
                      $items = Yii::t('app', 'Male');
                    }else {
                      $items = Yii::t('app', 'Female');
                    }
                    return $items;
                },
      			],
            'birth_date:date',
            [
      				'attribute' => 'citizenship',
              'visible' => !empty($model->citizenship),
              'value'=>function($model){
                $name = app\models\admin\Citizenship::find()->where(['id' => $model->citizenship])->one()->title_pl;
                return $name;
                },
      			],
            [
      				'attribute' => 'have_visa',
              'value'=>function($model){
                    if ($model->have_visa == 1) {
                      $items = Yii::t('app', 'Yes');
                    }else {
                      $items = Yii::t('app', 'No');
                      $v_type = 0;
                    }
                    return $items;
                },
      			],
            [
              'attribute' => 'visa_type',
              'visible' => ($model->have_visa == 1),
              'value'=>function($model){
                $name = app\models\admin\VisaType::find()->where(['id' => $model->visa_type])->one()->title_pl;
                return $name;
                },
            ],
            'visa_expiration:date',
            'visa_days',
            [
      				'attribute' => 'resident_certificate',
              'value'=>function($model){
                    if ($model->resident_certificate == 1) {
                      $items = Yii::t('app', 'Yes');
                    }else {
                      $items = Yii::t('app', 'No');
                    }
                    return $items;
                },
      			],
            [
      				'attribute' => 'degree',
              'value'=>function($model){
                $name = app\models\admin\Degree::find()->where(['id' => $model->degree])->one()->title_pl;
                return $name;
                },
      			],
            [
              'attribute' => 'profession',
              'visible' => !empty($model->profession),
              'value'=>function($model){
                $profession = explode(";", $model->profession);
                $datas= app\models\admin\Profession::find()->where(['id' => $profession])->select(['title_pl'])->all();
                foreach ($datas as $data) {
                  $items[]=$data->title_pl;
                }
                $name = implode(',', $items);
                return $name;
                },
            ],
            [
              'attribute' => 'polish_knowledge',
              'value'=>function($model){
                $name = app\models\admin\PolishKnowledge::find()->where(['id' => $model->polish_knowledge])->one()->title_pl;
                return $name;
                },
            ],
            [
              'attribute' => 'driver_license',
              'visible' => !empty($model->driver_license),
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
              'attribute' => 'driver_category',
              'visible' => ($model->driver_license == 1),
              'value'=>function($model){
                $items[]='';
                $driver_c = explode(";", $model->driver_category);
                $datas= app\models\admin\DriverCategory::find()->where(['id' => $driver_c])->select(['title'])->all();
                foreach ($datas as $data) {
                  $items[]=$data->title;
                }
                $name = implode(' ', $items);
                return $name;
                },
            ],
            [
              'attribute' => 'resume',
              'format'=>'url',
              'visible' => !empty($model->resume),
              'value' => Html::a('<button class="btn btn-info btn-sm" type="button" data-toggle="modal" data-target="#myResum"><i class="glyphicon glyphicon-camera"></i> '.Yii::t('app', 'Show').' </button>'),
              'format' => 'raw',
            ],
            [
              'attribute' => 'addition_certificate',
              'format'=>'url',
              'visible' => !empty($model->addition_certificate),
              'value' => Html::a('<button class="btn btn-info btn-sm" type="button" data-toggle="modal" data-target="#myCertif"><i class="glyphicon glyphicon-camera"></i> '.Yii::t('app', 'Show').' </button>'),
              'format' => 'raw',
            ],
            [
              'attribute' => 'image',
              'format'=>'url',
              'visible' => !empty($model->image),
              'value' => Html::a('<button class="btn btn-info btn-sm" type="button" data-toggle="modal" data-target="#myImage"><i class="glyphicon glyphicon-camera"></i> '.Yii::t('app', 'Show').' </button>'),
              'format' => 'raw',
            ],
            [
              'attribute' => 'date_agreeded',
              'format'=>'date',
              'visible' => !empty($model->date_agreeded),
            ],
            [
              'attribute' => 'date_start',
              'format'=>'date',
              'visible' => !empty($model->date_start),
            ],
            [
              'attribute' => 'date_finish',
              'format'=>'date',
              'visible' => !empty($model->date_finish),
            ],
            [
      				'attribute' => 'smoke',
              'value'=>function($model){
                    if ($model->smoke == 1) {
                      $items = Yii::t('app', 'Yes');
                    }else {
                      $items = Yii::t('app', 'No');
                    }
                    return $items;
                },
      			],

            [
      				'attribute' => 'steal',
              'value'=>function($model){
                    if ($model->steal == 1) {
                      $items = Yii::t('app', 'Yes');
                    }else {
                      $items = Yii::t('app', 'No');
                    }
                    return $items;
                },
      			],

            [
      				'attribute' => 'team_work',
              'value'=>function($model){
                    if ($model->team_work == 1) {
                      $items = Yii::t('app', 'Yes');
                    }else {
                      $items = Yii::t('app', 'No');
                    }
                    return $items;
                },
      			],

            [
      				'attribute' => 'punctuality',
              'value'=>function($model){
                    if ($model->punctuality == 1) {
                      $items = Yii::t('app', 'Yes');
                    }else {
                      $items = Yii::t('app', 'No');
                    }
                    return $items;
                },
      			],
            [
              'attribute' => 'work_behave',
              'visible' => !empty($model->work_behave),
            ],
            [
              'attribute' => 'employer_opinion',
             'visible' => !empty($model->employer_opinion),
            ],
            [
      				'attribute' => 'alcohol',
              'value'=>function($model){
                    if ($model->alcohol == 1) {
                      $items = Yii::t('app', 'Yes');
                    }else {
                      $items = Yii::t('app', 'No');
                    }
                    return $items;
                },
      			],
            [
      				'attribute' => 'drugs',
              'value'=>function($model){
                    if ($model->drugs == 1) {
                      $items = Yii::t('app', 'Yes');
                    }else {
                      $items = Yii::t('app', 'No');
                    }
                    return $items;
                },
      			],
            [
      				'attribute' => 'is_healthy',
              'value'=>function($model){
                    if ($model->is_healthy == 1) {
                      $items = Yii::t('app', 'Yes');
                    }else {
                      $items = Yii::t('app', 'No');
                    }
                    return $items;
                },
      			],
            [
                  'attribute' => 'statusarchive',
                  'value' => function ($model) {
                    if($model->statusarchive ==4){
                        $statys_1 = '4';
                        $statys_2 = '5';
                        $statys_3 = '100';
                        $statys_4 = '';
                        $disab = false;
                      }elseif($model->statusarchive == 5) {
                        $statys_1 = '5';
                        $statys_2 = '6';
                        $statys_3 = '';
                        $statys_4 = '';
                        $disab = false;
                      }
                      elseif($model->statusarchive == 6) {
                        $statys_1 = '6';
                        $statys_2 = '';
                        $statys_3 = '';
                        $statys_4 = '';
                        $disab = true;
                      }
                      elseif($model->statusarchive == 7) {
                        $statys_1 = '7';
                        $statys_2 = '8';
                        $statys_3 = '';
                        $statys_4 = '';
                        $disab = false;
                      }
                      elseif($model->statusarchive == 8) {
                        $statys_1 = '8';
                        $statys_2 = '';
                        $statys_3 = '';
                        $statys_4 = '';
                        $disab = true;
                      }

                      return Html::activeDropDownList($model, 'statusarchive',

                                          ArrayHelper::map(app\models\admin\StatusWorker::find()->where(['id'=>$statys_1])->orWhere(['id'=>$statys_2])->orWhere(['id'=>$statys_3])->orWhere(['id'=>$statys_4])->all(), 'id', 'title_pl'),


                      [
                        'disabled'=>$disab,
                        'data-id' => $model->id,
                        'id'=>"worker-statusarchive-$model->id",
                        'class'=>'form-control input-sm',
                        'data' => [
                            'confirm' => Yii::t('app', 'Status Regest'),
                          //  'method' => 'post',
                        ],
                        'onchange' => "
                               $.ajax({
                                url: \"/employer/worker/statuse\",
                                type: \"post\",
                        data: { worker_id:  $model->id, statusarchive : $(\"#worker-statusarchive-$model->id\").val()},
                                          });"
                      ]
                    );
                  },
                'format' => 'raw',
              ],

        ],
    ]) ?>

</div>

<div id="myResum" class="modal fade">
<div class="modal-dialog"><div class="modal-content">
<div class="modal-header"><h4 class="modal-title"><?=Yii::t('app', 'resume_w') ?></h4></div>
<div class="modal-body">  <img src="<?=$model->resume ?>" width="100%"></div>
<div class="modal-footer"><button class="btn btn-default" type="button" data-dismiss="modal"><?=Yii::t('app', 'Close') ?></button></div>
</div></div></div>

<div id="myCertif" class="modal fade">
<div class="modal-dialog"><div class="modal-content">
<div class="modal-header"><h4 class="modal-title"><?=Yii::t('app', 'addition_certificate_w') ?></h4></div>
<div class="modal-body">  <img src="<?=$model->addition_certificate ?>" width="100%"></div>
<div class="modal-footer"><button class="btn btn-default" type="button" data-dismiss="modal"><?=Yii::t('app', 'Close') ?></button></div>
</div></div></div>

<div id="myImage" class="modal fade">
<div class="modal-dialog"><div class="modal-content">
<div class="modal-header"><h4 class="modal-title"><?=Yii::t('app', 'image_w') ?></h4></div>
<div class="modal-body">  <img src="<?=$model->image ?>" width="100%"></div>
<div class="modal-footer"><button class="btn btn-default" type="button" data-dismiss="modal"><?=Yii::t('app', 'Close') ?></button></div>
</div></div></div>
