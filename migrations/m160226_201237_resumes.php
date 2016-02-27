<?php

use yii\db\Schema;
use yii\db\Migration;

class m160226_201237_resumes extends Migration
{
    public function up()
    {
      $this->createTable('resumes', [
           'id' => Schema::TYPE_PK,
           'firstname' => Schema::TYPE_STRING . ' NOT NULL',
           'lastname' => Schema::TYPE_STRING . ' NOT NULL',
           'keywords' => Schema::TYPE_STRING . ' NOT NULL',
           'url' => Schema::TYPE_STRING . ' NOT NULL'

       ]);
    }

    public function down()
    {
        echo "m160226_201237_resumes cannot be reverted.\n";

        return false;
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
