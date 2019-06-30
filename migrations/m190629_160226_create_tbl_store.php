<?php

use yii\db\Migration;

/**
 * Class m190629_160226_create_tbl_store
 */
class m190629_160226_create_tbl_store extends Migration{

	/**
	 * @return bool|void
	 */
	public function up(){
		$table_options = NULL;
		if ($this->db->driverName === 'mysql'){
			$table_options = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		}

		$this->createTable('{{%store}}', [
			'id'         => $this->primaryKey(),
			'name'       => $this->string(100),
			'address'    => $this->string(200),
			'created_by' => $this->integer()->notNull(),
			'updated_by' => $this->integer()->notNull(),
			'created_at' => $this->integer()->notNull(),
			'updated_at' => $this->integer()->notNull(),
		], $table_options);
	}

	/**
	 * @return bool|void
	 */
	public function down(){
		$this->dropTable('{{%store}}');
	}
}
