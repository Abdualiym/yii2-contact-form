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
            [['phone'], 'match', 'pattern' => '#^[\+]?[0-9]{12}$#'],
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
            'name' => Yii::t('contact', 'NAME'),
            'address' => Yii::t('contact', 'REGION'),
            'phone' => Yii::t('contact', 'CONTACT TELEPHONE NUMBER'),
            'email' => Yii::t('contact', 'E-MAIL ADDRESS'),
            'subject' => Yii::t('contact', 'ADDRESS SUBJECT'),
            'message' => Yii::t('contact', 'MESSAGE TEXT'),
            'file' => Yii::t('contact', 'ATTACH THE FILE'),
            'verifyCode' => Yii::t('contact', 'PROTECTION FROM AUTOMATIC MESSAGES')
        ];
    }
}
