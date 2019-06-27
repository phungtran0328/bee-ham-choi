<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%role}}".
 *
 * @property int $id
 * @property string $name
 * @property int $status
 *
 * @property UserRole[] $userRoles
 */
class Role extends \yii\db\ActiveRecord{

	/**
	 * {@inheritdoc}
	 */
	public static function tableName(){
		return '{{%role}}';
	}

	/**
	 * {@inheritdoc}
	 */
	public function rules(){
		return [
			[['name'], 'required'],
			[['status'], 'integer'],
			[['name'], 'string', 'max' => 255],
			[['name'], 'unique'],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels(){
		return [
			'id'     => Yii::t('app', 'ID'),
			'name'   => Yii::t('app', 'Name'),
			'status' => Yii::t('app', 'Status'),
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getUserRoles(){
		return $this->hasMany(UserRole::class, ['role_id' => 'id']);
	}

	/**
	 * @param $name
	 *
	 * @return \app\models\Role|null
	 */
	public static function getIdByName($name){
		$role = Role::findOne(['name' => $name, 'status' => 10]);

		return $role ? $role->id : NULL;
	}
}
