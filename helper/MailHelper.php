<?php

namespace app\helper;

use Yii;

/**
 * Class MailHelper
 *
 * @package app\helper
 */
class MailHelper{

	/**
	 * @param $html
	 * @param $user
	 * @param $from
	 * @param $to
	 * @param $subject
	 *
	 * @return bool
	 */
	public static function sendEmail($html, $user, $from, $to, $subject){
		return Yii::$app->mailer->compose(['html' => $html], ['user' => $user])
		                        ->setFrom($from)
		                        ->setTo($to)
		                        ->setSubject($subject)
		                        ->send();
	}
}