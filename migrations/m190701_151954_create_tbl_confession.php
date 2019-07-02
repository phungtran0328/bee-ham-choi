<?php

use yii\db\Migration;

/**
 * Class m190701_151954_create_tbl_confession
 */
class m190701_151954_create_tbl_confession extends Migration{

	/**
	 * @return bool|void
	 */
	public function up(){
		$table_options = NULL;
		if ($this->db->driverName === 'mysql'){
			$table_options = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		}

		$this->createTable('{{%confession}}', [
			'id'         => $this->primaryKey(),
			'content'    => $this->string(10000)->notNull(),
			'created_at' => $this->integer()->notNull(),
			'updated_at' => $this->integer()->notNull(),
		], $table_options);
	}

	/**
	 * @return bool|void
	 */
	public function down(){
		$this->dropTable('{{%confession}}');
	}
}
