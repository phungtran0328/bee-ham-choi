<?php

use yii\db\Migration;

/**
 * Class m190629_160732_create_tbl_booking_order
 */
class m190629_160732_create_tbl_booking_order extends Migration{

	/**
	 * @return bool|void
	 */
	public function up(){
		$table_options = NULL;
		if ($this->db->driverName === 'mysql'){
			$table_options = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		}

		$this->createTable('{{%booking_order}}', [
			'id'         => $this->primaryKey(),
			'order_id'   => $this->integer()->notNull(),
			'user_id'    => $this->integer()->notNull(),
			'food_name'  => $this->string(100)->notNull(),
			'remark'     => $this->string(500),
			'created_by' => $this->integer()->notNull(),
			'updated_by' => $this->integer()->notNull(),
			'created_at' => $this->integer()->notNull(),
			'updated_at' => $this->integer()->notNull(),
		], $table_options);

		$this->addForeignKey('fk_order', '{{%booking_order}}',
			'order_id',
			'{{%order}}', 'id', 'NO ACTION', 'NO ACTION');
		$this->addForeignKey('fk_bk_user_id', '{{%booking_order}}',
			'user_id',
			'{{%user}}', 'id', 'NO ACTION', 'NO ACTION');
	}

	/**
	 * @return bool|void
	 */
	public function down(){
		$this->dropForeignKey('fk_bk_user_id', '{{%booking_order}}');
		$this->dropForeignKey('fk_order', '{{%booking_order}}');
		$this->dropTable('{{%booking_order}}');
	}
}
