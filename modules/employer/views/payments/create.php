<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\crm\Payments */

$this->title = 'Create Payments';
$this->params['breadcrumbs'][] = ['label' => 'Payments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payments-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
