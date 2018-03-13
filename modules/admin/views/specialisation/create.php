<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\admin\Specialisation */

$this->title = Yii::t('app', 'create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Specialisations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="specialisation-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
