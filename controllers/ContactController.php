<?php

namespace abdualiym\contactform\controllers;

use abdualiym\contactform\forms\ContactForm;
use abdualiym\contactform\services\ContactService;
use Yii;
use yii\base\ViewContextInterface;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\UploadedFile;

/**
 * Default controller for the `contact` module
 */
class   ContactController extends Controller implements ViewContextInterface
{
    private $service;

    public function __construct($id, $module, ContactService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }


    public function getViewPath()
    {
        return Yii::getAlias('@vendor/abdualiym/yii2-contact-form/views/contact');
    }


    public function actionIndex()
    {
        //VarDumper::dump(Yii::$app->request->post(), 10, true);die();
        $form = new ContactForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $form->file = UploadedFile::getInstance($form, 'file');
            try {
                //VarDumper::dump($form->file, 10, true); die();
                $this->service->send($form);

                Yii::$app->session->setFlash('success', Yii::t('contactform', 'Thank you! Your application is accepted!'));
            } catch (\Exception $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', Yii::t('contactform', 'There was an error sending your message.'));
            }
//            return $this->refresh();
        }
        return $this->render('index', [
            'form' => $form,
        ]);
    }


    public function actionTest($mail = 'a.abdualiym@gmail.com')
    {
        $m = Yii::$app->mailer->compose()
            ->setTo($mail)
            ->setFrom(Yii::$app->controller->module->developmentEmail)//email connected to server
            ->setSubject('Test' . date('d-m-Y, H:i:s'))
            ->setHtmlBody('Тест');

        if (!$m->send()) {
            throw new \RuntimeException(\Yii::t('app', 'Sending error.'));
        } else {
            echo 'Ok! Email send to ' . $mail;
        }
    }


}
