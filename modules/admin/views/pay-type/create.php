<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\admin\PayType */

$this->title = Yii::t('app', 'create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pay Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pay-type-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
