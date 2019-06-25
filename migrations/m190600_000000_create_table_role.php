<?php

use yii\db\Migration;

/**
 * Class m190600_000000_create_table_role
 */
class m190600_000000_create_table_role extends Migration{

	/**
	 * @return bool|void
	 */
	public function up(){
		$tableOptions = NULL;
		if ($this->db->driverName === 'mysql'){
			$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		}

		$this->createTable('{{%role}}', [
			'id'         => $this->primaryKey(),
			'name'       => $this->string()->notNull(),
			'status'     => $this->integer()->notNull()->defaultValue('10'),
			'created_by' => $this->integer()->notNull(),
			'created_at' => $this->integer()->notNull(),
			'updated_by' => $this->integer(),
			'updated_at' => $this->integer(),
		], $tableOptions);
	}

	/**
	 * @return bool|void
	 */
	public function down(){
		$this->dropTable('{{%user_group}}');
	}
}
