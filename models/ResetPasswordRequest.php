<?php


namespace app\models;


use app\helper\MailHelper;
use Yii;
use yii\base\Model;

/**
 * Class ResetPasswordRequest
 *
 * @package app\models
 */
class ResetPasswordRequest extends Model{

	public $email;

	/**
	 * @inheritdoc
	 */
	public function rules(){
		return [
			['email', 'filter', 'filter' => 'trim'],
			['email', 'required'],
			['email', 'email'],
			['email', 'exist',
				'targetClass' => User::class,
				'filter'      => ['status' => User::STATUS_ACTIVE],
				'message'     => 'There is no user with such email.'
			],
		];
	}

	/**
	 * @return array
	 */
	public function attributeLabels(){
		return [
			'email' => Yii::t('app', 'Email'),
		];
	}

	/**
	 * @return bool
	 */
	public function sendEmail(){

		$user = User::findOne([
			'status' => User::STATUS_ACTIVE,
			'email'  => $this->email,
		]);

		if ($user){
			if ($user->generatePasswordResetToken() && $user->save()){
				return MailHelper::sendEmail('passwordResetToken-html', $user,
					[Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'],
					$this->email, 'Password reset for ' . Yii::$app->name);
			}
		}

		return FALSE;
	}
}