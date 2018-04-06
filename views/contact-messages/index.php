<?php

use yii\grid\GridView;
use yii\widgets\Pjax;


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
            [
                'attribute' => 'subject',
                'label' => Yii::t('contactform', 'Subject'),
            ],
            [
                'attribute' => 'address',
                'label' => Yii::t('contactform', 'Address'),
            ],
            [
                'attribute' => 'message.ntext',
                'label' => Yii::t('contactform', 'Message'),
            ],
            [
                'attribute' => 'created_at',
                'format' => 'datetime',
                'label' => Yii::t('contactform', 'Дата'),
            ],
           //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
