<?php

use yii\db\Schema;
use yii\db\Migration;

class m151126_200529_create_reply_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql')
        {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%reply}}', [
            'id' => 'INT(11) UNSIGNED NOT NULL AUTO_INCREMENT',
            'comment_id' => 'INT(11) UNSIGNED NOT NULL',
            'reply' => 'MEDIUMTEXT NOT NULL',
            'created_at' => $this->timestamp()->notNull(),
            'PRIMARY KEY(id)'
        ], $tableOptions);
        
        $this->addForeignKey('fk1_comment', '{{%reply}}', 'comment_id', '{{%comment}}', 'id', 'CASCADE', 'NO ACTION');
    }

    public function down()
    {
        $this->dropForeignKey('fk1_comment', '{{%reply}}');
        $this->dropTable('{{%reply}}');
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
