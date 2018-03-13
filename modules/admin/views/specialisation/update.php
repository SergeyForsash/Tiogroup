<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\admin\Specialisation */

$this->title = Yii::t('app', 'update').' '. $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Specialisations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'update');
?>
<div class="specialisation-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
