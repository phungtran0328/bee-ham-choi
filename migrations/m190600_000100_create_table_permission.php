<?php

use yii\db\Migration;

/**
 * Class m190625_080236_create_table_permission
 */
class m190600_000100_create_table_permission extends Migration{

	/**
	 * @return bool|void
	 */
	public function up(){
		$tableOptions = NULL;
		if ($this->db->driverName === 'mysql'){
			$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		}

		$this->createTable('{{%user_permission}}', [
			'id'          => $this->primaryKey(),
			'name'        => $this->string()->notNull(),
			'description' => $this->string(),
			'created_by'  => $this->integer(),
			'updated_by'  => $this->integer(),
			'created_at'  => $this->integer(),
			'updated_at'  => $this->integer(),
		], $tableOptions);

	}

	/**
	 * @return bool|void
	 */
	public function down(){
		$this->dropTable('{{%user_permission}}');
	}
}
