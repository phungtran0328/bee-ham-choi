<?php

use yii\db\Migration;

/**
 * Class m190629_160714_create_tbl_order
 */
class m190629_160714_create_tbl_order extends Migration{

	/**
	 * @return bool|void
	 */
	public function up(){
		$table_options = NULL;
		if ($this->db->driverName === 'mysql'){
			$table_options = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		}

		$this->createTable('{{%order}}', [
			'id'          => $this->primaryKey(),
			'store_id'    => $this->integer()->notNull(),
			'name'        => $this->string(50),
			'is_finished' => $this->smallInteger()->notNull()->defaultValue(0),
			'token'       => $this->string()->unique(),
			'created_by'  => $this->integer()->notNull(),
			'updated_by'  => $this->integer()->notNull(),
			'created_at'  => $this->integer()->notNull(),
			'updated_at'  => $this->integer()->notNull(),
		], $table_options);

		$this->addForeignKey('fk_store', '{{%order}}', 'store_id',
			'{{%store}}', 'id', 'NO ACTION', 'NO ACTION');
	}

	/**
	 * @return bool|void
	 */
	public function down(){
		$this->dropForeignKey('fk_store', '{{%order}}');
		$this->dropTable('{{%order}}');
	}
}
