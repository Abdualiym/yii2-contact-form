<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 06.04.2018
 * Time: 12:51
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="content">
    <div class="section-title"><?= Html::encode($this->title) ?></div>
    <br><?= \common\widgets\Alert::widget() ?>
    <?= \frontend\widgets\MetaWidget::widget();?>
    <!--<div id="map"></div>-->
    <div class="col-md-12"><div class="col-md-6"><?= $text->value(9, 'longitude');?></div>
        <div class="col-md-6"><?= $text->value(9, 'latitude');?></div>
    </div></br>
    <div class="contact-form">
        <div class="section-title"><?= Yii::t('contactform', 'Feedback'); ?></div>

        <?php $form = ActiveForm::begin(['id' => 'callbackForm']); ?>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <?= $form->field($model, 'name')->textInput(['id' => 'name']) ?>
                </div>
                <div class="form-group">
                    <?= $form->field($model, 'email')->textInput(['id' => 'email']) ?>
                </div>
                <div class="form-group ">
                    <?= $form->field($model, 'phone')->textInput(['id' => 'tel', 'class'=> 'form-control phone_mask']) ?>
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
                    <?= $form->field($model, 'message')->textarea(['rows' => 10, 'id'=> 'message']) ?>
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


