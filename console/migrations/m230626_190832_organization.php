<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m230626_190832_organization
 */
class m230626_190832_organization extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%organization}}', [
            'id'                    => Schema::TYPE_PK,
            'unique_id'             => Schema::TYPE_STRING . ' NOT NULL',

            'name'                  => Schema::TYPE_STRING,
            'organization_name'     => Schema::TYPE_STRING,
            'position_name'         => Schema::TYPE_STRING,
            'action_basis'          => Schema::TYPE_STRING,
            'person_name'           => Schema::TYPE_STRING,
            'short_person_name'     => Schema::TYPE_STRING,
            'phone'                 => Schema::TYPE_STRING,
            'email'                 => Schema::TYPE_STRING,
            'legal_address'         => Schema::TYPE_STRING,
            'actual_address'        => Schema::TYPE_STRING,
            'inn'                   => Schema::TYPE_STRING,
            'kpp'                   => Schema::TYPE_STRING,
            'okpo'                  => Schema::TYPE_STRING,
            'ogrn'                  => Schema::TYPE_STRING,
            'rs'                    => Schema::TYPE_STRING,
            'kors'                  => Schema::TYPE_STRING,
            'bik'                   => Schema::TYPE_STRING,
            'bank_name'             => Schema::TYPE_STRING,

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
        $this->dropTable('{{%organization}}');
    }
}
