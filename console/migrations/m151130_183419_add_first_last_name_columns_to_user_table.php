<?php

use yii\db\Schema;
use yii\db\Migration;

class m151130_183419_add_first_last_name_columns_to_user_table extends Migration
{
    public function up()
    {
        $this->addColumn('{{%user}}', 'first_name', $this->string(60)->defaultValue(null) . ' AFTER username');
        $this->addColumn('{{%user}}', 'last_name', $this->string(80)->defaultValue(null) . ' AFTER first_name');
    }

    public function down()
    {
        $this->dropColumn('{{%user}}', 'first_name');
        $this->dropColumn('{{%user}}', 'last_name');
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
