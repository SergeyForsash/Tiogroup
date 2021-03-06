<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\admin\DriverCategory */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Driver Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="driver-category-view">

  <p class="text-right">
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
            'title',
        ],
    ]) ?>

</div>
