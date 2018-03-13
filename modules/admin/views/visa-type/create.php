<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\admin\VisaType */

$this->title = Yii::t('app', 'create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Visa Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="visa-type-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
