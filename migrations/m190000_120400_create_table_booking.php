<?php

use yii\db\Migration;

/**
 * Class m190000_120400_create_table_booking
 */
class m190000_120400_create_table_booking extends Migration{

	/**
	 * @return bool|void
	 */
	public function up(){
		$table_options = NULL;
		if ($this->db->driverName === 'mysql'){
			$table_options = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		}

		$this->createTable('{{%booking}}', [
			'id'         => $this->primaryKey(),
			'bill_id'    => $this->integer()->notNull(),
			'user_name'  => $this->string(50)->notNull(),
			'food_name'  => $this->string(100)->notNull(),
			'remark'     => $this->string(2000),
			'created_at' => $this->integer()->notNull(),
			'updated_at' => $this->integer()->notNull(),
		], $table_options);

		$this->addForeignKey('fk_bill', '{{%booking}}',
			'bill_id',
			'{{%bill}}', 'id', 'NO ACTION', 'NO ACTION');
	}

	/**
	 * @return bool|void
	 */
	public function down(){
		$this->dropForeignKey('fk_bill', '{{%booking}}');
		$this->dropTable('{{%booking}}');
	}

}
