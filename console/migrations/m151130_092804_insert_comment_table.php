<?php

use yii\db\Schema;
use yii\db\Migration;
use yii\db\Expression;

class m151130_092804_insert_comment_table extends Migration
{
    public function up()
    {
        $this->insert('{{%comment}}', [
            'id' => 1,
            'user_id' => 1,
            'page_id' => 1,
            'comment' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, '
                . 'sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'created_at' => new Expression('NOW()'),
        ]);
        $this->insert('{{%comment}}', [
            'id' => 2,
            'user_id' => 1,
            'page_id' => 3,
            'comment' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, '
                . 'sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'created_at' => new Expression('NOW()'),
        ]);
        $this->insert('{{%comment}}', [
            'id' => 3,
            'user_id' => 3,
            'page_id' => 3,
            'comment' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, '
                . 'sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'created_at' => new Expression('NOW()'),
        ]);
        $this->insert('{{%comment}}', [
            'id' => 4,
            'user_id' => 3,
            'page_id' => 2,
            'comment' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, '
                . 'sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'created_at' => new Expression('NOW()'),
        ]);
        $this->insert('{{%comment}}', [
            'id' => 5,
            'user_id' => 1,
            'page_id' => 4,
            'comment' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, '
                . 'sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'created_at' => new Expression('NOW()'),
        ]);
    }

    public function down()
    {
        $this->delete('{{%comment}}', ['id' => 1]);
        $this->delete('{{%comment}}', ['id' => 2]);
        $this->delete('{{%comment}}', ['id' => 3]);
        $this->delete('{{%comment}}', ['id' => 4]);
        $this->delete('{{%comment}}', ['id' => 5]);
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
