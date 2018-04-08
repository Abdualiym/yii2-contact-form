<?php

namespace frontend\widgets;


use yii\base\Widget;

class ContactFormWidget extends Widget
{
    public $form;

    public function run()
    {
        return $this->render('_contact-form', [
            'model' => $this->form
        ]);
    }
}