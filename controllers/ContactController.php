<?php

namespace abdualiym\contactform\controllers;

use abdualiym\contactform\forms\ContactForm;
use abdualiym\contactform\services\ContactService;
use Yii;
use yii\base\ViewContextInterface;
use yii\web\Controller;

/*
 * Default controller for the `contact` module
 */
class ContactController extends Controller implements ViewContextInterface
{
    private $service;

    public function __construct($id, $module, ContactService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }


    public function getViewPath()
    {
        return Yii::getAlias('@vendor/abdualiym/yii2-contacts/views/contact');
    }


    public function actionIndex()
    {
        $form = new ContactForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->send($form);
                Yii::$app->session->setFlash('success', Yii::t('contact', 'Thank you! Your application is accepted!'));
            } catch (\Exception $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', Yii::t('contact', 'There was an error sending your message.'));
            }
//            return $this->refresh();
        }

        return $this->render('index', [
            'model' => $form,
        ]);
    }


    public function actionTest($mail = 'a.abdualiym@gmail.com')
    {
        $m = Yii::$app->mailer->compose()
            ->setTo($mail)
            ->setFrom('noreply@infosystems.uz')
            ->setSubject('Test' . date('d-m-Y, H:i:s'))
            ->setHtmlBody('Тест');

        if (!$m->send()) {
            throw new \RuntimeException(\Yii::t('app', 'Sending error.'));
        } else {
            echo 'Ok! Email send to ' . $mail;
        }
    }


}
