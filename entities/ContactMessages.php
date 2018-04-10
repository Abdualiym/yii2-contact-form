<?php

namespace abdualiym\contactform\entities;

use abdualiym\contactform\Module;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "contact_messages".
 *
 * @property int $id
 * @property int $created_at
 * @property int $updated_at
 * @property int $status
 * @property int $region_id
 * @property int $subject_id
 */
class ContactMessages extends \yii\db\ActiveRecord
{


    const STATUS_WAIT = 0;
    const STATUS_NEW = 1;
    const STATUS_ARCHIVE = 2;
    const STATUS_READ = 3;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contact_form_messages';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('contactform', 'ID'),
            'created_at' => Yii::t('contactform', 'Created At'),
            'updated_at' => Yii::t('contactform', 'Updated At'),
            'status' => Yii::t('contactform', 'Статус'),
            'address' => Yii::t('contactform', 'Address'),
            'subject' => Yii::t('contactform', 'Subject'),
        ];
    }

    public function behaviors(): array
    {
        return [
            TimestampBehavior::class,
        ];
    }

}
