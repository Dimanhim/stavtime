<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m230618_131242_notifications
 */
class m230618_131242_notifications extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%notifications}}', [
            'id'                    => Schema::TYPE_PK,
            'unique_id'             => Schema::TYPE_STRING . ' NOT NULL',

            'name'                  => Schema::TYPE_STRING,
            'model_type'            => Schema::TYPE_INTEGER,        // orders, documents, messages и т.д.
            'type_id'               => Schema::TYPE_INTEGER,        // новая заявка, новый документ, обновлен документ и т.д.
            'model_id'              => Schema::TYPE_INTEGER,        // id сущности
            'message'               => Schema::TYPE_TEXT,
            'user_seen'             => Schema::TYPE_SMALLINT,
            'manager_seen'          => Schema::TYPE_SMALLINT,
            'client_id'             => Schema::TYPE_INTEGER,
            'user_id'               => Schema::TYPE_INTEGER,

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
        $this->dropTable('{{%notifications}}');
    }
}
