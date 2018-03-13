<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\admin\City */

$this->title = Yii::t('app', 'create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="city-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
