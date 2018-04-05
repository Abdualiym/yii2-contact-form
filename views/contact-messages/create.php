<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model abdualiym\contactform\entities\ContactMessages */

$this->title = Yii::t('app', 'Create Contact Messages');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contact Messages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-messages-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
