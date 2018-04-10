<?php

namespace abdualiym\contactform\entities;

use abdualiym\contactform\Module;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "contact_messages".
 *
 * @property int $id
 * @property int $created_at
 * @property int $updated_at
 * @property int $status
 * @property int $message
 * @property int $subject
 */
class ReplyMessage extends \yii\db\ActiveRecord
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
        return 'contactform_reply_message';
    }

    public function behaviors(): array
    {
        return [
            BlameableBehavior::className(),
            TimestampBehavior::className(),
            [
                'class' => SaveRelationsBehavior::className(),
            ],
        ];
    }

}
