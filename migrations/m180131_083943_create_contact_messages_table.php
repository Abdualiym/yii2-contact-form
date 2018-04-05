<?php

use yii\db\Migration;

/**
 * Handles the creation of table `contact_messages`.
 */
class m180131_083943_create_contact_messages_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

        $this->createTable('contact_messages', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'updated_at' => $this->integer()->unsigned()->notNull(),
            'status' => $this->integer()->notNull(),
            'region_id' => $this->integer()->notNull(),
            'subject_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('{{%index-contact_messages-status}}', '{{%contact_messages}}', 'status');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('contact_messages');
    }
}
