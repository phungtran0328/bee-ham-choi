<?php

use yii\db\Migration;

class m130000_130000_create_admin_account extends Migration{

	/**
	 * @return bool|void
	 * @throws \yii\base\Exception
	 */
	public function up(){
		$this->insert('{{%user}}', [
			'id'            => 1,
			'username'      => 'admin',
			'email'         => 'beehamchoi@gmail.com',
			'auth_key'      => Yii::$app->security->generateRandomString(),
			'password_hash' => Yii::$app->security->generatePasswordHash('root'),
			'updated_at'    => time(),
			'created_at'    => time()
		]);
	}

	/**
	 * @return bool
	 */
	public function down(){
		return TRUE;
	}
}
