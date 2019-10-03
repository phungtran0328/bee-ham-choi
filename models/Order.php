<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%order}}".
 *
 * @property int $id
 * @property int $store_id
 * @property string $name
 * @property int $is_finished
 * @property string $token
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Store $store
 */
class Order extends \yii\db\ActiveRecord{

	/**
	 * {@inheritdoc}
	 */
	public static function tableName(){
		return '{{%order}}';
	}

	/**
	 * {@inheritdoc}
	 */
	public function rules(){
		return [
			[['store_id', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'required'],
			[['store_id', 'is_finished', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
			[['name'], 'string', 'max' => 50],
			[['token'], 'string', 'max' => 255],
			[['token'], 'unique'],
			[['store_id'], 'exist', 'skipOnError' => TRUE, 'targetClass' => Store::class, 'targetAttribute' => ['store_id' => 'id']],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels(){
		return [
			'id'          => Yii::t('app', 'ID'),
			'store_id'    => Yii::t('app', 'Store ID'),
			'name'        => Yii::t('app', 'Name'),
			'is_finished' => Yii::t('app', 'Is Finished'),
			'token'       => Yii::t('app', 'Token'),
			'created_by'  => Yii::t('app', 'Created By'),
			'updated_by'  => Yii::t('app', 'Updated By'),
			'created_at'  => Yii::t('app', 'Created At'),
			'updated_at'  => Yii::t('app', 'Updated At'),
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getStore(){
		return $this->hasOne(Store::class, ['id' => 'store_id']);
	}
}
