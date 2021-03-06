<?php

use yii\db\Migration;

/**
 * Handles the creation of table `contactform_reply_message`.
 */
class m180409_124027_create_contactform_reply_message_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

        $this->createTable('contactform_reply_message', [
            'id' => $this->primaryKey(),
            'subject' => $this->string(),
            'message_id' => $this->integer()->comment('User message id'),
            'user_email' => $this->string(),
            'message' => $this->text(),
            'created_by' => $this->integer()->unsigned()->notNull(),
            'updated_by' => $this->integer()->unsigned()->notNull(),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'updated_at' => $this->integer()->unsigned()->notNull(),
            'status' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('fk_contactform_reply_message_contactform__message_id', 'contactform_reply_message', 'message_id', 'contact_form_messages', 'id', 'SET NULL', 'SET NULL');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('contactform_reply_message');
    }
}
