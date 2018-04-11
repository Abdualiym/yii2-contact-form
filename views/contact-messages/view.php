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
            [
                'attribute' => 'name',
                'format' => 'text',
                'label' => Yii::t('contactform', 'Name')
            ],
            [
                'attribute' => 'surname',
                'format' => 'text',
                'label' => Yii::t('contactform', 'Surname')
            ],
            [
                'attribute' => 'patronymic',
                'format' => 'text',
                'label' => Yii::t('contactform', 'Patronymic')
            ],
            'email',
            [
                'attribute' => 'region',
                'format' => 'text',
                'label' => Yii::t('contactform', 'Region')
            ],
            [
                'attribute' => 'address',
                'format' => 'text',
                'label' => Yii::t('contactform', 'Address')
            ],
            [
                'attribute' => 'type_user',
                'format' => 'text',
                'label' => Yii::t('contactform', 'Type of user')
            ],
            [
                'attribute' => 'type_appeal',
                'format' => 'text',
                'label' => Yii::t('contactform', 'Type of message')
            ],
            [
                'attribute' => 'date_birth',
                'format' => 'date',
                'label' => Yii::t('contactform', 'Created at')
            ],
            [
                'attribute' => 'created_at',
                'format' => 'datetime',
                'label' => Yii::t('contactform', 'Created at')
            ],
            [
                'attribute' => 'updated_at',
                'format' => 'datetime',
                'label' => Yii::t('contactform', 'Updated at')
            ],
            [
                'attribute' => 'subject',
                'format' => 'text',
                'label' => Yii::t('contactform', 'Subject')
            ],
            [
                'attribute' => 'message',
                'format' => 'text',
                'label' => Yii::t('contactform', 'Message text')
            ],
            [
                'attribute'=>'file',
                'label' => Yii::t('contactform', 'Attach file'),
                'format'=>'raw',
                'value'=>'<a class="fa fa-file" href="'.\yii\helpers\Url::to(Yii::$app->params['staticHostInfo'].'/app/contactform/'.$model->file).'"> Файл</a>',
            ],

        ],
    ]) ?>

    <div class="box box-default">

        <div class="box-header with-border"><?= Yii::t('contactform', 'Reply message') ?></div>

        <div class="box-body">
            <!-- Nav tabs -->
            <?php
            if($messages = $model->replyMessage($model->id)):
            foreach ($messages as $item): ?>
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
            <?php endforeach;
            endif;
            ?>
        </div>
    </div>
</div>
