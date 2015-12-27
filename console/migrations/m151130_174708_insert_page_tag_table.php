<?php

use yii\db\Schema;
use yii\db\Migration;

class m151130_174708_insert_page_tag_table extends Migration
{
    public function up()
    {
        $this->insert('{{%page_tag}}', [
            'page_id' => 1,
            'tag_id' => 6,
        ]);
        $this->insert('{{%page_tag}}', [
            'page_id' => 1,
            'tag_id' => 13,
        ]);
        $this->insert('{{%page_tag}}', [
            'page_id' => 2,
            'tag_id' => 9,
        ]);
        $this->insert('{{%page_tag}}', [
            'page_id' => 2,
            'tag_id' => 15,
        ]);
        $this->insert('{{%page_tag}}', [
            'page_id' => 3,
            'tag_id' => 11,
        ]);
        $this->insert('{{%page_tag}}', [
            'page_id' => 3,
            'tag_id' => 12,
        ]);
        $this->insert('{{%page_tag}}', [
            'page_id' => 4,
            'tag_id' => 2,
        ]);
        $this->insert('{{%page_tag}}', [
            'page_id' => 4,
            'tag_id' => 10,
        ]);
        $this->insert('{{%page_tag}}', [
            'page_id' => 5,
            'tag_id' => 7,
        ]);
        $this->insert('{{%page_tag}}', [
            'page_id' => 5,
            'tag_id' => 14,
        ]);
    }

    public function down()
    {
        $this->delete('{{%page_tag}}', ['page_id' => 1]);
        $this->delete('{{%page_tag}}', ['page_id' => 2]);
        $this->delete('{{%page_tag}}', ['page_id' => 3]);
        $this->delete('{{%page_tag}}', ['page_id' => 4]);
        $this->delete('{{%page_tag}}', ['page_id' => 5]);
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
