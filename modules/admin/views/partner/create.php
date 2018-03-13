<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Partner */

$this->title = Yii::t('app', 'create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Partner'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="partner-create">

    <?= $this->render('_form', [
        'model' => $model,
        'users'=> $users,
    ]) ?>

</div>
