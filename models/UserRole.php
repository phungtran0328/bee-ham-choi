<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%user_role}}".
 *
 * @property int $role_id
 * @property int $user_id
 *
 * @property Role[] $role
 * @property User $user
 */
class UserRole extends \yii\db\ActiveRecord{

	/**
	 * @return string
	 */
	public static function tableName(){
		return '{{%user_role}}';
	}

	/**
	 * @return array
	 */
	public function rules(){
		return [
			[['role_id', 'user_id'], 'required'],
			[['role_id', 'user_id'], 'integer'],
			[['role_id'], 'exist', 'skipOnError' => TRUE, 'targetClass' => Role::class, 'targetAttribute' => ['role_id' => 'id']],
			[['user_id'], 'exist', 'skipOnError' => TRUE, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
		];
	}

	/**
	 * @return array
	 */
	public function attributeLabels(){
		return [
			'role_id' => Yii::t('app', 'Role ID'),
			'user_id' => Yii::t('app', 'User ID'),
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getRole(){
		return $this->hasMany(Role::class, ['id' => 'role_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getUser(){
		return $this->hasOne(User::class, ['id' => 'user_id']);
	}
}
