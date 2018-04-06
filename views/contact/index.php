<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model abdualiym\contactform\forms\ContactForm */

use abdualiym\contactform\Module;
use abdualiym\contactform\entities\Contact;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = Yii::t('contactform', 'Contacts');
$this->params['breadcrumbs'][] = $this->title;
/*
 * ignor
 *
 * <?//= $form->field($model, 'file')->fileInput() ?>
        <?//= $form->field($model, 'region')->dropDownList(Contact::getRegions()) ?>
        <?//= $form->field($model, 'subject')->dropDownList(Contact::getSubjects()) ?>
 */

?>
<div class="content">
    <div class="section-title"><?= Html::encode($this->title) ?></div>
    <br><?= \common\widgets\Alert::widget() ?>
    <address><a class="contact" href="tel:+998710000000"><i class="icon-phone"></i>+998 (71) 000 00 00</a><a class="contact" href="mailto:info@infosystems.uz"><i class="icon-mail"></i>info@infosystems.uz</a></address>
    <div id="map"></div>
    <div class="contact-form">
        <div class="section-title"><?= Yii::t('contactform', 'Feedback'); ?></div>

        <?php $form = ActiveForm::begin(['id' => 'callbackForm']); ?>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <?= $form->field($model, 'name')->textInput() ?>
                </div>
                <div class="form-group">
                    <?= $form->field($model, 'email')->textInput() ?>
                </div>
                <div class="form-group ">
                    <?= $form->field($model, 'phone')->textInput() ?>
                </div>
                <div class="form-group">
                    <?= $form->field($model, 'verifyCode')->widget(\yii\captcha\Captcha::className(), [
                        'captchaAction' => ['/captcha'],
                        'template' => '<div class="row"><div class="col-sm-6">{image}</div><div class="col-sm-6">{input}</div></div>'
                    ]) ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?= $form->field($model, 'message')->textarea(['rows' => 10]) ?>
                </div>
            </div>
        </div>
        <?= Html::submitButton(Yii::t('contactform', 'Send'), [
            'class' => 'btn btn-primary',
            'name' => 'contact-button'
        ]) ?>
        <?php ActiveForm::end(); ?>
    </div>

</div>

<?php ob_start(); ?>
<script type="text/javascript" charset="utf-8">
    document.getElementById("tasix-verifycode-image").setAttribute("title", "<?= Yii::t('app', 'Change image') ?>");
    // });
</script>
<?php $this->registerJs(preg_replace('~^\s*<script.*>|</script>\s*$~ U', '', ob_get_clean())) ?>

