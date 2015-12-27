<?php

use yii\db\Schema;
use yii\db\Migration;

class m151130_100350_add_user_id_column_to_reply extends Migration
{
    public function up()
    {
        $this->addColumn('{{%reply}}', 'user_id', 'INT(11) UNSIGNED NOT NULL AFTER comment_id');
        $this->addForeignKey('fk4_user_id', '{{%reply}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'NO ACTION');
    }

    public function down()
    {
        $this->dropForeignKey('fk4_user_id', '{{%reply}}');
        $this->dropColumn('{{%reply}}', 'user_id');
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
