<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%user_role}}".
 *
 * @property int $role_id
 * @property int $user_id
 *
 * @property Role $role
 * @property User $user
 */
class UserRole extends \yii\db\ActiveRecord{

	/**
	 * {@inheritdoc}
	 */
	public static function tableName(){
		return '{{%user_role}}';
	}

	/**
	 * {@inheritdoc}
	 */
	public function rules(){
		return [
			[['role_id', 'user_id'], 'required'],
			[['role_id', 'user_id'], 'integer'],
			[['role_id'], 'exist', 'skipOnError' => TRUE, 'targetClass' => Role::className(), 'targetAttribute' => ['role_id' => 'id']],
			[['user_id'], 'exist', 'skipOnError' => TRUE, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
		];
	}

	/**
	 * {@inheritdoc}
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
		return $this->hasOne(Role::className(), ['id' => 'role_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getUser(){
		return $this->hasOne(User::className(), ['id' => 'user_id']);
	}
}
