<?php

namespace abdualiym\contactform\services;

use abdualiym\contactform\entities\Contact;
use abdualiym\contactform\entities\ContactMessages;
use abdualiym\contactform\forms\ContactForm;
use Yii;
use yii\helpers\VarDumper;
use yii\mail\MailerInterface;
use yii\web\UploadedFile;

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
        //VarDumper::dump($all['all'], 10, true);die();
        $name = Yii::t('contactform', 'Name').': '.$all['all']['name'];
        $surname = Yii::t('contactform', 'Surname').': '.$all['all']['surname'];
        $patronymic = Yii::t('contactform', 'Patronymic').': '.$all['all']['patronymic'];
        $type_user = Yii::t('contactform', 'Type of user').': '.$all['all']['type_user'];
        $type_appeal = Yii::t('contactform', 'Type of message').': '.$all['all']['type_appeal'];
        $date_birth = Yii::t('contactform', 'Date of Birth').': '.$all['all']['date_birth'];
        $subject = Yii::t('contactform', 'Subject').': '.$all['all']['subject'];
        $message = Yii::t('contactform', 'Message text').': '.$all['all']['message'];
        $region = Yii::t('contactform', 'Region').': '.$all['all']['region'];
        $address = Yii::t('contactform', 'Address').': '.$all['all']['address'];
        $phone = Yii::t('contactform', 'Phone').': '.$all['all']['phone'];
        $email = Yii::t('contactform', 'E-mail').': '.$all['all']['email'];

        $content = <<<HTML
        <h2>$name</h2><br>
        <h2>$surname</h2><br>
        <h2>$patronymic</h2><br>
        <h4>$subject</h4><br>
        <h4>$type_user</h4><br>
        <h4>$date_birth</h4><br>
        <h4>$type_appeal</h4><br>
        <span>$message</span><br>
        <span>$region</span><br>
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
            $fullname = Yii::getAlias('@frontend/web/app-temp/') . Yii::$app->formatter->asTime(time(), "php:d-m-Y_H-i-s").'-fayl-'.$all['all']['email'].'.' . $form->file->extension;
            $form->file->saveAs($fullname);
            $m->attach($fullname);
        }
        //VarDumper::dump($form->file, 10, true);die();

        if (!$m->send()) {
            throw new \RuntimeException(Yii::t('contactform', 'Sending message to branch email error.'));
        }


               $message = new ContactMessages();
               $message->status = $message::STATUS_NEW;
               $message->name = $all['all']['name'];
               $message->surname = $all['all']['surname'];
               $message->patronymic = $all['all']['patronymic'];
               $message->type_user = $all['all']['type_user'];
               $message->type_appeal = $all['all']['type_appeal'];
               //$message->date_birth = $all['all']['date_birth'];
               $message->phone = $all['all']['phone'];
               $message->email = $all['all']['email'];
               $message->subject = $all['all']['subject'];
               $message->address = $all['all']['address'];
               $message->message = $all['all']['message'];
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