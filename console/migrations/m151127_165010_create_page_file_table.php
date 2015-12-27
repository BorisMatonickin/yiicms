<?php

use yii\db\Schema;
use yii\db\Migration;

class m151127_165010_create_page_file_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql')
        {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%page_file}}', [
            'page_id' => 'INT(11) UNSIGNED NOT NULL',
            'file_id' => 'INT(11) UNSIGNED NOT NULL',
            'PRIMARY KEY(page_id, file_id)'
        ], $tableOptions);
        
        $this->createIndex('idx_page_id', '{{%page_file}}', 'page_id');
        $this->createIndex('idx_file_id', '{{%page_file}}', 'file_id');
        
        $this->addForeignKey('fk_page_id', '{{%page_file}}', 'page_id', '{{%page}}', 'id');
        $this->addForeignKey('fk_file_id', '{{%page_file}}', 'file_id', '{{%file}}', 'id');
    }

    public function down()
    {
        $this->dropTable('{{%page_file}}');
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
