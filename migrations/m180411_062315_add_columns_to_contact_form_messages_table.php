<?php

use yii\db\Migration;

/**
 * Handles the creation of table `add_columns_to_contact_form_messages`.
 */
class m180411_062315_add_columns_to_contact_form_messages_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('contact_form_messages', 'surname', $this->string());
        $this->addColumn('contact_form_messages', 'patronymic', $this->string());
        $this->addColumn('contact_form_messages', 'type_user', $this->integer());
        $this->addColumn('contact_form_messages', 'type_appeal', $this->integer());
        $this->addColumn('contact_form_messages', 'region', $this->string());
        $this->addColumn('contact_form_messages', 'date_birth', $this->date());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        echo "m180411_062315_add_columns_to_contact_form_messages_table cannot be reverted.\n";

        return false;
    }
}
