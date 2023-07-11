<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m230620_183610_brief
 */
class m230620_183610_brief extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%brief}}', [
            'id'                    => Schema::TYPE_PK,
            'unique_id'             => Schema::TYPE_STRING . ' NOT NULL',

            'type_id'               => Schema::TYPE_INTEGER,
            'name'                  => Schema::TYPE_STRING,
            'short_description'     => Schema::TYPE_TEXT,
            'description'           => Schema::TYPE_TEXT,
            'tag_id'                => Schema::TYPE_INTEGER,

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
        $this->dropTable('{{%brief}}');
    }
}
