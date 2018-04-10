<?php

namespace frontend\widgets;


use abdualiym\text\entities\TextMetaFields;
use yii\base\Widget;

class ContactFormWidget extends Widget
{
    public $form;

    public function run()
    {
        return $this->render('_contact-form', [
            'model' => $this->form, 'text' => new TextMetaFields()
        ]);
    }
}