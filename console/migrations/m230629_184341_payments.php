<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m230629_184341_payments
 */
class m230629_184341_payments extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%payments}}', [
            'id'                    => Schema::TYPE_PK,
            'unique_id'             => Schema::TYPE_STRING . ' NOT NULL',

            'type_id'               => Schema::TYPE_INTEGER,
            'client_id'             => Schema::TYPE_INTEGER,
            'order_id'              => Schema::TYPE_INTEGER,
            'document_id'           => Schema::TYPE_INTEGER,
            'bank'                  => Schema::TYPE_STRING,
            'name'                  => Schema::TYPE_STRING,
            'short_description'     => Schema::TYPE_TEXT,
            'description'           => Schema::TYPE_TEXT,
            'price'                 => Schema::TYPE_INTEGER,

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
        $this->dropTable('{{%payments}}');
    }
}
