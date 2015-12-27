<?php

use yii\db\Schema;
use yii\db\Migration;

class m151127_173757_create_tag_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql')
        {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%tag}}', [
            'id' => 'INT(11) UNSIGNED NOT NULL AUTO_INCREMENT',
            'tag_title' => $this->string(50)->notNull()->unique(),
            'PRIMARY KEY(id)'
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%tag}}');
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
