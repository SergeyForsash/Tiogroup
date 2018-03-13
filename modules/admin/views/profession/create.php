<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\admin\Profession */

$this->title = Yii::t('app', 'create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Professions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profession-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
