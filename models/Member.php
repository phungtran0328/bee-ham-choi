<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%member}}".
 *
 * @property int $id
 * @property string $name
 * @property int $gender
 * @property int $birthday
 * @property string $description
 * @property int $status
 * @property string $token
 * @property int $created_by
 * @property int $created_at
 * @property int $updated_by
 * @property int $updated_at
 */
class Member extends \yii\db\ActiveRecord{

	public function behaviors(){
		return [
			TimestampBehavior::class,
			BlameableBehavior::class,
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public static function tableName(){
		return '{{%member}}';
	}

	/**
	 * {@inheritdoc}
	 */
	public function rules(){
		return [
			[['name', 'gender', 'birthday'], 'required'],
			[['gender', 'birthday', 'status', 'created_by', 'created_at', 'updated_by', 'updated_at'], 'integer'],
			[['name', 'token'], 'string', 'max' => 255],
			[['description'], 'string', 'max' => 2000],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels(){
		return [
			'id'          => Yii::t('app', 'ID'),
			'name'        => Yii::t('app', 'Name'),
			'gender'      => Yii::t('app', 'Gender'),
			'birthday'    => Yii::t('app', 'Birthday'),
			'description' => Yii::t('app', 'Description'),
			'status'      => Yii::t('app', 'Status'),
			'token'       => Yii::t('app', 'Token'),
			'created_by'  => Yii::t('app', 'Created By'),
			'created_at'  => Yii::t('app', 'Created At'),
			'updated_by'  => Yii::t('app', 'Updated By'),
			'updated_at'  => Yii::t('app', 'Updated At'),
		];
	}
}
