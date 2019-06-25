<?php

use yii\db\Migration;

/**
 * Class m190625_084929_create_table_user_role_assignment
 */
class m190600_000200_create_table_user_role extends Migration{

	public function up(){
		$tableOptions = NULL;
		if ($this->db->driverName === 'mysql'){
			$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		}

		$this->createTable('{{%user_role}}', [
			'role_id' => $this->integer()->notNull(),
			'user_id' => $this->integer()->notNull(),
		], $tableOptions);

		$this->addForeignKey('fk_user', '{{%user_role}}',
			'user_id',
			'{{%user}}', 'id', 'NO ACTION', 'NO ACTION');

		$this->addForeignKey('fk_role', '{{%user_role}}', 'role_id',
			'{{%role}}', 'id', 'NO ACTION', 'NO ACTION');
	}

	public function down(){
		$this->dropForeignKey('fk_role', '{{%user_role}}');
		$this->dropForeignKey('fk_user', '{{%user_role}}');
		$this->dropTable('{{%user_role}}');
	}
}
