<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $user app\models\User */

$reset_link = Url::to(['site/reset-password', 'token' => $user->password_reset_token], TRUE);
?>
<div class="password-reset">
    <p>Hello <?= Html::encode($user->username) ?>,</p>

    <p>Follow the link below to reset your password:</p>

    <p><?= Html::a(Html::encode($reset_link), $reset_link) ?></p>
</div>
