<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Partner */

$this->title = 'Мой профиль';
$this->params['breadcrumbs'][] = $this->title;
?>
<p>
    <?= Html::a('<i class="fa fa-edit"></i>	'.Yii::t('app', 'Edit'), ['update'], ['class' => 'btn btn-primary']) ?>
    <?= Html::a(Yii::t('app', 'Сменить пароль'), ['/agency/change-password', 'id' => $model->id], ['class' => 'btn btn-danger']) ?>
</p>
<div class="partner-view">
        <?= DetailView::widget([
          'model' => $model,
          'attributes' => [
              [
        				'attribute' => 'user_id',
                'value'=>function($model){
                      $name = app\models\crm\User::find()->where(['id' => $model->user_id])->one()->username;
                      return $name;
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
              'format' => 'raw',
              'value' => function($data){
                      return Html::img(Url::toRoute($data->agreement),[
                          'style' => 'width:55px;'
                      ]);
                  },
              ],
              [
                'attribute' => 'image',
                'format'=>'url',
                'visible' => !empty($model->image),
                'value' => Html::a('<button class="btn btn-info btn-sm" type="button" data-toggle="modal" data-target="#myImage"><i class="glyphicon glyphicon-camera"></i> Показать </button>'),
                'format' => 'raw',
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
</div>
