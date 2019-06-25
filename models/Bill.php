<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%bill}}".
 *
 * @property int $id
 * @property int $is_finished
 * @property string $token
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Booking[] $bookings
 */
class Bill extends \yii\db\ActiveRecord{

	const NOT_FINISHED = 0;

	const FINISHED = 10;

	/**
	 * {@inheritdoc}
	 */
	public static function tableName(){
		return '{{%bill}}';
	}

	/**
	 * @return array
	 */
	public function behaviors(){
		return [
			TimestampBehavior::class,
			BlameableBehavior::class,
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function rules(){
		return [
			[['is_finished', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
			[['token'], 'string', 'max' => 255],
			[['token'], 'unique'],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels(){
		return [
			'id'          => Yii::t('app', 'ID'),
			'is_finished' => Yii::t('app', 'Done'),
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
	public function getBookings(){
		return $this->hasMany(Booking::class, ['bill_id' => 'id']);
	}

	/**
	 *
	 */
	public function createBill(){
		$this->token = Yii::$app->security->generateRandomString();
		if ($this->save()){
			return TRUE;
		}

		return FALSE;
	}

	/**
	 * @param $token
	 *
	 * @return \app\models\Bill|null
	 */
	public function findByToken($token){
		return static::findOne([
			'token'       => $token,
			'is_finished' => self::NOT_FINISHED,
		]);
	}
}
