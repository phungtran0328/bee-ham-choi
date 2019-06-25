<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%permission}}".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $synced
 *
 * @property RolePermission[] $rolePermissions
 */
class Permission extends \yii\db\ActiveRecord{

	/**
	 * {@inheritdoc}
	 */
	public static function tableName(){
		return '{{%permission}}';
	}

	/**
	 * {@inheritdoc}
	 */
	public function rules(){
		return [
			[['name'], 'required'],
			[['synced'], 'integer'],
			[['name', 'description'], 'string', 'max' => 255],
			[['name'], 'unique'],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels(){
		return [
			'id'          => Yii::t('app', 'ID'),
			'name'        => Yii::t('app', 'Name'),
			'description' => Yii::t('app', 'Description'),
			'synced'      => Yii::t('app', 'Synced'),
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getRolePermissions(){
		return $this->hasMany(RolePermission::className(), ['permission_id' => 'id']);
	}
}
