<?php

use yii\db\Schema;
use yii\db\Migration;

class m151203_092438_add_image_columns_to_user_page extends Migration
{
    public function up()
    {
        $this->addColumn('{{%user}}', 'profile_image', $this->string(60)->defaultValue(null) . ' AFTER last_name');
        $this->addColumn('{{%page}}', 'cover_image', $this->string(60)->defaultValue(null) . ' AFTER content');
        $this->update('{{%page}}', ['cover_image' => 'blog1.jpg'], ['id' => 1]);
        $this->update('{{%page}}', ['cover_image' => 'blog2.jpg'], ['id' => 2]);
        $this->update('{{%page}}', ['cover_image' => '730_1_134914_01_726x290.jpg'], ['id' => 3]);
        $this->update('{{%page}}', ['cover_image' => '730_1_134975_01_726x290.jpg'], ['id' => 4]);
        $this->update('{{%page}}', ['cover_image' => '12382382840340f.jpg'], ['id' => 5]);
    }

    public function down()
    {
        $this->dropColumn('{{%user}}', 'profile_image');
        $this->dropColumn('{{%page}}', 'cover_image');
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
