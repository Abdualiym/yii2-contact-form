<?php

use yii\db\Migration;

/**
 * Handles the creation of table `contact_form_messages`.
 */
class m180405_100029_create_contact_form_messages_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

        $this->createTable('contact_form_messages', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'subject' => $this->string(),
            'phone' => $this->string(),
            'email' => $this->string(),
            'address' => $this->string(),
            'message' => $this->text(),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'updated_at' => $this->integer()->unsigned()->notNull(),
            'status' => $this->integer()->notNull(),
            'file' => $this->string(),
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('contact_form_messages');
    }
}
