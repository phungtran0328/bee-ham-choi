<?php

namespace app\helper;

use Yii;

class MailHelper{

	public function sendMail($html, $text, $user, $to, $subject){
		return Yii::$app->mailer->compose(['html' => $html, 'text' => $text], ['user' => $user])
		                        ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
		                        ->setTo($to)
		                        ->setSubject($subject)
		                        ->send();
	}
}