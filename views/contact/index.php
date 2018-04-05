<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model abdualiym\contactform\forms\ContactForm */

use abdualiym\contactform\Module;
use abdualiym\contactform\entities\Contact;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = Yii::t('contact', 'Feedback');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= Yii::t('contact', '&nbsp;') ?>

    <?= \common\widgets\Alert::widget() ?>

    <p style="color: red;">* - <?= Yii::t('contact', 'REQUIRED FIELDS') ?></p>

    <div class="row">

        <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
        <div class="col-sm-6">
            <?= $form->field($model, 'subject')->dropDownList(Contact::getSubjects()) ?>

            <?= $form->field($model, 'name')->textInput() ?>

            <?= $form->field($model, 'region')->dropDownList(Contact::getRegions()) ?>
        </div>
        <div class="col-sm-6">

            <?= $form->field($model, 'phone')->textInput() ?>

            <?= $form->field($model, 'email')->textInput() ?>

            <?php //= $form->field($model, 'preferredAnswer')->dropDownList(Contact::getPreferredAnswers()) ?>
        </div>
        <div class="col-sm-12 contact-form-text">
            <?= $form->field($model, 'text')->textarea(['rows' => 10]) ?>
        </div>
        <div class="col-sm-6 contact-form-captcha">
            <?= $form->field($model, 'verifyCode')->widget(\yii\captcha\Captcha::className(), [
                'captchaAction' => ['/captcha'],
                'template' => '<div class="row"><div class="col-sm-6">{image}</div><div class="col-sm-6">{input}</div></div>'
            ]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'file')->fileInput() ?>
        </div>

        <div class="col-sm-12">
            <div class="form-group">
                <?= Html::submitButton(Yii::t('contact', 'Send'), [
                    'class' => 'btn btn-primary',
                    'name' => 'contact-button'
                ]) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
