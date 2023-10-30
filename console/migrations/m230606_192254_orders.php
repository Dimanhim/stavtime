<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m230606_192254_orders
 */
class m230606_192254_orders extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%orders}}', [
            'id'                    => Schema::TYPE_PK,
            'unique_id'             => Schema::TYPE_STRING . ' NOT NULL',

            'name'                  => Schema::TYPE_STRING,
            'order_name'            => Schema::TYPE_STRING,
            'client_id'             => Schema::TYPE_INTEGER,
            'status_id'             => Schema::TYPE_INTEGER,
            'service_id'            => Schema::TYPE_INTEGER,
            'landing_tariff_id'     => Schema::TYPE_INTEGER,
            'price'                 => Schema::TYPE_INTEGER,
            'phone'                 => Schema::TYPE_STRING,
            'email'                 => Schema::TYPE_STRING,
            'split_template'        => Schema::TYPE_STRING,
            'pressed_btn'           => Schema::TYPE_STRING,
            'utm_source'            => Schema::TYPE_TEXT,
            'utm_campaign'          => Schema::TYPE_TEXT,
            'utm_medium'            => Schema::TYPE_TEXT,
            'utm_content'           => Schema::TYPE_TEXT,
            'utm_term'              => Schema::TYPE_TEXT,
            'comment'               => Schema::TYPE_TEXT,
            'send_brief'            => Schema::TYPE_SMALLINT,

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
        $this->dropTable('{{%orders}}');
    }
}
