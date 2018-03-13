<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \mdm\admin\models\form\Signup */

$this->title = 'Добавление пользевателя';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
<div class="col-md-4"> </div>
<div class="col-md-4">

    <p>Пожалуйста, заполните следующие поля для нового пользевателя:</p>
    <?= Html::errorSummary($model)?>
    <div class="row">
        <div class="col-lg-12">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                <?= $form->field($model, 'username')->label('Логин') ?>
                <?= $form->field($model, 'email')->label('Почта') ?>
                <?php echo $form->field($model, 'type')->dropDownList([
                '0' => Yii::t('app', 'admin'),
                '1' => Yii::t('app', 'employer'),
                '2' => Yii::t('app', 'agency'),
                '3' => Yii::t('app', 'workers'),
              ])->label('Профиль') ?>
                <?= $form->field($model, 'password')->passwordInput()->label('Пароль') ?>
                <div class="form-group">
                    <?= Html::submitButton('Создать', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<div class="col-md-4"> </div>
</div>
