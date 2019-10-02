<?php

use yii\db\Migration;

/**
 * Class m191002_083300_create_table_member
 */
class m191002_083300_create_table_member extends Migration{

	public function up(){
		$tableOptions = NULL;
		if ($this->db->driverName === 'mysql'){
			$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		}

		$this->createTable('{{%member}}', [
			'id'          => $this->primaryKey(),
			'name'        => $this->string(255)->notNull(),
			'gender'      => $this->tinyInteger()->notNull(),
			'birthday'    => $this->integer()->notNull(),
			'description' => $this->string(2000),
			'status'      => $this->integer()->notNull()->defaultValue('10'),
			'token'       => $this->string(255)->notNull(),
			'created_by'  => $this->integer()->notNull(),
			'created_at'  => $this->integer()->notNull(),
			'updated_by'  => $this->integer()->notNull(),
			'updated_at'  => $this->integer()->notNull(),
		], $tableOptions);
	}

	public function down(){
		$this->dropTable('{{%member}}');

	}

}
