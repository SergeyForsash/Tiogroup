<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\crm\Vacancy */

$this->title = Yii::t('app', 'Create Vacancies');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Vacancies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vacancy-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
