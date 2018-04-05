<?php

use yii\grid\GridView;
use yii\widgets\Pjax;
use Yii;

/* @var $this yii\web\View */
/* @var $searchModel abdualiym\contactform\forms\ContactMessagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('contact', 'Feedback');
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
                'label' => Yii::t('contact', 'Регистрационный номер обращения'),
            ],
            'name',
            'phone',
            'email',
            'text:ntext',
            [
                'attribute' => 'created_at',
                'format' => 'datetime',
                'label' => Yii::t('contact', 'Дата'),
            ],
            [
                'attribute' => 'region_id',
                'value' => function ($model) {
                    return \abdualiym\contactform\entities\Contact::getRegions($model->region_id);
                },
            ],
            [
                'attribute' => 'subject_id',
                'value' => function ($model) {
                    return \abdualiym\contactform\entities\Contact::getSubjects($model->subject_id);
                },
            ],

//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
