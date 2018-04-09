<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model abdualiym\contactform\entities\ContactMessages */

$this->title = Yii::t('contactform', 'Reply user message: {nameAttribute}', [
    'nameAttribute' => $model->email,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('contactform', 'Contact Messages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('contactform', 'Reply');
?>
<div class="contact-messages-reply">

    <div class="contact-messages-form">

        <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'email')->textInput(['value' => $email, 'readonly'=> true])->label(false) ?>
        <?= $form->field($model, 'subject')->textInput() ?>
        <div class="form-group">
            <?= $form->field($model, 'message')->widget(\mihaildev\ckeditor\CKEditor::class); ?>
        </div>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Send'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>


</div>
