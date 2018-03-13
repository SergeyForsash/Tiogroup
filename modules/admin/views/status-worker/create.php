<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\admin\StatusWorker */

$this->title = Yii::t('app', 'create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Status Worker'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="status-worker-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
