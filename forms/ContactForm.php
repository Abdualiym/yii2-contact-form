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
    public $region;
    public $subject;
    public $preferredAnswer;
    public $text;
    public $file;
    public $verifyCode;

    public function rules()
    {
        return [
            [['name', 'phone', 'email', 'region', 'subject', 'text', 'verifyCode'], 'required'],
            [['name', 'phone'], 'string', 'max' => 255],
            [['phone'], 'match', 'pattern' => '#^[\+]?[0-9]{12}$#'],
            ['email', 'email'],
            [['region', 'subject', 'preferredAnswer'], 'integer'],
            [['preferredAnswer'], 'default', 'value' => 1],
            ['text', 'string'],
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
            'region' => Yii::t('contact', 'REGION'),
            'phone' => Yii::t('contact', 'CONTACT TELEPHONE NUMBER'),
            'email' => Yii::t('contact', 'E-MAIL ADDRESS'),
            'subject' => Yii::t('contact', 'ADDRESS SUBJECT'),
            'preferredAnswer' => Yii::t('contact', 'HOW DO YOU WANT TO RECEIVE AN ANSWER'),
            'text' => Yii::t('contact', 'MESSAGE TEXT'),
            'file' => Yii::t('contact', 'ATTACH THE FILE'),
            'verifyCode' => Yii::t('contact', 'PROTECTION FROM AUTOMATIC MESSAGES')
        ];
    }
}
