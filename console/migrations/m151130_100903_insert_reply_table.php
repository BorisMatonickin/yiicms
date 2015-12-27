<?php

use yii\db\Schema;
use yii\db\Migration;
use yii\db\Expression;

class m151130_100903_insert_reply_table extends Migration
{
    public function up()
    {
        $this->insert('{{%reply}}', [
            'id' => 1,
            'comment_id' => 1,
            'user_id' => 3,
            'reply' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, '
                . 'sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'created_at' => new Expression('NOW()'),
        ]);
        $this->insert('{{%reply}}', [
            'id' => 2,
            'comment_id' => 3,
            'user_id' => 1,
            'reply' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, '
                . 'sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'created_at' => new Expression('NOW()'),
        ]);
    }

    public function down()
    {
        $this->delete('{{%reply}}', ['id' => 1]);
        $this->delete('{{%reply}}', ['id' => 2]);
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
