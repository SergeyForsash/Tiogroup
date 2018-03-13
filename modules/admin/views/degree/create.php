<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\admin\Degree */

$this->title = Yii::t('app', 'create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Degrees'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="degree-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
