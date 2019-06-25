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

		$this->createTable('{{%permission}}', [
			'id'          => $this->primaryKey(),
			'name'        => $this->string()->notNull()->unique(),
			'description' => $this->string(),
			'synced'      => $this->tinyInteger()->notNull()->defaultValue('0'),
		], $tableOptions);

	}

	/**
	 * @return bool|void
	 */
	public function down(){
		$this->dropTable('{{%permission}}');
	}
}
