<?php

namespace abdualiym\contactform\services;

use abdualiym\contactform\entities\Contact;
use abdualiym\contactform\entities\ContactMessages;
use abdualiym\contactform\entities\ReplyMessage;
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
            ->setTo($form->user_email)
            ->setFrom(Yii::$app->params['supportEmail'])
            ->setSubject(Yii::t('contactform', 'Reply message').' '.Yii::$app->params['frontendHostInfo'])
            ->setHtmlBody($form->message);

            $reply = new ReplyMessage();
            $reply->user_email = $form->user_email;
            $reply->message = $form->message;
            $reply->status = $reply::STATUS_ARCHIVE;
            $reply->save();

        if (!$m->send()) {
            throw new \RuntimeException(Yii::t('contactform', 'Sending message to branch email error.'));
        }

    }
}