<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property string $name
 * @property string $avatar
 * @property string $phone_number
 *
 * @property \app\models\UserRole $role
 */
class User extends ActiveRecord implements IdentityInterface{

	const STATUS_DELETED = - 10;

	const STATUS_INACTIVE = 0;

	const STATUS_ACTIVE = 10;

	public $password;

	/**
	 * @return string
	 */
	public static function tableName(){
		return '{{%user}}';
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
	 * @return array
	 */
	public function rules(){
		return [
			[['username', 'email'], 'required'],
			[['status', 'created_at', 'updated_at'], 'integer'],
			[['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
			[['auth_key'], 'string', 'max' => 32],
			[['name', 'avatar'], 'string', 'max' => 100],
			[['phone_number'], 'string', 'max' => 20],
			[['username'], 'unique'],
			[['email'], 'unique'],
			[['password_reset_token'], 'unique'],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels(){
		return [
			'id'                   => Yii::t('app', 'ID'),
			'username'             => Yii::t('app', 'Username'),
			'auth_key'             => Yii::t('app', 'Auth Key'),
			'password_hash'        => Yii::t('app', 'Password Hash'),
			'password_reset_token' => Yii::t('app', 'Password Reset Token'),
			'email'                => Yii::t('app', 'Email'),
			'status'               => Yii::t('app', 'Status'),
			'created_at'           => Yii::t('app', 'Created At'),
			'updated_at'           => Yii::t('app', 'Updated At'),
			'name'                 => Yii::t('app', 'Name'),
			'avatar'               => Yii::t('app', 'Avatar'),
			'phone_number'         => Yii::t('app', 'Phone Number'),
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public static function findIdentity($id){
		return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
	}

	/**
	 * {@inheritdoc}
	 */
	public static function findIdentityByAccessToken($token, $type = NULL){
		throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
	}

	/**
	 * Finds user by username
	 *
	 * @param string $username
	 *
	 * @return static|null
	 */
	public static function findByUsername($username){
		return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
	}

	/**
	 * Finds user by password reset token
	 *
	 * @param string $token password reset token
	 *
	 * @return static|null
	 */
	public static function findByPasswordResetToken($token){
		if (!static::isPasswordResetTokenValid($token)){
			return NULL;
		}

		return static::findOne([
			'password_reset_token' => $token,
			'status'               => self::STATUS_ACTIVE,
		]);
	}

	/**
	 * Finds out if password reset token is valid
	 *
	 * @param string $token password reset token
	 *
	 * @return bool
	 */
	public static function isPasswordResetTokenValid($token){
		if (empty($token)){
			return FALSE;
		}

		$timestamp = (int) substr($token, strrpos($token, '_') + 1);
		$expire    = Yii::$app->params['user.passwordResetTokenExpire'];

		return $timestamp + $expire >= time();
	}

	/**
	 * {@inheritdoc}
	 */
	public function getId(){
		return $this->getPrimaryKey();
	}

	/**
	 * {@inheritdoc}
	 */
	public function getAuthKey(){
		return $this->auth_key;
	}

	/**
	 * {@inheritdoc}
	 */
	public function validateAuthKey($authKey){
		return $this->getAuthKey() === $authKey;
	}

	/**
	 * Validates password
	 *
	 * @param string $password password to validate
	 *
	 * @return bool if password provided is valid for current user
	 */
	public function validatePassword($password){
		return Yii::$app->security->validatePassword($password, $this->password_hash);
	}

	/**
	 * @param $password
	 *
	 * @throws \yii\base\Exception
	 */
	public function setPassword($password){
		$this->password_hash = Yii::$app->security->generatePasswordHash($password);
	}

	/**
	 * Generates "remember me" authentication key
	 */
	public function generateAuthKey(){
		$this->auth_key = Yii::$app->security->generateRandomString();
	}

	/**
	 * Generates new password reset token
	 */
	public function generatePasswordResetToken(){
		$this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
	}

	/**
	 * Removes password reset token
	 */
	public function removePasswordResetToken(){
		$this->password_reset_token = NULL;
	}

	/**
	 * @return \yii\db\ActiveQuery
	 * @throws \yii\base\InvalidConfigException
	 */
	public function getRole(){
		return $this->hasOne(Role::class, ['id' => 'role_id'])
		            ->viaTable(UserRole::tableName(), ['user_id' => 'id']);
	}

	/**
	 * @return bool
	 */
	public function isAdmin(){
		if ($this->role->name == 'admin'){
			return TRUE;
		}

		return FALSE;
	}
}