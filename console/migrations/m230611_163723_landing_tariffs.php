<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m230611_163723_services
 */
class m230611_163723_landing_tariffs extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%landing_tariffs}}', [
            'id'                    => Schema::TYPE_PK,
            'unique_id'             => Schema::TYPE_STRING . ' NOT NULL',

            'name'                  => Schema::TYPE_STRING,
            'price'                 => Schema::TYPE_INTEGER,
            'old_price'             => Schema::TYPE_INTEGER,
            'term'                  => Schema::TYPE_INTEGER,
            'description'           => Schema::TYPE_TEXT,

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
        $this->dropTable('{{%landing_tariffs}}');
    }
}
