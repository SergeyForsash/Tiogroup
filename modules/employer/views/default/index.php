<div class="employer-default-index">
  <?php

  /* @var $this yii\web\View */

  $this->title = 'Strona główna';
  ?>
  <div class="site-index">

    <div class="jumbotron text-center">
        <h1>Cześć, <?= app\models\crm\User::getUserName(['id'=>Yii::$app->user->id]) ?>!</h1>

        <p class="lead"><p class="lead"><?=Yii::t('app','text_home')?></p></p>

        <p><a class="btn btn-lg btn-success" href="<?= \yii\helpers\Url::to(['/employer/worker']) ?>"><i class="fa fa-users"></i> Moi pracownicy</a></p>

        <p class="lead"><p class="lead"><?=Yii::t('app','text_home')?></p></p>

        <p><a class="btn btn-lg btn-success" href="<?= \yii\helpers\Url::to(['/employer/vacancy']) ?>"><i class="fa fa-handshake-o"></i> Oferty Pracy</a></p>
    </div>

</div>
