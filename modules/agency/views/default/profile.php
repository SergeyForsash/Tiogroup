<?php


$this->title = 'Мой профиль';
?>
<div class="worker-profile">
    <?= $this->render('_profile', [
        'model' => $model,
        //'users'=> $users,
    ]) ?>
</div>
