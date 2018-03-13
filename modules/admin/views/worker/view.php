<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\components\PamentsWidget;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\crm\Worker */

$this->title = $model->full_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Workers_a'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

  <ul class="nav nav-tabs nav-justified">
    <li class="active"><a data-toggle="tab" href="#data"><strong>Данные</strong></a></li>
    <li><a data-toggle="tab" href="#pay"><strong>Платежи</strong></a></li>
  </ul>
  <div class="tab-content">
    <div id="data" class="tab-pane fade  in active">
      <div class="worker-view">
          <p class="h3 text-center info-h">Данные</p>
        <p>
            <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        </p>
  <hr>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'full_name',
            [
              'attribute' => 'ident',
              'visible' => !empty($model->ident),
            ],
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
            'birth_date',
            [
      				'attribute' => 'citizenship',
              'visible' => !empty($model->citizenship),
              'value'=>function($model){
                $name = app\models\admin\Citizenship::find()->where(['id' => $model->citizenship])->one()->title;
                return $name;
                },
      			],
            'legal_location',

            [
              'attribute' => 'polish_location',
              'visible' => !empty($model->polish_location),
            ],
            'pass_number',
            'date_of_issue',
            'date_of_expiration',
            'pass_supplier',
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
            'visa_expiration',
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
            'mobile_number',
            'email:email',
            [
              'attribute' => 'polish_knowledge',
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
            [
              'attribute' => 'active',
              'visible' => !empty($model->active),
              'value'=>function($model){
                    if ($model->active == 1) {
                      $items = Yii::t('app', 'actives');
                    }else {
                      $items = Yii::t('app', 'not active');
                    }
                    return $items;

                },
            ],
            [
              'attribute' => 'pass_scan',
              'format'=>'raw',
              'visible' => !empty($model->pass_scan),
              'value'=>function($model){
                $path_parts = pathinfo($model->pass_scan);
                if ($path_parts['extension'] == 'jpg') {
                  $items = Html::a('<button class="btn btn-info btn-sm" type="button" data-toggle="modal" data-target="#myPass"><i class="fa fa-file-image-o"></i> Показать </button>');
                }elseif ($path_parts['extension'] == 'png') {
                  $items = Html::a('<button class="btn btn-info btn-sm" type="button" data-toggle="modal" data-target="#myPass"><i class="fa fa-file-image-o"></i> Показать </button>');
                }elseif ($path_parts['extension'] == 'jpeg') {
                  $items = Html::a('<button class="btn btn-info btn-sm" type="button" data-toggle="modal" data-target="#myPass"><i class="fa fa-file-image-o"></i> Показать </button>');
                }elseif ($path_parts['extension'] == 'pdf'){
                  $url=$model->pass_scan;
                  $items = Html::a('<i class="fa fa-file-pdf-o"></i> Показать', $url,['class'=>'btn btn-info btn-sm','target'=>'_blank']);
                }else{
                  $url=$model->pass_scan;
                  $items = Html::a('<i class="fa fa-file-word-o"></i> Скачать', $url,['class'=>'btn btn-info btn-sm']);
                }
               return $items;
             },
            ],
            [
              'attribute' => 'visa_scan',
              'format'=>'raw',
              'visible' => !empty($model->visa_scan),
              'value'=>function($model){
                $path_parts = pathinfo($model->visa_scan);
                $url=$model->visa_scan;
                $modal = Html::a('<button class="btn btn-info btn-sm" type="button" data-toggle="modal" data-target="#myVisa"><i class="fa fa-file-image-o"></i> Показать </button>');
                if ($path_parts['extension'] == 'jpg') {
                  $items = $modal;
                }elseif ($path_parts['extension'] == 'png') {
                  $items = $modal;
                }elseif ($path_parts['extension'] == 'jpeg') {
                  $items = $modal;
                }elseif ($path_parts['extension'] == 'pdf'){
                  $items = Html::a('<i class="fa fa-file-pdf-o"></i> Показать', $url,['class'=>'btn btn-info btn-sm','target'=>'_blank']);
                }else{
                  $items = Html::a('<i class="fa fa-file-word-o"></i> Скачать', $url,['class'=>'btn btn-info btn-sm']);
                }
               return $items;
             },
            ],
            [
              'attribute' => 'resume',
              'format'=>'raw',
              'visible' => !empty($model->resume),
              'value'=>function($model){
                $path_parts = pathinfo($model->resume);
                $url=$model->resume;
                $modal = Html::a('<button class="btn btn-info btn-sm" type="button" data-toggle="modal" data-target="#myResum"><i class="fa fa-file-image-o"></i> Показать </button>');
                if ($path_parts['extension'] == 'jpg') {
                  $items = $modal;
                }elseif ($path_parts['extension'] == 'png') {
                  $items = $modal;
                }elseif ($path_parts['extension'] == 'jpeg') {
                  $items = $modal;
                }elseif ($path_parts['extension'] == 'pdf'){
                  $items = Html::a('<i class="fa fa-file-pdf-o"></i> Показать', $url,['class'=>'btn btn-info btn-sm','target'=>'_blank']);
                }else{
                  $items = Html::a('<i class="fa fa-file-word-o"></i> Скачать', $url,['class'=>'btn btn-info btn-sm']);
                }
               return $items;
             },
            ],
            [
              'attribute' => 'addition_certificate',
              'format'=>'raw',
              'visible' => !empty($model->addition_certificate),
              'value'=>function($model){
                $path_parts = pathinfo($model->addition_certificate);
                $url=$model->addition_certificate;
                $modal = Html::a('<button class="btn btn-info btn-sm" type="button" data-toggle="modal" data-target="#myCertif"><i class="fa fa-file-image-o"></i> Показать </button>');
                if ($path_parts['extension'] == 'jpg') {
                    $items = $modal;
                }elseif ($path_parts['extension'] == 'png') {
                  $items = $modal;
                }elseif ($path_parts['extension'] == 'jpeg') {
                  $items = $modal;
                }elseif ($path_parts['extension'] == 'pdf'){
                  $items = Html::a('<i class="fa fa-file-pdf-o"></i> Показать', $url,['class'=>'btn btn-info btn-sm','target'=>'_blank']);
                }else{
                  $items = Html::a('<i class="fa fa-file-word-o"></i> Скачать', $url,['class'=>'btn btn-info btn-sm']);
                }
               return $items;
             },
            ],
            [
              'attribute' => 'image',
              'format'=>'raw',
              'visible' => !empty($model->image),
              'visible' => !empty($model->addition_certificate),
              'value'=>function($model){
                $path_parts = pathinfo($model->addition_certificate);
                $url = $model->addition_certificate;
                  $modal = Html::a('<button class="btn btn-info btn-sm" type="button" data-toggle="modal" data-target="#myImage"><i class="fa fa-file-image-o"></i> Показать </button>');
                if ($path_parts['extension'] == 'jpg') {
                  $items = $modal;
                }elseif ($path_parts['extension'] == 'png') {
                  $items = $modal;
                }elseif ($path_parts['extension'] == 'jpeg') {
                  $items = $modal;
                }elseif ($path_parts['extension'] == 'pdf'){
                  $items = Html::a('<i class="fa fa-file-pdf-o"></i> Показать', $url,['class'=>'btn btn-info btn-sm','target'=>'_blank']);
                }else{
                  $items = Html::a('<i class="fa fa-file-word-o"></i> Скачать', $url,['class'=>'btn btn-info btn-sm']);
                }
               return $items;
             },
            ],
            [
              'attribute' => 'created_at',
              'visible' => !empty($model->created_at),
            ],
            [
              'attribute' => 'updated_at',
              'visible' => !empty($model->updated_at),
            ],
            [
      				'attribute' => 'created_by',
              'value'=>function($model){
                $name = app\models\crm\User::find()->where(['id' => $model->created_by])->one()->username;
                return $name;
                },
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
              'visible' => !empty($model->is_healthy),
            ],
            [
              'attribute' => 'medical_board',
              'format' => 'raw',
              'visible' => !empty($model->medical_board),
              'value'=>function($model){
                $path_parts = pathinfo($model->medical_board);
                $url=$model->medical_board;
                $modal = Html::a('<button class="btn btn-info btn-sm" type="button" data-toggle="modal" data-target="#myMed"><i class="fa fa-file-image-o"></i> Показать </button>');
                if ($path_parts['extension'] == 'jpg') {
                  $items = $modal;
                }elseif ($path_parts['extension'] == 'png') {
                  $items = $modal;
                }elseif ($path_parts['extension'] == 'jpeg') {
                  $items = $modal;
                }elseif ($path_parts['extension'] == 'pdf'){
                  $url=$model->medical_board;
                  $items = Html::a('<i class="fa fa-file-pdf-o"></i> Показать', $url,['class'=>'btn btn-info btn-sm','target'=>'_blank']);
                }else{
                  $items = Html::a('<i class="fa fa-file-word-o"></i> Скачать', $url,['class'=>'btn btn-info btn-sm']);
                }
               return $items;
             },
            ],
            [
              'attribute' => 'insurance',
              'format' => 'raw',
              'visible' => !empty($model->insurance),
              'value'=>function($model){
                $path_parts = pathinfo($model->insurance);
                $url=$model->insurance;
                $modal=Html::a('<button class="btn btn-info btn-sm" type="button" data-toggle="modal" data-target="#myIns"><i class="fa fa-file-image-o"></i> Показать </button>');
                if ($path_parts['extension'] == 'jpg') {
                  $items = $modal;
                }elseif ($path_parts['extension'] == 'png') {
                  $items = $modal;
                }elseif ($path_parts['extension'] == 'jpeg') {
                  $items = $modal;
                }elseif ($path_parts['extension'] == 'pdf'){
                  $items = Html::a('<i class="fa fa-file-pdf-o"></i> Показать', $url,['class'=>'btn btn-info btn-sm','target'=>'_blank']);
                }else{
                  $items = Html::a('<i class="fa fa-file-word-o"></i> Скачать', $url,['class'=>'btn btn-info btn-sm']);
                }
               return $items;
             },

            ],
            [
              'attribute' => 'number_period',
              'visible' => !empty($model->number_period),
            ],
            [
              'attribute' => 'is_working',
              'visible' => !empty($model->is_working),
            ],
            [
              'attribute' => 'working_status',
              'visible' => !empty($model->working_status),
            ],
            [
              'attribute' => 'working_agreement_start',
              'visible' => !empty($model->working_agreement_start),
            ],
            [
              'attribute' => 'working_agreement',
              'visible' => !empty($model->working_agreement),
            ],
            [
              'attribute' => 'employer',
              'visible' => !empty($model->employer),
            ],
            [
              'attribute' => 'polish_number',
              'visible' => !empty($model->polish_number),
            ],
            [
              'attribute' => 'agency_name',
              'visible' => !empty($model->agency_name),
            ],
            [
      				'attribute' => 'statusarchive',
              'value'=>function($model){
                $name = app\models\admin\StatusWorker::find()->where(['id' => $model->statusarchive])->one()->title;
                return $name;
                },
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
              'attribute' => 'employer',
              'visible' => ($model->vacancy_id !==0),
              'value'=>function($model){
                  $vacancy = app\models\crm\Vacancy::find()->where(['id' => $model->vacancy_id])->one()->company_id;
                  $emploer = app\models\admin\Company::find()->where(['user_id' => $vacancy])->one()->firm_name;
                return $emploer;
                },
            ],
            [
      				'attribute' => 'type_pay',
              'value'=>function($model){
                if ($model->type_pay !== null) {
                  $name = app\models\admin\PayType::find()->where(['id' => $model->type_pay])->one()->title;
                }else{
                  $name = '';
                }
                return $name;
                },
      			],

            [
              'attribute' => 'rate',
              'visible' => !empty($model->rate),
            ],

            [
      				'attribute' => 'payed',
              'value'=>function($model){
                    if ($model->payed == 1) {
                      $items = Yii::t('app', 'Yes');
                    }else {
                      $items = Yii::t('app', 'No');
                    }
                    return $items;
                },
      			],
            'summaagency',
            [
      				'attribute' => 'payedagency',
              'value'=>function($model){
                    if ($model->payedagency == 1) {
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
                    if($model->statusarchive == 2) {
                        $statys_1 = '2';
                        $statys_2 = '3';
                        $statys_3 = '4';
                        $statys_4 = '100';
                        $disab = false;
                      }elseif($model->statusarchive ==3){
                        $statys_1 = '2';
                        $statys_2 = '4';
                        $statys_3 = '';
                        $statys_4 = '';
                        $disab = false;
                      }elseif($model->statusarchive ==4){
                        $statys_1 = '4';
                        $statys_2 = '5';
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
                        $statys_2 = '7';
                        $statys_3 = '';
                        $statys_4 = '';
                        $disab = false;
                      }
                      elseif($model->statusarchive == 7) {
                        $statys_1 = '7';
                        $statys_2 = '8';
                        $statys_3 = '';
                        $statys_4 = '';
                        $disab = true;
                      }
                      elseif($model->statusarchive == 8) {
                        $statys_1 = '8';
                        $statys_2 = '10';
                        $statys_3 = '';
                        $statys_4 = '';
                        $disab = false;
                      }else {
                        $statys_1 = '';
                        $statys_2 = '';
                        $statys_3 = '';
                        $statys_4 = '';
                        $disab = false;
                      }
                      return Html::activeDropDownList($model, 'statusarchive',

                                          ArrayHelper::map(app\models\admin\StatusWorker::find()->where(['id'=>$statys_1])->orWhere(['id'=>$statys_2])->orWhere(['id'=>$statys_3])->orWhere(['id'=>$statys_4])->all(), 'id', 'title'),


                      [
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
                                url: \"/admin/worker/statuse\",
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
  </div>
  <div id="pay" class="tab-pane fade">
  <p class="h3 text-center info-h">Платежи</p>
  <?= PamentsWidget::widget(['message' => $model->id]); ?>
  </div>
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

<div id="myMed" class="modal fade">
<div class="modal-dialog"><div class="modal-content">
<div class="modal-header"><h4 class="modal-title"><?=Yii::t('app', 'medical_board_w') ?></h4></div>
<div class="modal-body">  <img src="<?=$model->medical_board ?>" width="100%"></div>
<div class="modal-footer"><button class="btn btn-default" type="button" data-dismiss="modal">Закрыть</button></div>
</div></div></div>

<div id="myIns" class="modal fade">
<div class="modal-dialog"><div class="modal-content">
<div class="modal-header"><h4 class="modal-title"><?=Yii::t('app', 'insurance_w') ?></h4></div>
<div class="modal-body">  <img src="<?=$model->insurance ?>" width="100%"></div>
<div class="modal-footer"><button class="btn btn-default" type="button" data-dismiss="modal">Закрыть</button></div>
</div></div></div>
