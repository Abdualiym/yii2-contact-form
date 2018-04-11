<?php

namespace abdualiym\contactform;

/**
 * contactform module definition class
 */
class Module extends \yii\base\Module
{
    public $controllerNamespace = 'abdualiym\contactform\controllers';

    public $email = false;
    public $nameRequired = true;
    public $emailRequired = true;
    public $phoneRequired = true;
    public $messageRequired = true;
    public $verifyCodeRequired = true;
    public $subjectRequired = true;
    public $addressRequired = true;
    public $surnameRequired = true;
    public $patronymicRequired = true;
    public $type_userRequired = true;
    public $type_appealRequired = true;
    public $regionRequired = true;
    public $date_birthRequired = true;
}
