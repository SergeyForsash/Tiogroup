<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\admin\DriverCategory */

$this->title = Yii::t('app', 'create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Driver Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="driver-category-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
