<?php

use yii\db\Schema;
use yii\db\Migration;

class m151127_174403_create_page_tag_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql')
        {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%page_tag}}', [
            'page_id' => 'INT(11) UNSIGNED NOT NULL',
            'tag_id' => 'INT(11) UNSIGNED NOT NULL',
            'PRIMARY KEY(page_id, tag_id)'
        ], $tableOptions);
        
        $this->addForeignKey('fk1_page_id', '{{%page_tag}}', 'page_id', '{{%page}}', 'id', 'CASCADE', 'NO ACTION');
        $this->addForeignKey('fk2_tag_id', '{{%page_tag}}', 'tag_id', '{{%tag}}', 'id', 'CASCADE', 'NO ACTION');
        }

    public function down()
    {
        $this->dropTable('{{%page_tag}}');
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
