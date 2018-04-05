<?php

use yii\db\Migration;

/**
 * Handles the creation of table `contact_messages`.
 */
class m180131_083944_alter_contact_messages_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('contact_messages', 'name', $this->string(255));
        $this->addColumn('contact_messages', 'phone', $this->string(255));
        $this->addColumn('contact_messages', 'email', $this->string(255));
        $this->addColumn('contact_messages', 'preferred_answer', $this->string(255));
        $this->addColumn('contact_messages', 'text', $this->text());
        $this->addColumn('contact_messages', 'file', $this->string(255));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('contact_messages');
    }
}
