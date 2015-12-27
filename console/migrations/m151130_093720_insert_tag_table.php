<?php

use yii\db\Schema;
use yii\db\Migration;

class m151130_093720_insert_tag_table extends Migration
{
    public function up()
    {
        $this->insert('{{%tag}}', [
            'id' => 1,
            'tag_title' => 'Office',
        ]);
        $this->insert('{{%tag}}', [
            'id' => 2,
            'tag_title' => 'Race',
        ]);
        $this->insert('{{%tag}}', [
            'id' => 3,
            'tag_title' => 'London',
        ]);
        $this->insert('{{%tag}}', [
            'id' => 4,
            'tag_title' => 'Barcelona',
        ]);
        $this->insert('{{%tag}}', [
            'id' => 5,
            'tag_title' => 'Football',
        ]);
        $this->insert('{{%tag}}', [
            'id' => 6,
            'tag_title' => 'Apple',
        ]);
        $this->insert('{{%tag}}', [
            'id' => 7,
            'tag_title' => 'Health',
        ]);
        $this->insert('{{%tag}}', [
            'id' => 8,
            'tag_title' => 'Fitness',
        ]);
        $this->insert('{{%tag}}', [
            'id' => 9,
            'tag_title' => 'Stock',
        ]);
        $this->insert('{{%tag}}', [
            'id' => 10,
            'tag_title' => 'Sci-Fi',
        ]);
        $this->insert('{{%tag}}', [
            'id' => 11,
            'tag_title' => 'Biology',
        ]);
        $this->insert('{{%tag}}', [
            'id' => 12,
            'tag_title' => 'Evolution',
        ]);
        $this->insert('{{%tag}}', [
            'id' => 13,
            'tag_title' => 'IT',
        ]);
        $this->insert('{{%tag}}', [
            'id' => 14,
            'tag_title' => 'Food',
        ]);
        $this->insert('{{%tag}}', [
            'id' => 15,
            'tag_title' => 'Finance',
        ]);
    }

    public function down()
    {
        $this->delete('{{%tag}}', ['id' => 1]);
        $this->delete('{{%tag}}', ['id' => 2]);
        $this->delete('{{%tag}}', ['id' => 3]);
        $this->delete('{{%tag}}', ['id' => 4]);
        $this->delete('{{%tag}}', ['id' => 5]);
        $this->delete('{{%tag}}', ['id' => 6]);
        $this->delete('{{%tag}}', ['id' => 7]);
        $this->delete('{{%tag}}', ['id' => 8]);
        $this->delete('{{%tag}}', ['id' => 9]);
        $this->delete('{{%tag}}', ['id' => 10]);
        $this->delete('{{%tag}}', ['id' => 11]);
        $this->delete('{{%tag}}', ['id' => 12]);
        $this->delete('{{%tag}}', ['id' => 13]);
        $this->delete('{{%tag}}', ['id' => 14]);
        $this->delete('{{%tag}}', ['id' => 15]);
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
