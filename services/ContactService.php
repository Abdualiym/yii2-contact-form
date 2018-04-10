<?php

namespace abdualiym\contactform\services;

use abdualiym\contactform\entities\Contact;
use abdualiym\contactform\entities\ContactMessages;
use abdualiym\contactform\forms\ContactForm;
use Yii;
use yii\helpers\VarDumper;
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
        foreach ($form as $key => $value){
            $arr_message[$key] = $value;
            $all['all'] = $arr_message;
        }
        $name = Yii::t('contactform', 'Name').': '.$all['all']['name'];
        $subject = Yii::t('contactform', 'Subject').': '.$all['all']['subject'];
        $message = Yii::t('contactform', 'Message text').': '.$all['all']['message'];
        $address = Yii::t('contactform', 'Address').': '.$all['all']['address'];
        $phone = Yii::t('contactform', 'Phone').': '.$all['all']['phone'];
        $email = Yii::t('contactform', 'E-mail').': '.$all['all']['email'];

        $content = <<<HTML
        <h2>$name</h2><br>
        <h4>$subject</h4><br>
        <span>$message</span><br>
        <span>$address</span><br>
        <b>$phone</b><br>
        <b>$email</b><br>

HTML;
        $m = $this->mailer->compose()
            ->setTo(Yii::$app->controller->module->email)
            ->setFrom(Yii::$app->controller->module->email)
            ->setSubject(Yii::t('contactform', 'Message from {attributeEmail}'),['attributeEmail' => $all['all']['email']])
            ->setHtmlBody($content);

        if ($form->file) {
            $fullname = Yii::getAlias('@frontend/web/app-temp/') . Yii::$app->formatter->asTime(time(), "php:d-m-Y_H-i-s") . ' - fayl.' . $form->file->extension;
            $form->file->saveAs($fullname);
            $m->attach($fullname);
        }

        if (!$m->send()) {
            throw new \RuntimeException(Yii::t('contactform', 'Sending message to branch email error.'));
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
                   $content = Yii::t('contactform', 'Thank you for your message! Your message will be considered soon.');
                   // Send To User
                   $m2 = $this->mailer->compose()
                       ->setTo($form->email)
                       ->setFrom(Yii::$app->params['supportEmail'])
                       ->setSubject($subject)
                       ->setHtmlBody($content);

                   if (!$m2->send()) {
                       throw new \RuntimeException(Yii::t('contactform', 'Sending message to user email error.'));
                   }
               }
    }
}