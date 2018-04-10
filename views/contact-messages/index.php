<?php

use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $searchModel abdualiym\contactform\forms\ContactMessagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = \Yii::t('contactform', 'Feedback');
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="contact-messages-index">

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'id',
                'label' => '№',
            ],
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function ($model) {
                    return \abdualiym\contactform\helpers\ContactMessagesHelper::statusLabel($model->status);
                },
                'label' => Yii::t('contactform', 'Status'),
            ],
            [
                'attribute' => 'name',
                'label' => Yii::t('contactform', 'Name'),
            ],
            [
                'attribute' => 'phone',
                'label' => Yii::t('contactform', 'Phone'),
            ],
            [
                'attribute' => 'email',
                'label' => Yii::t('contactform', 'E-mail'),
            ],
            /*[
                'attribute' => 'subject',
                'label' => Yii::t('contactform', 'Subject'),
            ],
            [
                'attribute' => 'address',
                'label' => Yii::t('contactform', 'Address'),
            ],
            [
                'attribute' => 'file',
                'label' => Yii::t('contactform', 'File'),
            ],

            [
                'attribute' => 'message.ntext',
                'label' => Yii::t('contactform', 'Message text'),
            ],*/
            [
                'attribute' => 'created_at',
                'format' => 'datetime',
                'label' => Yii::t('contactform', 'Date receive'),
            ],
            [
                'label'=>Yii::t('contactform', 'Actions'),
                'format' => 'html',
                'value'=>function ($model) {
                if($model->replyMessage($model->id) == null || empty($model->replyMessage($model->id))){
                    return '<a href="/contactform/contact-messages/send?id='.$model->id.'"><i class="fa fa-send"></i> '.Yii::t('contactform', 'Reply').'</a><br>
                            <a href="/contactform/contact-messages/view?id='.$model->id.'"><i class="fa fa-eye"></i> '.Yii::t('contactform', 'View').'</a><br>';
                }else{
                    return '<a href="/contactform/contact-messages/view?id='.$model->id.'"><i class="fa fa-eye"></i> '.Yii::t('contactform', 'View').'</a><br>';
                }

                },
            ],
           //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
