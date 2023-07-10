<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m230708_213009_office
 */
class m230708_213009_office extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%office}}', [
            'id'                    => Schema::TYPE_PK,
            'unique_id'             => Schema::TYPE_STRING . ' NOT NULL',

            'name'                  => Schema::TYPE_STRING,
            'number'                => Schema::TYPE_INTEGER,
            'document_id'           => Schema::TYPE_INTEGER,
            'office_date'           => Schema::TYPE_INTEGER,

            'is_active'             => Schema::TYPE_SMALLINT . ' DEFAULT 1',
            'deleted'               => Schema::TYPE_SMALLINT,
            'position'              => Schema::TYPE_INTEGER,
            'created_at'            => Schema::TYPE_INTEGER,
            'updated_at'            => Schema::TYPE_INTEGER,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%office}}');
    }
}
