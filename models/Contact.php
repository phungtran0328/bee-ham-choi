<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%contact}}".
 *
 * @property int $id
 * @property string $guest_name
 * @property string $guest_email
 * @property string $subject
 * @property string $content
 * @property int $status
 * @property int $updated_at
 * @property int $created_at
 * @property int $reply_by
 */
class Contact extends \yii\db\ActiveRecord{

	/**
	 * @return array
	 */
	public function behaviors(){
		return [
			'timestamp' => TimestampBehavior::class,
			'blameable' => [
				'class'              => BlameableBehavior::class,
				'createdByAttribute' => NULL,
				'updatedByAttribute' => 'reply_by',
			]
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public static function tableName(){
		return '{{%contact}}';
	}

	/**
	 * {@inheritdoc}
	 */
	public function rules(){
		return [
			[['guest_name', 'guest_email', 'subject', 'content'], 'required'],
			[['status', 'updated_at', 'created_at', 'reply_by'], 'integer'],
			[['guest_name'], 'string', 'max' => 30],
			[['guest_email', 'subject'], 'string', 'max' => 100],
			['guest_email', 'email'],
			[['content'], 'string', 'max' => 2000],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels(){
		return [
			'id'          => Yii::t('app', 'ID'),
			'guest_name'  => Yii::t('app', 'Guest Name'),
			'guest_email' => Yii::t('app', 'Guest Email'),
			'subject'     => Yii::t('app', 'Subject'),
			'content'     => Yii::t('app', 'Content'),
			'status'      => Yii::t('app', 'Status'),
			'updated_at'  => Yii::t('app', 'Updated At'),
			'created_at'  => Yii::t('app', 'Created By'),
			'reply_by'    => Yii::t('app', 'Reply By'),
		];
	}
}
