<?php

namespace app\models;

use himiklab\yii2\recaptcha\ReCaptchaValidator2;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%confession}}".
 *
 * @property int $id
 * @property string $content
 * @property int $created_at
 * @property int $updated_at
 */
class Confession extends \yii\db\ActiveRecord{

	public $verify_code;

	/**
	 * {@inheritdoc}
	 */
	public static function tableName(){
		return '{{%confession}}';
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
			[['content'], 'required'],
			[['created_at', 'updated_at'], 'integer'],
			[['content'], 'string', 'max' => 10000],
			['verify_code', ReCaptchaValidator2::class,
				'uncheckedMessage' => 'Please confirm that you are not a bot.'],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels(){
		return [
			'id'          => Yii::t('app', 'ID'),
			'content'     => Yii::t('app', 'Content'),
			'created_at'  => Yii::t('app', 'Created At'),
			'updated_at'  => Yii::t('app', 'Updated At'),
			'verify_code' => Yii::t('app', 'Verification'),
		];
	}
}
