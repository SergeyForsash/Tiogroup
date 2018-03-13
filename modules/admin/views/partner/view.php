<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Partner */

$this->title = $model->agency_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Partner'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php

$date = app\models\crm\Worker::find()->where(['created_by' => $model->user_id])->all();
 ?>
<ul class="nav nav-tabs nav-justified">
  <li class="active"><a data-toggle="tab" href="#partner"><strong><?= Yii::t('app', 'Date') ?> <?=$model->agency_name ?></strong></a></li>
  <?php if(!empty($date)) { ?>
  <li><a data-toggle="tab" href="#worker"><strong><?= Yii::t('app', 'Workers') ?> <?=$model->agency_name ?></strong></a></li>
  <?php } ?>
</ul>

<div class="tab-content">
  <div id="partner" class="tab-pane fade in active">
<div class="partner-view">
  <p class="h3 text-center info-h"><?= Yii::t('app', 'Date') ?> <?=$model->agency_name ?> </p>
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
            'agency_name',
            'first_number',
            'second_number',
            'legal_address',
            'actual_address',
            'email:email',
            'second_email:email',
            'director_name',
            'license_number',
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
                $item = app\models\crm\User::find()->where(['id' => $model->ident])->one()->username;
                return $item;
                },
      			],
            'contact_name',
            'web_site:url',
            [
            'attribute' => 'agreement',
            'visible' => !empty($data->agreement),
            'format' => 'raw',
            'value' => function($data){
                    return Html::img(Url::toRoute($data->agreement),[
                        'style' => 'width:55px;'
                    ]);
                },
            ],
            [
              'attribute' => 'image',
              'format' => 'raw',
              'visible' => !empty($model->image),
              'value' => Html::a('<button class="btn btn-info btn-sm" type="button" data-toggle="modal" data-target="#myImage"><i class="glyphicon glyphicon-camera"></i> Показать </button>'),
            ],
        ],
    ]) ?>

    </div>
  </div>
  <div id="worker" class="tab-pane fade">
  <?php if(!empty($date)) { ?>
      <hr>
      <p class="h3 text-center info-h"><?= Yii::t('app', 'Workers') ?> <?=$model->agency_name ?> </p>
      <div class="vacancy-create">

        <?= $this->render('_worker.php', [
            'dataProvider' => $dataProvider,
        ]) ?>

      </div>
    <?php } ?>
  </div>
</div>

<div id="myImage" class="modal fade">
<div class="modal-dialog"><div class="modal-content">
<div class="modal-header"><h4 class="modal-title">Фото </h4></div>
<div class="modal-body"><img src="<?=$model->image ?>" width="100%"></div>
<div class="modal-footer"><button class="btn btn-default" type="button" data-dismiss="modal">Закрыть</button></div>
</div></div></div>
