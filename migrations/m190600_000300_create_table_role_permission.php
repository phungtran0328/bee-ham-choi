<?php

use yii\db\Migration;

/**
 * Class m190625_084945_create_table_role_permission_assignment
 */
class m190600_000300_create_table_role_permission extends Migration{

	/**
	 * @return bool|void
	 */
	public function up(){
		$tableOptions = NULL;
		if ($this->db->driverName === 'mysql'){
			$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		}

		$this->createTable('{{%role_permission}}', [
			'role_id'       => $this->integer()->notNull(),
			'permission_id' => $this->integer()->notNull(),
		], $tableOptions);

		$this->addForeignKey('fk_map_role', '{{%role_permission}}',
			'role_id',
			'{{%role}}', 'id', 'NO ACTION', 'NO ACTION');

		$this->addForeignKey('fk_permission', '{{%role_permission}}', 'permission_id',
			'{{%permission}}', 'id', 'NO ACTION', 'NO ACTION');
	}

	/**
	 * @return bool|void
	 */
	public function down(){
		$this->dropForeignKey('fk_map_role', '{{%role_permission}}');
		$this->dropForeignKey('fk_permission', '{{%role_permission}}');
		$this->dropTable('{{%role_permission}}');
	}
}
