<?php

use yii\db\Migration;

/**
 * Class m190628_014553_create_tb_contact
 */
class m190628_014553_create_tb_contact extends Migration{

	/**
	 * @return bool|void
	 */
	public function up(){
		$tableOptions = NULL;
		if ($this->db->driverName === 'mysql'){
			$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		}

		$this->createTable('{{%contact}}', [
			'id'          => $this->primaryKey(),
			'guest_name'  => $this->string(30)->notNull(),
			'guest_email' => $this->string(100)->notNull(),
			'subject'     => $this->string(100)->notNull(),
			'content'     => $this->string(2000)->notNull(),
			'status'      => $this->tinyInteger()->notNull()->defaultValue('0'),
			'updated_at'  => $this->integer(),
			'created_at'  => $this->integer(),
			'reply_by'    => $this->integer(),
		], $tableOptions);
	}

	/**
	 * @return bool|void
	 */
	public function down(){
		$this->dropTable('{{%contact}}');
	}
}
