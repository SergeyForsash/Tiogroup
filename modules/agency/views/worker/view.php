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


  <p>
    <?php if ($model->statusarchive >=5) { ?>
    <?php  }else{?>
  <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <?php  }?>
      <?php if ($model->statusarchive < 2) { ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    <?php  }?>
  </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
              'attribute' => 'full_name',
              'visible' => !empty($model->full_name),
            ],
            [
              'attribute' => 'ident',
              'visible' => !empty($model->ident),
            ],
            [
      				'attribute' => 'gender',
              'visible' => !empty($model->gender),
              'value'=>function($model){
                    if ($model->gender == 1) {
                      $items = Yii::t('app', 'Male');
                    }else {
                      $items = Yii::t('app', 'Female');
                    }
                    return $items;
                },
      			],
            [
              'attribute' => 'birth_date',
              'format'=>'date',
              'visible' => !empty($model->birth_date),
            ],
            [
      				'attribute' => 'citizenship',
              'visible' => !empty($model->citizenship),
              'value'=>function($model){
                $name = app\models\admin\Citizenship::find()->where(['id' => $model->citizenship])->one()->title;
                return $name;
                },
      			],
            [
              'attribute' => 'legal_location',
              'visible' => !empty($model->legal_location),
            ],
            [
              'attribute' => 'pass_number',
              'visible' => !empty($model->pass_number),
            ],
            [
              'attribute' => 'date_of_issue',
              'format'=>'date',
              'visible' => !empty($model->date_of_issue),
            ],
            [
              'attribute' => 'date_of_expiration',
              'format'=>'date',
              'visible' => !empty($model->date_of_expiration),
            ],
            [
              'attribute' => 'pass_supplier',
              'visible' => !empty($model->pass_supplier),
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
                $name = app\models\admin\VisaType::find()->where(['id' => $model->visa_type])->one()->title;
                return $name;
                },
            ],

            [
              'attribute' => 'visa_expiration',
              'format'=>'date',
              'visible' => !empty($model->visa_days),
            ],
            [
              'attribute' => 'visa_days',
              'visible' => !empty($model->visa_days),
            ],
            [
      				'attribute' => 'resident_certificate',
              'visible' => !empty($model->resident_certificate),
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
              'visible' => !empty($model->degree),
              'value'=>function($model){
                $name = app\models\admin\Degree::find()->where(['id' => $model->degree])->one()->title;
                return $name;
                },
      			],


            [
              'attribute' => 'specialisation',
              'visible' => !empty($model->specialisation),
              'label'=>Yii::t('app', 'Industry ID'),
              'value'=>function($model){
                $name = app\models\admin\Specialisation::find()->where(['id' => $model->specialisation])->one()->title;
                return $name;
                },
            ],
            [
              'attribute' => 'profession',
              'visible' => !empty($model->profession),
              'value'=>function($model){
                $profession = explode(";", $model->profession);
                $datas= app\models\admin\Profession::find()->where(['id' => $profession])->select(['title'])->all();
                foreach ($datas as $data) {
                  $items[]=$data->title;
                }
                $name = implode(',', $items);
                return $name;
                },
            ],
            [
              'attribute' => 'mobile_number',
              'visible' => !empty($model->mobile_number),
            ],
            [
              'attribute' => 'email',
              'format'=>'email',
              'visible' => !empty($model->email),
            ],

            [
              'attribute' => 'polish_knowledge',
              'visible' => !empty($model->polish_knowledge),
              'value'=>function($model){
                $name = app\models\admin\PolishKnowledge::find()->where(['id' => $model->polish_knowledge])->one()->title;
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
          //  [
          //    'attribute' => 'active',
          //    'visible' => !empty($model->active),
          //    'value'=>function($model){
          //          if ($model->active == 1) {
          //            $items = Yii::t('app', 'actives');
          //          }else {
          //            $items = Yii::t('app', 'not active');
          //          }
          //          return $items;
          // },
          //],
            [
              'attribute' => 'pass_scan',
              'format'=>'url',
              'visible' => !empty($model->pass_scan),
              'value' => Html::a('<button class="btn btn-info btn-sm" type="button" data-toggle="modal" data-target="#myPass"><i class="glyphicon glyphicon-camera"></i> Показать </button>'),
              'format' => 'raw',

            ],
            [
              'attribute' => 'visa_scan',
              'format'=>'url',
              'visible' => !empty($model->visa_scan),
              'value' => Html::a('<button class="btn btn-info btn-sm" type="button" data-toggle="modal" data-target="#myVisa"><i class="glyphicon glyphicon-camera"></i> Показать </button>'),
              'format' => 'raw',
            ],
            [
              'attribute' => 'resume',
              'format'=>'url',
              'visible' => !empty($model->resume),
              'value' => Html::a('<button class="btn btn-info btn-sm" type="button" data-toggle="modal" data-target="#myResum"><i class="glyphicon glyphicon-camera"></i> Показать </button>'),
              'format' => 'raw',
            ],
            [
              'attribute' => 'addition_certificate',
              'format'=>'url',
              'visible' => !empty($model->addition_certificate),
              'value' => Html::a('<button class="btn btn-info btn-sm" type="button" data-toggle="modal" data-target="#myCertif"><i class="glyphicon glyphicon-camera"></i> Показать </button>'),
              'format' => 'raw',
            ],
            [
              'attribute' => 'image',
              'format'=>'url',
              'visible' => !empty($model->image),
              'value' => Html::a('<button class="btn btn-info btn-sm" type="button" data-toggle="modal" data-target="#myImage"><i class="glyphicon glyphicon-camera"></i> Показать </button>'),
              'format' => 'raw',
            ],
            [
              'attribute' => 'created_at',
              'format'=>'date',
              'visible' => !empty($model->created_at),
            ],
            [
              'attribute' => 'updated_at',
              'format'=>'date',
              'visible' => !empty($model->updated_at),
            ],

            [
                  'attribute' => 'statusarchive',
                  'value' => function ($model) {
                    if ($model->statusarchive == 2) {
                        $statys_1 = '2';
                        $statys_2 = '3';
                        $statys_3 = '4';
                        $statys_4 = '100';
                        $disab = true;
                      }elseif($model->statusarchive ==3){
                        $statys_1 = '3';
                        $statys_2 = '2';
                        $statys_3 = '';
                        $statys_4 = '';
                        $disab = false;
                      }elseif($model->statusarchive ==4){
                        $statys_1 = '4';
                        $statys_2 = '';
                        $statys_3 = '';
                        $statys_4 = '';
                        $disab = true;
                      }elseif($model->statusarchive == 5) {
                        $statys_1 = '5';
                        $statys_2 = '';
                        $statys_3 = '';
                        $statys_4 = '';
                        $disab = true;
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
                        $statys_2 = '';
                        $statys_3 = '';
                        $statys_4 = '';
                        $disab = true;
                      }
                      elseif($model->statusarchive == 8) {
                        $statys_1 = '';
                        $statys_2 = '';
                        $statys_3 = '';
                        $statys_4 = '';
                        $disab = true;
                      }elseif($model->statusarchive == 1) {
                        $statys_1 = '1';
                        $statys_2 = '';
                        $statys_3 = '';
                        $statys_4 = '';
                        $disab = true;
                      }else{
                        $statys_1 = '';
                        $statys_2 = '';
                        $statys_3 = '';
                        $statys_4 = '';
                        $disab = true;
                      }
                      $stays_default =  ArrayHelper::map(app\models\admin\StatusWorker::find()->where(['id'=>$statys_1])->orWhere(['id'=>$statys_2])->orWhere(['id'=>$statys_3])->orWhere(['id'=>$statys_4])->all(), 'id', 'title');
                      return Html::activeDropDownList($model, 'statusarchive', $stays_default ,
                      [
                        'visible' => !empty($stays_default ),
                        'disabled'=>$disab,
                        'data-id' => $model->id,
                        'id'=>"worker-statusarchive-$model->id",
                        'class'=>'form-control input-sm',
                        'data' => [
                            'confirm' => Yii::t('app', 'Status Regest'),
                            'method' => 'post',
                        ],
                        'onchange' => "
                               $.ajax({
                                url: \"/agency/worker/statuse\",
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

<div id="myPass" class="modal fade">
<div class="modal-dialog"><div class="modal-content">
<div class="modal-header"><h4 class="modal-title"><?=Yii::t('app', 'pass_scan_w')?></h4></div>
<div class="modal-body"><img src="<?=$model->pass_scan ?>" width="100%"></div>
<div class="modal-footer"><button class="btn btn-default" type="button" data-dismiss="modal">Закрыть</button></div>
</div></div></div>

<div id="myVisa" class="modal fade">
<div class="modal-dialog"><div class="modal-content">
<div class="modal-header"><h4 class="modal-title"><?=Yii::t('app', 'visa_scan_w') ?></h4></div>
<div class="modal-body">  <img src="<?=$model->visa_scan ?>" width="100%"></div>
<div class="modal-footer"><button class="btn btn-default" type="button" data-dismiss="modal">Закрыть</button></div>
</div></div></div>

<div id="myResum" class="modal fade">
<div class="modal-dialog"><div class="modal-content">
<div class="modal-header"><h4 class="modal-title"><?=Yii::t('app', 'resume_w') ?></h4></div>
<div class="modal-body">  <img src="<?=$model->resume ?>" width="100%"></div>
<div class="modal-footer"><button class="btn btn-default" type="button" data-dismiss="modal">Закрыть</button></div>
</div></div></div>

<div id="myCertif" class="modal fade">
<div class="modal-dialog"><div class="modal-content">
<div class="modal-header"><h4 class="modal-title"><?=Yii::t('app', 'addition_certificate_w') ?></h4></div>
<div class="modal-body">  <img src="<?=$model->addition_certificate ?>" width="100%"></div>
<div class="modal-footer"><button class="btn btn-default" type="button" data-dismiss="modal">Закрыть</button></div>
</div></div></div>

<div id="myImage" class="modal fade">
<div class="modal-dialog"><div class="modal-content">
<div class="modal-header"><h4 class="modal-title"><?=Yii::t('app', 'image_w') ?></h4></div>
<div class="modal-body">  <img src="<?=$model->image ?>" width="100%"></div>
<div class="modal-footer"><button class="btn btn-default" type="button" data-dismiss="modal">Закрыть</button></div>
</div></div></div>
