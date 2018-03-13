<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \mdm\admin\models\form\ResetPassword */

$this->title = 'Сброс пароля';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="login-box" style="width:456px;margin:0 auto; padding-top:250px">
  <div style="text-align: center; padding-bottom:15px">
      <b><img src="/uploads/logo.png" width="150"></b>
    </div>
<div class="login-box-body">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Введите новый пароль:</p>

    <div class="row">
        <div class="col-md-12">
            <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>
                <?= $form->field($model, 'password')->passwordInput()->label('Пароль') ?>
                <div class="form-group">
                    <?= Html::submitButton('Изменить', ['class' => 'btn btn-primary btn-block']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
</div>
</div>
