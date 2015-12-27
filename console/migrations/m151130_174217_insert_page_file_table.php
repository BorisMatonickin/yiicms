<?php

use yii\db\Schema;
use yii\db\Migration;

class m151130_174217_insert_page_file_table extends Migration
{
    public function up()
    {
        $this->insert('{{%page_file}}', [
            'page_id' => 1,
            'file_id' => 1,
        ]);
        $this->insert('{{%page_file}}', [
            'page_id' => 2,
            'file_id' => 2,
        ]);
        $this->insert('{{%page_file}}', [
            'page_id' => 3,
            'file_id' => 3,
        ]);
        $this->insert('{{%page_file}}', [
            'page_id' => 4,
            'file_id' => 4,
        ]);
        $this->insert('{{%page_file}}', [
            'page_id' => 5,
            'file_id' => 5,
        ]);
    }

    public function down()
    {
        $this->delete('{{%page_file}}', ['page_id' => 1]);
        $this->delete('{{%page_file}}', ['page_id' => 2]);
        $this->delete('{{%page_file}}', ['page_id' => 3]);
        $this->delete('{{%page_file}}', ['page_id' => 4]);
        $this->delete('{{%page_file}}', ['page_id' => 5]);
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
