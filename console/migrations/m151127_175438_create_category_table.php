<?php

use yii\db\Schema;
use yii\db\Migration;

class m151127_175438_create_category_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql')
        {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%category}}', [
            'id' => 'INT(11) UNSIGNED NOT NULL AUTO_INCREMENT',
            'category_name' => $this->string(50)->notNull()->unique(),
            'PRIMARY KEY(id)'
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%category}}');
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
