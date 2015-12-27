<?php

use yii\db\Schema;
use yii\db\Migration;
use yii\db\Expression;

class m151128_163018_insert_page_table extends Migration
{
    public function up()
    {
        $this->insert('{{%page}}', [
            'id' => 1,
            'user_id' => 2,
            'live' => 1,
            'title' => 'Consequat bibendum quam liquam viverra',
            'content' => 'Curabitur quis libero leo, pharetra mattis eros. Praesent consequat libero eget dolor convallis vel
                        rhoncus magna scelerisque. Donec nisl ante, elementum eget posuere a, consectetur a metus. Proin a 
                        adipiscing sapien. Suspendisse vehicula porta lectus vel semper. Nullam sapien elit, lacinia eu tristique 
                        non.posuere at mi. Morbi at turpis id urna ullamcorper ullamcorper.',
            'created_at' => new Expression('NOW()'),
            'updated_at' => new Expression('NOW()')
         ]);
        $this->insert('{{%page}}', [
            'id' => 2,
            'user_id' => 2,
            'live' => 1,
            'title' => 'Consequat bibendum quam liquam viverra',
            'content' => 'Curabitur quis libero leo, pharetra mattis eros. Praesent consequat libero eget dolor convallis vel
                        rhoncus magna scelerisque. Donec nisl ante, elementum eget posuere a, consectetur a metus. Proin a 
                        adipiscing sapien. Suspendisse vehicula porta lectus vel semper. Nullam sapien elit, lacinia eu tristique 
                        non.posuere at mi. Morbi at turpis id urna ullamcorper ullamcorper.',
            'created_at' => new Expression('NOW()'),
            'updated_at' => new Expression('NOW()')
         ]);
        $this->insert('{{%page}}', [
            'id' => 3,
            'user_id' => 2,
            'live' => 1,
            'title' => 'Consequat bibendum quam liquam viverra',
            'content' => 'Curabitur quis libero leo, pharetra mattis eros. Praesent consequat libero eget dolor convallis vel
                        rhoncus magna scelerisque. Donec nisl ante, elementum eget posuere a, consectetur a metus. Proin a 
                        adipiscing sapien. Suspendisse vehicula porta lectus vel semper. Nullam sapien elit, lacinia eu tristique 
                        non.posuere at mi. Morbi at turpis id urna ullamcorper ullamcorper.',
            'created_at' => new Expression('NOW()'),
            'updated_at' => new Expression('NOW()')
         ]);
        $this->insert('{{%page}}', [
            'id' => 4,
            'user_id' => 2,
            'live' => 1,
            'title' => 'Consequat bibendum quam liquam viverra',
            'content' => 'Curabitur quis libero leo, pharetra mattis eros. Praesent consequat libero eget dolor convallis vel
                        rhoncus magna scelerisque. Donec nisl ante, elementum eget posuere a, consectetur a metus. Proin a 
                        adipiscing sapien. Suspendisse vehicula porta lectus vel semper. Nullam sapien elit, lacinia eu tristique 
                        non.posuere at mi. Morbi at turpis id urna ullamcorper ullamcorper.',
            'created_at' => new Expression('NOW()'),
            'updated_at' => new Expression('NOW()')
         ]);
        $this->insert('{{%page}}', [
            'id' => 5,
            'user_id' => 2,
            'live' => 0,
            'title' => 'Consequat bibendum quam liquam viverra',
            'content' => 'Curabitur quis libero leo, pharetra mattis eros. Praesent consequat libero eget dolor convallis vel
                        rhoncus magna scelerisque. Donec nisl ante, elementum eget posuere a, consectetur a metus. Proin a 
                        adipiscing sapien. Suspendisse vehicula porta lectus vel semper. Nullam sapien elit, lacinia eu tristique 
                        non.posuere at mi. Morbi at turpis id urna ullamcorper ullamcorper.',
            'created_at' => new Expression('NOW()'),
            'updated_at' => new Expression('NOW()')
         ]);
    }

    public function down()
    {
        $this->delete('{{%page}}', ['id' => 1]);
        $this->delete('{{%page}}', ['id' => 2]);
        $this->delete('{{%page}}', ['id' => 3]);
        $this->delete('{{%page}}', ['id' => 4]);
        $this->delete('{{%page}}', ['id' => 5]);
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
