<?php


namespace app\models;


use app\helper\MailHelper;
use Yii;
use yii\base\Model;

class ResetPasswordRequest extends Model{

	public $email;

	/**
	 * @inheritdoc
	 */
	public function rules(){
		$class = Yii::$app->getUser()->identityClass ?: 'app\models\User';

		return [
			['email', 'filter', 'filter' => 'trim'],
			['email', 'required'],
			['email', 'email'],
			['email', 'exist',
				'targetClass' => $class,
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
	 * @throws \yii\base\Exception
	 */
	public function sendEmail(){
		/** @var User */
		$class = Yii::$app->getUser()->identityClass ?: 'app\models\User';
		$user  = $class::findOne([
			'status' => User::STATUS_ACTIVE,
			'email'  => $this->email,
		]);
		if ($user){
			if (!ResetPasswordForm::isPasswordResetTokenValid($user->password_reset_token)){
				$user->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
			}
			if ($user->save()){
				$mail = new MailHelper();

				return $mail->sendMail('passwordResetToken-html', $user,
					$this->email, 'Password reset for ' . Yii::$app->name);
			}
		}

		return FALSE;
	}
}