<?php


$this->title = Yii::t('app', 'My profile');
?>
<div class="worker-profile">
    <?= $this->render('_profile', [
        'model' => $model,
        //'users'=> $users,
    ]) ?>
</div>
