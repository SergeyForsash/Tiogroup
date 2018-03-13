<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use dmstr\widgets\Alert;
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = Yii::t('app','Log in to CRM TIOGRUP');

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
?>



        <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>

        <?= $form->field($model, 'username')->label(false)->textInput(['placeholder' => Yii::t('app','Username'),'class'=>'login-for form-control']) ?>

        <?= $form->field($model, 'password')->passwordInput(['placeholder' => Yii::t('app','Password'),'class'=>'login-for form-control',])->label(false)?>

        <div class="row">
          <div class="col-md-4">
              <?= $form->field($model, 'rememberMe')->checkbox()->label(Yii::t('app','Remember Me')) ?>
          </div>
          <?php if (Yii::$app->language == 'en'){?>
            <div class="col-md-3 text-center"  style=" margin-top: 10px;">
              <?= Html::a(Yii::t('app','Registry'), ['/signup', 'lang' => 'en'], ['style' => 'float: right;']) ?>
            </div>
            <div class="col-md-5" style=" margin-top: 10px;">
              <?= Html::a(Yii::t('app','I forgot my password'), ['/request-password-reset', 'lang' => 'en'], ['style' => 'float: right;']) ?>
            </div>
          <?php }elseif ( Yii::$app->language == 'pl'){ ?>
            <div class="col-md-3 text-center"  style=" margin-top: 10px;">
              <?= Html::a(Yii::t('app','Registry'), ['/signup', 'lang' => 'pl'], ['style' => 'float: right;']) ?>
            </div>
            <div class="col-md-5" style=" margin-top: 10px;">
              <?= Html::a(Yii::t('app','I forgot my password'), ['/request-password-reset', 'lang' => 'pl'], ['style' => 'float: right;']) ?>
            </div>
          <?php }else{ ?>
            <div class="col-md-3 text-center"  style=" margin-top: 10px;">
              <?= Html::a(Yii::t('app','Registry'), ['/signup'], ['style' => 'float: right;']) ?>
            </div>
            <div class="col-md-5" style=" margin-top: 10px;">
              <?= Html::a(Yii::t('app','I forgot my password'), ['/request-password-reset'], ['style' => 'float: right;']) ?>
            </div>
         <?php } ?>
            <div class="text-center">
              <div class="col-md-12">
                  <?= Html::submitButton('<i class="fa fa-sign-in" aria-hidden="true"></i> '.Yii::t('app','Login'), ['class' => 'btn btn-primary btn-block btn-flat btn-logins', 'name' => 'login-button']) ?>
              </div>

            </div>
            <!-- /.col -->

        </div>


        <?php ActiveForm::end(); ?>
        <div class="text-center">
          <br>
          <div class="btn-group btn-group-justified">
            <?php if (Yii::$app->language == 'en'){?>
              <?= Html::a('<img src="/uploads/img/russia.svg.png" width="30" class="img-thumbnail">'.
                Yii::t('app','Russian'), ['/login', 'lang' => 'ru'], ['class' => 'btn btn-default btn-sm']) ?>
              <?= Html::a('<img src="/uploads/img/poland.svg.png" width="30" class="img-thumbnail">'.
               Yii::t('app','Polish'), ['/login', 'lang' => 'pl'], ['class' => 'btn btn-default btn-sm']) ?>
            <?php }elseif ( Yii::$app->language == 'pl'){ ?>
              <?= Html::a('<img src="/uploads/img/russia.svg.png" width="30" class="img-thumbnail">'.
                Yii::t('app','Russian'), ['/login', 'lang' => 'ru'], ['class' => 'btn btn-default btn-sm']) ?>
              <?= Html::a('<img src="/uploads/img/united_kingdom.svg.png" width="30" class="img-thumbnail">'.
                Yii::t('app','English'), ['/login', 'lang' => 'en'], ['class' => 'btn btn-default btn-sm']) ?>
            <?php }else{ ?>
              <?= Html::a('<img src="/uploads/img/united_kingdom.svg.png" width="30" class="img-thumbnail">'.
                Yii::t('app','English'), ['/login', 'lang' => 'en'], ['class' => 'btn btn-default btn-sm']) ?>
              <?= Html::a('<img src="/uploads/img/poland.svg.png" width="30" class="img-thumbnail">'.
               Yii::t('app','Polish'), ['/login', 'lang' => 'pl'], ['class' => 'btn btn-default btn-sm']) ?>
            <?php } ?>

          </div>
        </div>
    </div>

  </div><!-- /.login-box -->
