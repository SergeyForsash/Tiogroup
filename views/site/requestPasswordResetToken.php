<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \mdm\admin\models\form\PasswordResetRequest */

$this->title = Yii::t('app', 'Password recovery');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="login-box" style="width:456px;margin:0 auto; padding-top:250px">
  <div style="text-align: center; padding-bottom:15px">
      <b><img src="/uploads/logo.png" width="150"></b>
    </div>
<div class="login-box-body">
<div class="site-request-password-reset">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>  <?=Yii::t('app', 'Please enter your email address. A confirmation email will be sent to you.') ?></p>

    <div class="row">
        <div class="col-md-12">
            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
                <?= $form->field($model, 'email') ?>
                <div class="form-group">
                    <?= Html::submitButton('<i class="fa fa-paper-plane"></i> '.Yii::t('app', 'Send'), ['class' => 'btn btn-primary btn-block']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
</div>
</div>
