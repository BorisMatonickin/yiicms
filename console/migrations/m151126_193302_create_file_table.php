<?php

use yii\db\Schema;
use yii\db\Migration;

class m151126_193302_create_file_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql')
        {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%file}}', [
            'id' => 'INT(11) UNSIGNED NOT NULL AUTO_INCREMENT',
            'user_id' => 'INT(11) UNSIGNED NOT NULL',
            'name' => $this->string(80)->notNull(),
            'type' => $this->string(45)->notNull(),
            'size' => 'INT UNSIGNED NOT NULL',
            'description' => 'MEDIUMTEXT NULL',
            'created_at' => $this->timestamp()->notNull(),
            'updated_at' => $this->timestamp()->notNull(),
            'PRIMARY KEY(id)'
        ], $tableOptions);
        
        $this->addForeignKey('fk2_user', '{{%file}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'NO ACTION');
    }

    public function down()
    {
        $this->dropForeignKey('fk2_user', '{{%file}}');
        $this->dropTable('{{%file}}');
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
