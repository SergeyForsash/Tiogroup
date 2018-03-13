<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\admin\Citizenship */

$this->title = Yii::t('app', 'create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Citizenships'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="citizenship-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
