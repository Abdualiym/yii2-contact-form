<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model abdualiym\contactform\entities\ContactMessages */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('contactform', 'Message'), 'url' => ['index']];
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
    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
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
            'name',
            'subject',
            'message.text',
        ],
    ]) ?>

</div>
