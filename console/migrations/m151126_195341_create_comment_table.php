<?php

use yii\db\Schema;
use yii\db\Migration;

class m151126_195341_create_comment_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql')
        {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%comment}}', [
            'id' => 'INT(11) UNSIGNED NOT NULL AUTO_INCREMENT',
            'user_id' => 'INT(11) UNSIGNED NOT NULL',
            'page_id' => 'INT(11) UNSIGNED NOT NULL',
            'comment' => 'MEDIUMTEXT NOT NULL',
            'created_at' => $this->timestamp()->notNull(),
            'PRIMARY KEY(id)' 
        ], $tableOptions);
        
        $this->addForeignKey('fk3_user', '{{%comment}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'NO ACTION');
        $this->addForeignKey('fk1_page', '{{%comment}}', 'page_id', '{{%page}}', 'id', 'CASCADE', 'NO ACTION');
    }

    public function down()
    {
        $this->dropForeignKey('fk1_page', '{{%comment}}');
        $this->dropForeignKey('fk3_user', '{{%comment}}');
        $this->dropTable('{{%comment}}');
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
