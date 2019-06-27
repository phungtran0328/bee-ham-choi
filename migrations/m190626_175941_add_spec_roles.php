<?php

use yii\db\Migration;

/**
 * Class m190626_175941_add_spec_roles
 */
class m190626_175941_add_spec_roles extends Migration{

	public function up(){
		$this->insert('{{%role}}', [
			'id'   => 1,
			'name' => 'admin',
		]);
		$this->insert('{{%role}}', [
			'id'   => 2,
			'name' => 'user',
		]);
		$this->insert('{{%user_role}}', [
			'role_id' => 1,
			'user_id' => 1,
		]);
	}

	/**
	 * @return bool
	 */
	public function down(){
		return TRUE;
	}
}
