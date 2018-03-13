<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\admin\PolishKnowledge */

$this->title = Yii::t('app', 'create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Polish Knowledges'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="polish-knowledge-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
