<?php

namespace app\models;

use himiklab\yii2\recaptcha\ReCaptchaValidator2;
use Yii;
use yii\base\Model;

/**
 * Class SignupForm
 *
 * @package app\models
 */
class SignupForm extends Model{

	public $username;
	public $name;
	public $phone_number;
	public $email;
	public $password;
	public $password_confirm;
	public $role_id;
	public $verify_code;

	/**
	 * @return array
	 */
	public function rules(){
		return [
			[['password_confirm', 'password', 'username', 'email', 'name'], 'required'],
			[['username', 'name', 'phone_number', 'password', 'password_confirm'], 'trim'],
			['role_id', 'integer'],
			[['username'], 'string', 'min' => 4, 'max' => 20],
			[['password'], 'string', 'min' => 6, 'max' => 30],
			['email', 'string', 'max' => 100],
			['email', 'email'],
			['username', 'match', 'pattern' => "/^[a-zA-Z0-9 ']*$/", 'message' => 'Username should contain [a-zA-Z0-9]'],
			['password_confirm', 'compare', 'compareAttribute' => 'password'],
			['username', 'unique', 'targetClass' => User::class],
			['email', 'unique', 'targetClass' => User::class],
			['verify_code', ReCaptchaValidator2::class,
				'uncheckedMessage' => 'Please confirm that you are not a bot.'],
		];
	}

	/**
	 * @return array
	 */
	public function attributeLabels(){
		return [
			'username'         => Yii::t('app', 'Username'),
			'name'             => Yii::t('app', 'Name'),
			'phone_number'     => Yii::t('app', 'Phone Number'),
			'email'            => Yii::t('app', 'Email'),
			'password'         => Yii::t('app', 'Password'),
			'password_confirm' => Yii::t('app', 'Confirm Password'),
			'role_id'          => Yii::t('app', 'Role'),
			'verify_code'      => Yii::t('app', 'Verification')
		];
	}

	/**
	 * @return \app\models\User|null
	 * @throws \yii\base\Exception
	 */
	public function signup(){
		if (!$this->validate()){
			return NULL;
		}

		$user               = new User();
		$user->username     = $this->username;
		$user->email        = $this->email;
		$user->name         = $this->name;
		$user->phone_number = $this->phone_number;
		$user->setPassword($this->password);
		$user->generateAuthKey();
		if ($user->save()){
			$role_id = Role::getIdByName('user');
			UserRole::roleAssignment($user->id, $role_id);

			return $user;
		}

		return FALSE;
	}
}
