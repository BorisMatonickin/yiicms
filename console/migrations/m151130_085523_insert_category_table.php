<?php

use yii\db\Schema;
use yii\db\Migration;

class m151130_085523_insert_category_table extends Migration
{
    public function up()
    {
        $this->insert('{{%category}}', [
            'id' => 1,
            'category_name' => 'Books',
        ]);
        $this->insert('{{%category}}', [
            'id' => 2,
            'category_name' => 'Commerce',
        ]);
        $this->insert('{{%category}}', [
            'id' => 3,
            'category_name' => 'Entertainment',
        ]);
        $this->insert('{{%category}}', [
            'id' => 4,
            'category_name' => 'Fashion',
        ]);
        $this->insert('{{%category}}', [
            'id' => 5,
            'category_name' => 'Film',
        ]);
        $this->insert('{{%category}}', [
            'id' => 6,
            'category_name' => 'Health',
        ]);
        $this->insert('{{%category}}', [
            'id' => 7,
            'category_name' => 'Science',
        ]);
        $this->insert('{{%category}}', [
            'id' => 8,
            'category_name' => 'Technology',
        ]);
        $this->insert('{{%category}}', [
            'id' => 9,
            'category_name' => 'History',
        ]);
        $this->insert('{{%category}}', [
            'id' => 10,
            'category_name' => 'Sport',
        ]);
    }

    public function down()
    {
        $this->delete('{{%category}}', ['id' => 1]);
        $this->delete('{{%category}}', ['id' => 2]);
        $this->delete('{{%category}}', ['id' => 3]);
        $this->delete('{{%category}}', ['id' => 4]);
        $this->delete('{{%category}}', ['id' => 5]);
        $this->delete('{{%category}}', ['id' => 6]);
        $this->delete('{{%category}}', ['id' => 7]);
        $this->delete('{{%category}}', ['id' => 8]);
        $this->delete('{{%category}}', ['id' => 9]);
        $this->delete('{{%category}}', ['id' => 10]);
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
