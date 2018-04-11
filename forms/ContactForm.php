<?php

namespace abdualiym\contactform\forms;

use abdualiym\contactform\helpers\ContactMessagesHelper;
use abdualiym\contactform\Module;
use yii\base\Model;
use Yii;

class ContactForm extends Model
{
    public $name;
    public $surname;
    public $patronymic;
    public $type_user;
    public $type_appeal;
    public $region;
    public $date_birth;
    public $phone;
    public $email;
    public $address;
    public $subject;
    public $message;
    public $file;
    public $verifyCode;

    public function rules()
    {


        return [
            ['fio', 'required', 'when' => function($model) {
                if(Yii::$app->controller->module->nameRequired){
                    return $this->validateAttributeMessage($model->name);
                }
            }],
            ['surname', 'required', 'when' => function($model) {
                if(Yii::$app->controller->module->surnameRequired){
                    return $this->validateAttributeMessage($model->surname);
                }
            }],
            ['patronymic', 'required', 'when' => function($model) {
                if(Yii::$app->controller->module->patronymicRequired){
                    return $this->validateAttributeMessage($model->patronymic);
                }
            }],
            ['type_user', 'required', 'when' => function($model) {
                if(Yii::$app->controller->module->type_userRequired){
                    return $this->validateAttributeMessage($model->type_user);
                }
            }],
            ['type_appeal', 'required', 'when' => function($model) {
                if(Yii::$app->controller->module->type_appealRequired){
                    return $this->validateAttributeMessage($model->type_appeal);
                }
            }],
            ['region', 'required', 'when' => function($model) {
                if(Yii::$app->controller->module->regionRequired){
                    return $this->validateAttributeMessage($model->region);
                }
            }],
            ['date_birth', 'required', 'when' => function($model) {
                if(Yii::$app->controller->module->date_birthRequired){
                    return $this->validateAttributeMessage($model->date_birth);
                }
            }],
            ['phone', 'required', 'when' => function($model) {
                if(Yii::$app->controller->module->phoneRequired){
                    return $this->validateAttributeMessage($model->phone);
                }
            }],
            ['email', 'required', 'when' => function($model) {
                if(Yii::$app->controller->module->emailRequired){
                   return $this->validateAttributeMessage($model->email);
                }
            }],
            ['subject', 'required', 'when' => function($model) {
                if(Yii::$app->controller->module->subjectRequired){
                    return $this->validateAttributeMessage($model->subject);
                }
            }],
            ['address', 'required', 'when' => function($model) {
                if(Yii::$app->controller->module->addressRequired){
                    return $this->validateAttributeMessage($model->address);
                }
            }],
            ['message', 'required', 'when' => function($model) {
                if(Yii::$app->controller->module->messageRequired){
                    return $this->validateAttributeMessage($model->message);
                }
            }],
            ['verifyCode', 'required', 'when' => function($model) {
                if(Yii::$app->controller->module->verifyCodeRequired){
                    return $this->validateAttributeMessage($model->verifyCode);
                }
            }],
            //[['name', 'phone', 'email', 'message', 'verifyCode'], 'required'],
            [['name', 'phone', 'subject'], 'string', 'max' => 255],
            [['phone'], 'match', 'pattern' => '#^[\+]?\d{3}\s\(\d{2}\)\s\d{3}\-\d{2}\-\d{2}$#'],
            ['email', 'email'],
            [['address', 'message'], 'string'],
            [
                'file', 'file', 'skipOnEmpty' => true, // file NOT REQUIRED
                'extensions' => ['zip', 'rar', 'pdf'],
                'checkExtensionByMimeType' => true, // Force for check file by "magic" bytes
                'maxFiles' => 1,
                'maxSize' => 10 * 1024 * 1024 // 10 MB
            ],
            ['verifyCode', 'captcha'],
        ];
    }

    public function ValidateAttributeMessage($attributeName)
    {
        return empty($model->$attributeName)? true : false;
    }


    public function type_appeal_list(): array
    {
        return ContactMessagesHelper::type_appeal_List();
    }

    public function type_user_list(): array
    {
        return ContactMessagesHelper::type_user_List();
    }

    public function attributeLabels()
    {
        return [
            'name' => Yii::t('contactform', 'Name'),
            'address' => Yii::t('contactform', 'Address'),
            'date_birth' => Yii::t('contactform', 'Date of Birth'),
            'surname' => Yii::t('contactform', 'Surname'),
            'patronymic' => Yii::t('contactform', 'Patronymic'),
            'region' => Yii::t('contactform', 'Region'),
            'type_user' => Yii::t('contactform', 'Type of user'),
            'type_appeal' => Yii::t('contactform', 'Type of message'),
            'phone' => Yii::t('contactform', 'Phone'),
            'email' => Yii::t('contactform', 'E-mail address'),
            'subject' => Yii::t('contactform', 'Subject'),
            'message' => Yii::t('contactform', 'Message text'),
            'file' => Yii::t('contactform', 'File'),
            'verifyCode' => Yii::t('contactform', 'Protection from automatic messages')
        ];
    }
}
