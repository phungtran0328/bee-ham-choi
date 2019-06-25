<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%booking}}".
 *
 * @property int $id
 * @property int $bill_id
 * @property string $user_name
 * @property string $food_name
 * @property string $remark
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Bill $bill
 */
class Booking extends \yii\db\ActiveRecord{

	/**
	 * {@inheritdoc}
	 */
	public static function tableName(){
		return '{{%booking}}';
	}

	/**
	 * @return array
	 */
	public function behaviors(){
		return [
			TimestampBehavior::class,
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function rules(){
		return [
			[['bill_id', 'user_name', 'food_name',], 'required'],
			[['user_name'], 'in', 'range' =>
				                      ['Alvin', 'Andy', 'Argus', 'Aura', 'Christina',
					                      'Corner', 'Kendy', 'Nancy', 'Noo', 'Roy', 'Zoe',]],
			[['bill_id', 'created_at', 'updated_at'], 'integer'],
			[['user_name'], 'string', 'max' => 50],
			[['food_name'], 'string', 'max' => 50],
			[['remark'], 'string', 'max' => 100],
			[['bill_id'], 'exist', 'skipOnError' => TRUE, 'targetClass' => Bill::class, 'targetAttribute' => ['bill_id' => 'id']],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels(){
		return [
			'id'         => Yii::t('app', 'ID'),
			'bill_id'    => Yii::t('app', 'Bill ID'),
			'user_name'  => Yii::t('app', 'Tên'),
			'food_name'  => Yii::t('app', 'Món ăn'),
			'remark'     => Yii::t('app', 'Ghi chú'),
			'created_at' => Yii::t('app', 'Created At'),
			'updated_at' => Yii::t('app', 'Updated At'),
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getBill(){
		return $this->hasOne(Bill::class, ['id' => 'bill_id']);
	}
}
