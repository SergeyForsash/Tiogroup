<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\admin\Company */

$this->title = $model->firm_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Companies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
$vacancy = app\models\crm\Vacancy::find()->where(['company_id'=>$model->user_id])->all();
$vacancy_id = array_column($vacancy, 'id');
$date = app\models\crm\Worker::find()->where(['vacancy_id' => $vacancy_id])->all();

 ?>
<ul class="nav nav-tabs nav-justified">
  <li class="active"><a data-toggle="tab" href="#company"><strong><?= Yii::t('app', 'Date') ?> <?=$model->firm_name ?></strong></a></li>
  <?php if(!empty($date)) { ?>
  <li><a data-toggle="tab" href="#worker"><strong><?= Yii::t('app', 'Workers') ?> <?=$model->firm_name ?></strong></a></li>
  <?php } ?>
</ul>

<div class="tab-content">
  <div id="company" class="tab-pane fade in active">
<div class="company-view">
  <p class="h3 text-center info-h"><?= Yii::t('app', 'Date') ?> <?=$model->firm_name ?> </p>
  <p>
      <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
      <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
          'class' => 'btn btn-danger',
          'data' => [
              'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
              'method' => 'post',
          ],
      ]) ?>
  </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
      				'attribute' => 'user_id',
              'value'=>function($model){
                $name = app\models\crm\User::find()->where(['id' => $model->user_id])->one()->username;
                return $name;
                },
      			],
            [
      				'attribute' => 'status',
              'value'=>function($model){
                    if ($model->status == 1) {
                      $items = Yii::t('app', 'actives');
                    }else {
                      $items = Yii::t('app', 'not active');
                    }
                    return $items;
                },
      			],
            'firm_name',
            'director_name',
            'address',
            'actual_address',
            'nip',
            'regon',
            'krs',
            'phone_number',
            'mobile_number',
            'email:email',
            'website:url',
            [
              'attribute' => 'created_at',
              'format' =>  ['date', 'dd.MM.YYYY'],
            ],
            [
              'attribute' => 'updated_at',
              'format' =>  ['date', 'dd.MM.YYYY'],
            ],
            [
      				'attribute' => 'ident',
              'value'=>function($model){
                $name = app\models\crm\User::find()->where(['id' => $model->ident])->one()->username;
                return $name;
                },
      			],
            [
              'attribute' => 'file',
              'format'=>'url',
              'visible' => !empty($model->file),
              'value' => Html::a('<button class="btn btn-info btn-sm" type="button" data-toggle="modal" data-target="#myFile"><i class="glyphicon glyphicon-camera"></i> Показать </button>'),
              'format' => 'raw',
            ],

        ],
    ]) ?>

  </div>
</div>
<div id="worker" class="tab-pane fade">
<?php if(!empty($date)) { ?>
    <hr>
    <p class="h3 text-center info-h"><?= Yii::t('app', 'Workers') ?> <?=$model->firm_name?> </p>
    <div class="vacancy-create">

      <?= $this->render('_worker.php', [
          'dataProvider' => $dataProvider,
      ]) ?>

    </div>
  <?php } ?>
</div>
</div>

<div id="myFile" class="modal fade">
<div class="modal-dialog"><div class="modal-content">
<div class="modal-header"><h4 class="modal-title">Вложение </h4></div>
<div class="modal-body"><img src="<?=$model->file ?>" width="100%"></div>
<div class="modal-footer"><button class="btn btn-default" type="button" data-dismiss="modal">Закрыть</button></div>
</div></div></div>
