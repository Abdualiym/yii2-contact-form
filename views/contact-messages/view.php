<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model abdualiym\contactform\entities\ContactMessages */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('contactform', 'Feedback'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-messages-view">
    <?php echo Html::a(Yii::t('contactform', 'Delete'), ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger pull-right',
        'data' => [
            'confirm' => Yii::t('contactform', 'Are you sure you want to delete this message?'),
            'method' => 'post',
        ]
    ]) ?>
    <h3><?= Yii::t('contactform', 'Name')?>: <?= Html::encode($this->title) ?></h3>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'email',
            [
                'attribute' => 'created_at',
                'format' => 'datetime',
                'label' => Yii::t('app', 'Created At')
            ],
            [
                'attribute' => 'updated_at',
                'format' => 'datetime',
                'label' => Yii::t('app', 'Updated At')
            ],
            [
                'attribute' => 'subject',
                'format' => 'text',
                'label' => Yii::t('app', 'Subject')
            ],
            [
                'attribute' => 'message',
                'format' => 'text',
                'label' => Yii::t('app', 'Message text')
            ],
        ],
    ]) ?>

    <div class="box box-default">

        <div class="box-header with-border"><?= Yii::t('contactform', 'Reply to: {nameAttribute}', ['nameAttribute' => $model->email ]) ?></div>

        <div class="box-body">
            <!-- Nav tabs -->
            <?php foreach ($model->replyMessage($model->id) as $item): ?>
            <span>
                <?= Yii::t('contactform', 'Created by')?>
                :

                <?= $model->createdBy($item->created_by); ?>
            </span><br>
                <span>
                <?= Yii::t('contactform', 'Created at')?>:

                    <?= \Yii::$app->formatter->asDatetime($item->created_at, "php:d-m-Y H:i:s"); ?>
            </span>
                <br>
            <blockquote><?= $item->message; ?></blockquote>
            <?php endforeach; ?>
        </div>
    </div>
</div>
