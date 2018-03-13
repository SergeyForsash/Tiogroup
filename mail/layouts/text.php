<?php
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $user mdm\admin\models\User */
return true;
$resetLink = Url::to(['/reset-password','token'=>$user->password_reset_token], true);
?>
Hello <?= $user->username ?>,

Follow the link below to reset your password:

<?= $resetLink ?>
