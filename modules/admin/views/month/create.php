<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\admin\Month */

$this->title = Yii::t('app', 'create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Months'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="month-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
