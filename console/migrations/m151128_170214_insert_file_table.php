<?php

use yii\db\Schema;
use yii\db\Migration;
use yii\db\Expression;

class m151128_170214_insert_file_table extends Migration
{
    public function up()
    {
        $this->insert('{{%file}}', [
            'id' => 1,
            'user_id' => 2,
            'name' => 'blog1.jpg',
            'type' => 'image/jpeg',
            'size' => 124808,
            'description' => 'cover-image',
            'created_at' => new Expression('NOW()'),
            'updated_at' => new Expression('NOW()')
        ]);
        $this->insert('{{%file}}', [
            'id' => 2,
            'user_id' => 2,
            'name' => 'blog2',
            'type' => 'image/jpeg',
            'size' => 37492,
            'description' => 'cover-image',
            'created_at' => new Expression('NOW()'),
            'updated_at' => new Expression('NOW()')
        ]);
        $this->insert('{{%file}}', [
            'id' => 3,
            'user_id' => 2,
            'name' => '730_1_134914_01_726x290.jpg',
            'type' => 'image/jpeg',
            'size' => 21504,
            'description' => 'cover-image',
            'created_at' => new Expression('NOW()'),
            'updated_at' => new Expression('NOW()')
        ]);
        $this->insert('{{%file}}', [
            'id' => 4,
            'user_id' => 2,
            'name' => '730_1_134975_01_726x290',
            'type' => 'image/jpeg',
            'size' => 29696,
            'description' => 'cover-image',
            'created_at' => new Expression('NOW()'),
            'updated_at' => new Expression('NOW()')
        ]);
        $this->insert('{{%file}}', [
            'id' => 5,
            'user_id' => 2,
            'name' => '12382382840340f.jpg',
            'type' => 'image/jpeg',
            'size' => 139032,
            'description' => 'cover-image',
            'created_at' => new Expression('NOW()'),
            'updated_at' => new Expression('NOW()')
        ]);
    }

    public function down()
    {
        $this->delete('{{%file}}', ['id' => 1]);
        $this->delete('{{%file}}', ['id' => 2]);
        $this->delete('{{%file}}', ['id' => 3]);
        $this->delete('{{%file}}', ['id' => 4]);
        $this->delete('{{%file}}', ['id' => 5]);
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
