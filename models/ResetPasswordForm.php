<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\NotFoundHttpException;

/**
 * Password reset form
 */
class ResetPasswordForm extends Model{

	public $password;
	public $confirm_password;
	private $_user;


	/**
	 * ResetPasswordForm constructor.
	 *
	 * @param $token
	 * @param array $config
	 *
	 * @throws \yii\web\NotFoundHttpException
	 */
	public function __construct($token = NULL, $config = []){
		if (empty($token) || !is_string($token)){
			throw new NotFoundHttpException('Password reset token cannot be blank.');
		}

		$this->_user = User::findByPasswordResetToken($token);

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
		if (!$this->validate()){
			return FALSE;
		}

		$this->_user->setPassword($this->password);
		$this->_user->removePasswordResetToken();

		return $this->_user->save();
	}
}