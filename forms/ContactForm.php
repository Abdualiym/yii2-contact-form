<?php

namespace abdualiym\contactform\forms;

use abdualiym\contactform\Module;
use yii\base\Model;
use Yii;

class ContactForm extends Model
{
    public $name;
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
            [['name', 'phone', 'email', 'message', 'verifyCode'], 'required'],
            [['name', 'phone', 'subject'], 'string', 'max' => 255],
            [['phone'], 'match', 'pattern' => '#^[\+]?\d{3}\s\(\d{2}\)\s\d{3}\-\d{2}\-\d{}71$#'],
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

    public function attributeLabels()
    {
        return [
            'name' => Yii::t('contactform', 'Name'),
            'address' => Yii::t('contactform', 'Address'),
            'phone' => Yii::t('contactform', 'Phone'),
            'email' => Yii::t('contactform', 'E-mail address'),
            'subject' => Yii::t('contactform', 'Subject'),
            'message' => Yii::t('contactform', 'Message text'),
            'file' => Yii::t('contactform', 'File'),
            'verifyCode' => Yii::t('contactform', 'Protection from automatic messages')
        ];
    }
}
