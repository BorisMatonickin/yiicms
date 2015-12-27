<?php

use yii\db\Schema;
use yii\db\Migration;

class m151130_173519_insert_page_category_table extends Migration
{
    public function up()
    {
        $this->insert('{{%page_category}}', [
            'page_id' => 1,
            'category_id' => 2,
        ]);
        $this->insert('{{%page_category}}', [
            'page_id' => 2,
            'category_id' => 8,
        ]);
        $this->insert('{{%page_category}}', [
            'page_id' => 3,
            'category_id' => 7,
        ]);
        $this->insert('{{%page_category}}', [
            'page_id' => 4,
            'category_id' => 8,
        ]);
        $this->insert('{{%page_category}}', [
            'page_id' => 5,
            'category_id' => 6,
        ]);
    }

    public function down()
    {
        $this->delete('{{%page_category}}', ['page_id' => 1]);
        $this->delete('{{%page_category}}', ['page_id' => 2]);
        $this->delete('{{%page_category}}', ['page_id' => 3]);
        $this->delete('{{%page_category}}', ['page_id' => 4]);
        $this->delete('{{%page_category}}', ['page_id' => 5]);
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
