<?php

use yii\db\Schema;
use yii\db\Migration;

class m151127_181058_create_page_category_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql')
        {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%page_category}}', [
            'page_id' => 'INT(11) UNSIGNED NOT NULL',
            'category_id' => 'INT(11) UNSIGNED NOT NULL',
            'PRIMARY KEY(page_id, category_id)'
        ], $tableOptions);
        
        $this->addForeignKey('fk3_page_id', '{{%page_category}}', 'page_id', '{{%page}}', 'id', 'CASCADE', 'NO ACTION');
        $this->addForeignKey('fk4_category_id', '{{%page_category}}', 'category_id', '{{%category}}', 'id', 'CASCADE', 'NO ACTION');
    }

    public function down()
    {
        $this->dropTable('{{%page_category}}');
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
