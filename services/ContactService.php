<?php

namespace abdualiym\contactform\services;

use abdualiym\contactform\entities\Contact;
use abdualiym\contactform\entities\ContactMessages;
use abdualiym\contactform\forms\ContactForm;
use Yii;
use yii\mail\MailerInterface;

class ContactService
{
    private $adminEmail;
    private $mailer;

    public function __construct($adminEmail, MailerInterface $mailer)
    {
        $this->adminEmail = $adminEmail;
        $this->mailer = $mailer;
    }

    public function send(ContactForm $form)
    {
        $arr_message = [];
        if(!empty($form->region) && isset($form->region)){ $arr_message['region'] = "<br>".Yii::t('contact', 'Address').": ".$form->region;}else{$arr_message['region'] =''; }
        if(!empty($form->subject) && isset($form->subject)){ $arr_message['subject'] = "<br>".Yii::t('contact', 'Subject').": ".$form->subject;}else{$arr_message['subject'] =''; }
        if(!empty($form->name) && isset($form->name)){ $arr_message['name'] = "<br>".Yii::t('contact', 'Name').": ".$form->name;}else{$arr_message['name'] =''; }
        if(!empty($form->phone) && isset($form->phone)){ $arr_message['phone'] = "<br>".Yii::t('contact', 'Phone').": ".$form->phone;}else{$arr_message['phone'] =''; }
        if(!empty($form->email) && isset($form->email)){ $arr_message['email'] = "<br>".Yii::t('contact', 'Email').": ".$form->email;}else{$arr_message['email'] =''; }
        if(!empty($form->message) && isset($form->message)){ $arr_message['message'] = "<br>".Yii::t('contact', 'Message').": ".$form->message;}else{$arr_message['message'] =''; }
            $arr_message_all[] = $arr_message;
        $m = $this->mailer->compose()
            ->setTo(Yii::$app->controller->module->developmentEmail)
            ->setFrom(Yii::$app->controller->module->developmentEmail)
            ->setSubject('te2')
            ->setHtmlBody('
            '.$arr_message['region'].'
            '.$arr_message['subject'].'
            '.$arr_message['name'].'
            '.$arr_message['phone'].'
            '.$arr_message['email'].'
            '.$arr_message['message'].'');

        if ($form->file) {
            $fullname = Yii::getAlias('@frontend/web/app-temp/') . Yii::$app->formatter->asTime(time(), "php:d-m-Y_H-i-s") . ' - fayl.' . $form->file->extension;
            $form->file->saveAs($fullname);
            $m->attach($fullname);
        }

        if (!$m->send()) {
            throw new \RuntimeException(Yii::t('contact', 'Sending message to branch email error.'));
        }


               $message = new ContactMessages();
               $message->status = 1;
               $message->name = $form->name;
               $message->phone = $form->phone;
               $message->email = $form->email;
               $message->message = $form->message;
               //$message->file = $fullname ?? '';

               if ($message->save()) {

                   if($form->subject){$subject = $form->subject;
                   }else{
                       $subject = $form->name;
                   }
                   $content = Yii::t('contact', 'Thank you for your message! Your message will be considered soon.');
                   // Send To User
                   $m2 = $this->mailer->compose()
                       ->setTo($form->email)
                       ->setFrom(Yii::$app->controller->module->developmentEmail)
                       ->setSubject($subject)
                       ->setHtmlBody($content);

                   if (!$m2->send()) {
                       throw new \RuntimeException(Yii::t('contact', 'Sending message to user email error.'));
                   }
               }
    }
}