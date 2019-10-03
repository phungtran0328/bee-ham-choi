<?php

use yii\db\Migration;

/**
 * Class m191003_023002_update_member
 */
class m191003_023002_update_member extends Migration{

	public function up(){
		$this->alterColumn('{{%member}}', 'token', $this->string(255)->null());
	}

	public function down(){
		return TRUE;
	}
}
