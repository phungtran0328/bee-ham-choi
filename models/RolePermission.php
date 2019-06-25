<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%role_permission}}".
 *
 * @property int $role_id
 * @property int $permission_id
 *
 * @property Role $role
 * @property Permission $permission
 */
class RolePermission extends \yii\db\ActiveRecord{

	/**
	 * {@inheritdoc}
	 */
	public static function tableName(){
		return '{{%role_permission}}';
	}

	/**
	 * {@inheritdoc}
	 */
	public function rules(){
		return [
			[['role_id', 'permission_id'], 'required'],
			[['role_id', 'permission_id'], 'integer'],
			[['role_id'], 'exist', 'skipOnError' => TRUE, 'targetClass' => Role::className(), 'targetAttribute' => ['role_id' => 'id']],
			[['permission_id'], 'exist', 'skipOnError' => TRUE, 'targetClass' => Permission::className(), 'targetAttribute' => ['permission_id' => 'id']],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels(){
		return [
			'role_id'       => Yii::t('app', 'Role ID'),
			'permission_id' => Yii::t('app', 'Permission ID'),
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
	public function getPermission(){
		return $this->hasOne(Permission::className(), ['id' => 'permission_id']);
	}
}
