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
    public $verifyCodeRequired = true;
    public $subjectRequired = true;
}
