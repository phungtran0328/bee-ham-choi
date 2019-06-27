<?php

namespace app\models;

use Yii;
use yii\base\Model;

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
	 * Validates the password.
	 * This method serves as the inline validation for password.
	 */
	public function validatePassword(){
		/** @var \app\models\User $user */
		$user = Yii::$app->user->identity;
		if (!$user || !$user->validatePassword($this->old_password)){
			$this->addError('old_password', 'Incorrect old password.');
		}
	}


	/**
	 * @return bool
	 * @throws \yii\base\Exception
	 */
	public function change(){
		if ($this->validate()){
			/** @var \app\models\User $user */
			$user = Yii::$app->user->identity;
			$user->setPassword($this->new_password);
			$user->generateAuthKey();
			if ($user->save()){
				return TRUE;
			}
		}

		return FALSE;
	}
}
