<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model abdualiym\contactform\entities\ContactMessages */

$this->title = Yii::t('contactform', 'Reply user message: {nameAttribute}', [
    'nameAttribute' => $data->email,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('contactform', 'Feedback'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $data->email, 'url' => ['view', 'id' => $data->id]];
$this->params['breadcrumbs'][] = Yii::t('contactform', 'Reply');
?>
<div class="contact-messages-reply">


    <div class="contact-messages-form">

        <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'message_id')->hiddenInput(['value' => $data->id])->label(false) ?>
        <?= $form->field($model, 'user_email')->textInput(['value' => $data->email, 'readonly'=> true])->label(false) ?>
        <br>
        <span><?= Yii::t('contactform', 'Message')?></span>
        <blockquote><?= $data->message; ?></blockquote>

        <div class="form-group">
            <?= $form->field($model, 'message')->widget(\mihaildev\ckeditor\CKEditor::className(),
            [
                'editorOptions' => [
                    'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                    'inline' => false, //по умолчанию false
                    'rows' =>6
                ],
            ]); ?>
        </div>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Send'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>


</div>
