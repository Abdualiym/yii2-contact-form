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
        // send to region
        $m = $this->mailer->compose()
            ->setTo(Contact::getEmailBy($form->region, $form->subject))
            ->setFrom(['noreply@infosystems.uz' => 'AK "Uztelecom" contact form'])
            ->setSubject(Contact::getSubjects($form->subject))
            ->setHtmlBody('Имя: ' . $form->name . '<br>Регион: ' . Contact::getRegions($form->region) . '<br>Телефон: ' . $form->phone . '<br>Email: ' . $form->email . '<br>Текст: ' . $form->text);

        if ($form->file) {
            $fullname = Yii::getAlias('@frontend/web/app-temp/') . Yii::$app->formatter->asTime(time(), "php:d-m-Y_H-i-s") . ' - fayl.' . $form->file->extension;
            $form->file->saveAs($fullname);
            $m->attach($fullname);
        }

        if (!$m->send()) {
            throw new \RuntimeException(Yii::t('contact', 'Sending message to branch email error.'));
        }

        // save to DB
        $message = new ContactMessages();
        $message->status = 1;
        $message->region_id = $form->region;
        $message->subject_id = $form->subject;
        $message->name = $form->name;
        $message->phone = $form->phone;
        $message->email = $form->email;
        $message->preferred_answer = $form->preferredAnswer;
        $message->text = $form->text;
        $message->file = $fullname ?? '';
        if ($message->save()) {

            // Send To User
            $m = $this->mailer->compose()
                ->setTo($form->email)
                ->setFrom(['noreply@uztelecom.uz' => 'AK "Uztelecom" contact form'])
                ->setSubject(Contact::getSubjects($form->subject))
                ->setHtmlBody('<div style="text-align: center;"><p>Спасибо за Ваше обращение!</p>
                <p>Регистрационный номер обращения ' . $message->id . '.</p>
            <p>Обращение будет рассмотрено в сроки, установленные Законом Республики Узбекистан</p> 
<p>«Об обращениях физических и юридических лиц».</p>
<p>О статусе рассмотрения Вашего обращения можете узнать, используя форму обратной связи на сайте Компании</p>');

            if (!$m->send()) {
                throw new \RuntimeException(Yii::t('contact', 'Sending message to user email error.'));
            }
        }
    }
}