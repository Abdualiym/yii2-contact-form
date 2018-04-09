<?php

namespace abdualiym\contactform\services;

use abdualiym\contactform\entities\Contact;
use abdualiym\contactform\entities\ContactMessages;
use abdualiym\contactform\forms\ContactForm;
use Yii;
use yii\mail\MailerInterface;

class ContactMessagesService
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendMessage($form)
    {
        $m = $this->mailer->compose()
            ->setTo($form->email)
            ->setFrom(Yii::$app->controller->module->developmentEmail)
            ->setSubject($form->subject)
            ->setHtmlBody($form->message);
        if (!$m->send()) {
            throw new \RuntimeException(Yii::t('contactform', 'Sending message to branch email error.'));
        }

    }
}