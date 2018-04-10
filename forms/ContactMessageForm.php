<?php

namespace abdualiym\contactform\forms;

use abdualiym\contactform\Module;
use yii\base\Model;
use Yii;

class ContactMessageForm extends Model
{
    public $user_email;
    public $message;
    public $subject;

    public function rules()
    {


        return [
            ['user_email', 'email'],
            [['message'], 'required'],
            [['subject'], 'string', 'max' => 255],
            [['message'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'user_email' => Yii::t('contactform', 'E-mail address user'),
            'subject' => Yii::t('contactform', 'Subject'),
            'message' => Yii::t('contactform', 'Message text'),

        ];
    }
}
