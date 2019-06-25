<?php

use yii\db\Migration;

/**
 * Class m190620_120121_create_table_order
 */
class m190000_120000_create_table_bill extends Migration{

	/**
	 * @return bool|void
	 */
	public function up(){
		$table_options = NULL;
		if ($this->db->driverName === 'mysql'){
			$table_options = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		}

		$this->createTable('{{%bill}}', [
			'id'          => $this->primaryKey(),
			'is_finished' => $this->smallInteger()->notNull()->defaultValue(0),
			'token'       => $this->string()->unique(),
			'created_by'  => $this->integer()->notNull(),
			'updated_by'  => $this->integer()->notNull(),
			'created_at'  => $this->integer()->notNull(),
			'updated_at'  => $this->integer()->notNull(),
		], $table_options);
	}

	/**
	 * @return bool|void
	 */
	public function down(){
		$this->dropTable('{{%bill}}');
	}
}
