<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m230927_183259_visitors
 */
class m230927_183259_visitors extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%visitors}}', [
            'id'                    => Schema::TYPE_PK,
            'unique_id'             => Schema::TYPE_STRING . ' NOT NULL',

            'user_agent'            => Schema::TYPE_STRING,
            'remote_addr'           => Schema::TYPE_STRING,
            'http_referer'          => Schema::TYPE_TEXT,
            'get_params'            => Schema::TYPE_TEXT,

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
        $this->dropTable('{{%visitors}}');
    }
}
