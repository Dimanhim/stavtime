<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m230610_150556_portfolio
 */
class m230610_150556_portfolio extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%portfolio}}', [
            'id'                    => Schema::TYPE_PK,
            'unique_id'             => Schema::TYPE_STRING . ' NOT NULL',

            'order_id'              => Schema::TYPE_INTEGER,
            'name'                  => Schema::TYPE_STRING,
            'price'                 => Schema::TYPE_INTEGER,
            'price_lead'            => Schema::TYPE_INTEGER,
            'conversion'            => Schema::TYPE_FLOAT,
            'link'                  => Schema::TYPE_STRING,
            'description'           => Schema::TYPE_TEXT,
            'comment'               => Schema::TYPE_TEXT,
            'created_date'          => Schema::TYPE_INTEGER,
            'is_private'            => Schema::TYPE_SMALLINT . ' DEFAULT 1',

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
        $this->dropTable('{{%portfolio}}');
    }
}
