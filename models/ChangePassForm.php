<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * Class ChangePassForm
 *
 * @package app\models
 */
class ChangePassForm extends Model{

	public $old_password;
	public $new_password;
	public $confirm_password;

	/**
	 * @inheritdoc
	 */
	public function rules(){
		return [
			[['old_password', 'new_password', 'confirm_password'], 'required'],
			[['old_password', 'new_password', 'confirm_password'], 'trim'],
			[['old_password'], 'validatePassword'],
			[['new_password'], 'validateNewPassword'],
			[['new_password'], 'string', 'min' => 6],
			[['confirm_password'], 'compare', 'compareAttribute' => 'new_password'],
		];
	}

	/**
	 * @return array
	 */
	public function attributeLabels(){
		return [
			'old_password'     => Yii::t('app', 'Old Password'),
			'new_password'     => Yii::t('app', 'New Password'),
			'confirm_password' => Yii::t('app', 'Confirm Password'),
		];
	}

	/**
	 * @param $attribute
	 * @param $params
	 * @param $validator
	 */
	public function validatePassword($attribute, $params, $validator){
		if (!$this->validatePwd($this->$attribute)){
			$this->addError($attribute, 'Incorrect old password.');
		}
	}

	/**
	 * @param $attribute
	 * @param $params
	 * @param $validator
	 */
	public function validateNewPassword($attribute, $params, $validator){
		if ($this->validatePwd($this->$attribute)){
			$this->addError('new_password', 'New password matches the current password !');
		}
	}


	/**
	 * @return \app\models\User|null
	 * @throws \yii\base\Exception
	 */
	public function change(){
		if (!$this->validate()){
			return NULL;
		}

		/** @var \app\models\User $user */
		$user = Yii::$app->user->identity;
		$user->setPassword($this->new_password);
		$user->generateAuthKey();
		if ($user->save()){
			return $user;
		}

		return NULL;
	}

	/**
	 * @param $pwd
	 *
	 * @return bool|void
	 */
	public function validatePwd($pwd){
		return Yii::$app->security->validatePassword($pwd,
			Yii::$app->user->identity->password_hash);
	}
}
