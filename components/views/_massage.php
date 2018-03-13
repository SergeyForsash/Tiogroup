<?php
$module =Yii::$app->controller->module->id;
if ($model->massage_id == null) {
  $id = $model->id;
}else {
  $id = $model->massage_id;
}
if ($model->users == 1) {
  $name=$model->admin_name ;
}else {
  $name=$model->user_name ;
}
?>
      <a href="<?= yii\helpers\Url::to(['/'.$module.'/massage/view','id'=> $id ])?>">
          <div class="pull-left">
              <img src="/uploads/user.png" class="img-circle" alt="User Image" width="55"/>
          </div>
            <h4><?=$name?></h4>
            <p><?=$model->subject ?></p>
      </a>
