<?php
$type_user = '<span class="label label-info" style="margin-top:2px">'
.app\models\crm\User::getUserType(['id'=>$model->user_id]).
' </span>';
$type_admin = '<span class="label label-info" style="margin-top:2px">'
.app\models\crm\User::getUserType(['id'=>$model->admin_id]).
' </span>';
if ($model->users == 1) {
  $arrow='arrow-box-right';
  $name = 'TIOGROUP';
  $type = '<span class="label label-info" style="margin-top:2px"> Administrator </span>';
  $img='/uploads/admin.png';
}else {
  $arrow='arrow-box-left';
  $name = $model->user_name;
  $type =$type_user ;
  $img='/uploads/user.png';
}
$date = $model->date;
$date_2= date('Y-m-d');
$time = $model->time;
  Yii::$app->formatter->locale = 'pl-Pl';
if ($date == $date_2) {
  $item = Yii::$app->formatter->asDate($time,"php: H:i");
}else {
  $item = Yii::$app->formatter->asDate($date,"php:d.F").' '.'в '.Yii::$app->formatter->asDate($time,"php: H:i");
}

?>
  <li class="<?=$arrow?>">
    <div class="avatar">
      <a href="#">
        <div style="background-image: url(<?= $img?>);" class="img-rounded avatar-container-25">
        </div>
      </a>
    </div>
  <div class="info">
    <a href="#" class="" title="" data-original-title=""><?=$name.' | '.$type?></a>
    <div class="pull-right smallest">
      <?= $item?>
    </div>
  </div>
  <hr style="margin: 5px;">
  <div style="padding-top: 5px" class="linkify-marker img-responsive-container">
    <p><?= $model->content ?></p>
  </div>
  <?php $model->viewedUserCounter(); ?>
  <div class="clearfix">
  </div>
  <div class="clearfix"></div>
  </li>
