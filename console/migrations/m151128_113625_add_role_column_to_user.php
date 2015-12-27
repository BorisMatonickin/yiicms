<?php

use yii\db\Schema;
use yii\db\Migration;

class m151128_113625_add_role_column_to_user extends Migration
{
    public function up()
    {
        $this->addColumn('{{%user}}', 'role', 'SMALLINT(6) NOT NULL DEFAULT 10 AFTER status');
    }

    public function down()
    {
        $this->dropColumn('{{%user}}', 'role');
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
