<?php

use yii\db\Schema;
use yii\db\Migration;

class m151126_185737_create_page_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql')
        {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%page}}', [
            'id' => 'INT(11) UNSIGNED NOT NULL AUTO_INCREMENT',
            'user_id' => 'INT(11) UNSIGNED NOT NULL',
            'live' => 'TINYINT(1) UNSIGNED NOT NULL DEFAULT 0',
            'title' => $this->string(100)->notNull(),
            'content' => 'LONGTEXT NULL',
            'created_at' => $this->timestamp()->notNull(),
            'updated_at' => $this->timestamp()->notNull(),
            'PRIMARY KEY(id)',
        ], $tableOptions);
        
        $this->addForeignKey('fk1_user', '{{%page}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'NO ACTION');
    }

    public function down()
    {
        $this->dropForeignKey('fk1_user', '{{%page}}');
        $this->dropTable('{{%page}}');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
