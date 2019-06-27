<?php


use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $user app\models\User */

$reset_link = Url::to(['site/reset-password', 'token' => $user->password_reset_token], TRUE);
?>
    Hello <?= $user->username ?>,

    Follow the link below to reset your password:

<?= $reset_link ?>