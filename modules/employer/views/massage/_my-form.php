<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $model app\models\crm\Massage */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
    $this->registerJs(
        '$("document").ready(function(){
            $("#new_note").on("pjax:end", function() {
            $.pjax.reload({container:"#massage"});  //Reload GridView
        });
    });'
    );
?>

<div class="massage-form">
<?php yii\widgets\Pjax::begin(['id' => 'new_note']) ?>
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($new_model, 'content')->textarea(['rows' => 6,'value'=>'','placeholder' => Yii::t('app', 'Начните набирать сообщение...')])->label(false) ?>
    <div class="form-group text-center">
        <?= Html::submitButton('<i class="fa fa-paper-plane"></i> Wyślij', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
<?php Pjax::end(); ?>
</div>
