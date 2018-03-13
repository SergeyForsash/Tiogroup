<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\admin\Company */

$this->title = Yii::t('app', 'My profile');
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
$vacancy = app\models\crm\Vacancy::find()->where(['company_id'=>$model->user_id])->all();
$vacancy_id = array_column($vacancy, 'id');
$date = app\models\crm\Worker::find()->where(['vacancy_id' => $vacancy_id])->all();

 ?>
 <div class="company-view">
   <p>
       <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
       <?= Html::a(Yii::t('app', Yii::t('app', 'Change password')), ['/employer/change-password', 'id' => $model->id], ['class' => 'btn btn-danger']) ?>
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
               'format' =>  ['date', 'dd.MM.Y'],
             ],
             [
               'attribute' => 'updated_at',
               'format' =>  ['date', 'dd.MM.Y'],
             ],

             [
               'attribute' => 'file',
               'format'=>'url',
               'visible' => !empty($model->file),
               'value' => Html::a('<button class="btn btn-info btn-sm" type="button" data-toggle="modal" data-target="#myFile"><i class="glyphicon glyphicon-camera"></i> '.Yii::t('app', 'Show').' </button>'),
               'format' => 'raw',
             ],

         ],
     ]) ?>

   </div>
 </div>

<div id="myFile" class="modal fade">
<div class="modal-dialog"><div class="modal-content">
<div class="modal-header"><h4 class="modal-title"><?= Yii::t('app', 'file')?> </h4></div>
<div class="modal-body"><img src="<?=$model->file ?>" width="100%"></div>
<div class="modal-footer"><button class="btn btn-default" type="button" data-dismiss="modal"><?= Yii::t('app', 'Close')?></button></div>
</div></div></div>
