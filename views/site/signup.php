<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \mdm\admin\models\form\Signup */

$this->title = Yii::t('app', 'Registry');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="login-box" style="width:456px;margin:0 auto; padding-top:150px">
  <div style="text-align: center; padding-bottom:15px">
      <b><img src="/uploads/logo.png" width="150"></b>
    </div>
<div class="login-box-body">
<h1><?= Html::encode($this->title) ?></h1>
    <p><?=Yii::t('app', 'Please fill in the following fields')  ?>:</p>
    <?= Html::errorSummary($model)?>
    <div class="row">
        <div class="col-lg-12">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                <?= $form->field($model, 'username')->label(Yii::t('app', 'Username')) ?>
                <?= $form->field($model, 'email')->label(Yii::t('app', 'Email')) ?>
                <?php echo $form->field($model, 'type')->dropDownList([
                '1' => Yii::t('app', 'employer'),
                '2' => Yii::t('app', 'agency'),
                '3' => Yii::t('app', 'workers'),
              ])->label(Yii::t('app', 'Profile')) ?>
                <?= $form->field($model, 'password')->passwordInput()->label(Yii::t('app', 'Password')) ?>
                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Create'), ['class' => 'btn btn-primary  btn-block', 'name' => 'signup-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
</div>
</div>
