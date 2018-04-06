<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model abdualiym\contactform\forms\ContactForm */

use abdualiym\contactform\Module;
use abdualiym\contactform\entities\Contact;
use yii\helpers\Html;

$this->title = Yii::t('contactform', 'Contacts');
$this->params['breadcrumbs'][] = $this->title;

echo \frontend\widgets\ContactFormWidget::widget(['form'=>$form]);
?>

