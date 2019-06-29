<?php

namespace app\helper;

use Yii;

class MailHelper{

	public function sendMail($html, $user, $to, $subject){
		return Yii::$app->mailer->compose(['html' => $html], ['user' => $user])
		                        ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
		                        ->setTo($to)
		                        ->setSubject($subject)
		                        ->send();
	}
}