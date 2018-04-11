<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 06.04.2018
 * Time: 12:51
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$lang = \abdualiym\languageClass\Language::getLangByPrefix(\Yii::$app->language);

?>
<div class="content">
    <div class="section-title"><?= Html::encode($this->title) ?></div>
    <br><?= \common\widgets\Alert::widget() ?>
    <?= \frontend\widgets\MetaWidget::widget(); ?>
    <!--<div id="map"></div>-->
    <?php
    if ($modelcontent = \abdualiym\text\entities\TextTranslation::find()->where(['parent_id' => 9, 'lang_id' => $lang['id']])->one()) {
        echo $modelcontent->content;
    }
    ?>
    <div class="contact-form">
        <!--<div class="section-title"><?php /*echo Yii::t('contactform', 'Feedback'); */ ?></div>-->

        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'id' => 'callbackForm']]); ?>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <?= $form->field($model, 'name')->textInput(['id' => 'name']) ?>
                </div>
                <div class="form-group">
                    <?= $form->field($model, 'surname')->textInput(['id' => 'name']) ?>
                </div>
                <div class="form-group">
                    <?= $form->field($model, 'patronymic')->textInput(['id' => 'name']) ?>
                </div>
                <div class="form-group">
                    <?= $form->field($model, 'email')->textInput(['id' => 'email']) ?>
                </div>
                <div class="form-group ">
                    <?= $form->field($model, 'phone')->textInput(['id' => 'tel', 'class' => 'form-control phone_mask']) ?>
                </div>

                <div class="form-group">
                    <?= $form->field($model, 'region')->textInput(['id' => 'region']) ?>
                </div>

                <div class="form-group">
                    <?= $form->field($model, 'address')->textInput(['id' => 'address']) ?>
                </div>
                <div class="form-group">
                    <?= $form->field($model, 'verifyCode')->widget(\yii\captcha\Captcha::className(), [
                        'captchaAction' => ['/captcha'],
                        'template' => '<div class="row"><div class="col-sm-6">{image}</div><div class="col-sm-6">{input}</div></div>'
                    ]) ?>
                </div>
                <div class="form-group">
                    <?= $form->field($model, 'type_user')->radioList($model->type_user_list()); ?>
                </div>
            </div>
            <div class="col-md-6">

                <div class="form-group">
                    <?= $form->field($model, 'type_appeal')->dropDownList($model->type_appeal_list()) ?>
                </div>
                <div class="form-group">
                    <?= $form->field($model, 'date_birth')->textInput(['id' => 'date', 'type' => 'date']) ?>
                </div>
                <div class="form-group">
                    <?= $form->field($model, 'message')->textarea(['rows' => 10, 'id' => 'message']) ?>
                </div>
                <div class="form-group">
                    <?= $form->field($model, 'file')->fileInput() ?>
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


