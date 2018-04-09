<?php

namespace abdualiym\contactform\controllers;

use abdualiym\contactform\services\ContactMessagesService;
use Yii;
use abdualiym\contactform\entities\ContactMessages;
use abdualiym\contactform\forms\ContactMessagesSearch;
use yii\base\ViewContextInterface;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ContactMessagesController implements the CRUD actions for ContactMessages model.
 */
class ContactMessagesController extends Controller implements ViewContextInterface
{
    private $service;

    public function __construct($id, $module, ContactMessagesService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }


    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function getViewPath()
    {
        return Yii::getAlias('@vendor/abdualiym/yii2-contact-form/views/contact-messages');
    }

    public function actionIndex()
    {
        $searchModel = new ContactMessagesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionView($id)
    {
        $message = new ContactMessages();
        $message->status = $message::STATUS_READ;
        $message->save();
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    public function actionSend($id)
    {
        $model = new ContactMessages();
        if ($model->load(Yii::$app->request->post())) {
            try {
                $this->service->sendMessage($model);
                Yii::$app->session->setFlash('success', Yii::t('contactform', 'Your message has been successfully sent!'));
                return $this->redirect(['view', 'id' => $model->id]);
            } catch (\Exception $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', Yii::t('contactform', 'There was an error sending your message.'));
            }
        }
        return $this->render('reply', [
            'model' => $model,
            'email' => $this->findModel($id)->email
        ]);
    }


    protected function findModel($id)
    {
        if (($model = ContactMessages::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
