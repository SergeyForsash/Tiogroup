<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\crm\Worker */

$this->title = Yii::t('app', 'create_w');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Workers_a'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="worker-create">
    <?= $this->render('_form', [
        'model' => $model,
        'users'=> $users,
    ]) ?>

</div>
