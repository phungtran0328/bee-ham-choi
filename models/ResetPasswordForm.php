<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;

/**
 * Password reset form
 */
class ResetPasswordForm extends Model{

	public $password;
	public $confirm_password;
	/**
	 * @var User
	 */
	private $_user;


	/**
	 * ResetPassword constructor.
	 *
	 * @param $token
	 * @param array $config
	 *
	 * @throws \yii\web\NotFoundHttpException
	 */
	public function __construct($token, $config = []){
		if (empty($token) || !is_string($token)){
			throw new NotFoundHttpException('Password reset token cannot be blank.');
		}
		// check token
		$class = Yii::$app->getUser()->identityClass ?: 'app\models\User';
		if (static::isPasswordResetTokenValid($token)){
			$this->_user = $class::findOne([
				'password_reset_token' => $token,
				'status'               => User::STATUS_ACTIVE
			]);
		}
		if (!$this->_user){
			throw new NotFoundHttpException('Wrong password reset token.');
		}
		parent::__construct($config);
	}

	/**
	 * @inheritdoc
	 */
	public function rules(){
		return [
			[['password', 'confirm_password'], 'required'],
			[['password', 'confirm_password'], 'trim'],
			['password', 'string', 'min' => 6],
			['confirm_password', 'compare', 'compareAttribute' => 'password']
		];
	}

	/**
	 * @return array
	 */
	public function attributeLabels(){
		return [
			'password'         => Yii::t('app', 'New Password'),
			'confirm_password' => Yii::t('app', 'Confirm Password'),
		];
	}

	/**
	 * @return bool
	 * @throws \yii\base\Exception
	 */
	public function resetPassword(){
		$user = $this->_user;
		$user->setPassword($this->password);
		$user->removePasswordResetToken();

		return $user->save(FALSE);
	}

	/**
	 * Finds out if password reset token is valid
	 *
	 * @param string $token password reset token
	 *
	 * @return boolean
	 */
	public static function isPasswordResetTokenValid($token){
		if (empty($token)){
			return FALSE;
		}
		$expire    = ArrayHelper::getValue(Yii::$app->params, 'user.passwordResetTokenExpire',
			24 * 3600);
		$parts     = explode('_', $token);
		$timestamp = (int) end($parts);

		return $timestamp + $expire >= time();
	}
}