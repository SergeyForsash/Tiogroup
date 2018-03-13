<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\crm\Payments */

$this->title = Yii::t('app', 'nambr_pay').' '.$model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Payments M'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payments-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            'company_id',
            'hours',
            'rate',
            'total',
        ],
    ]) ?>

</div>
