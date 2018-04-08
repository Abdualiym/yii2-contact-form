<?php
namespace frontend\widgets;


use abdualiym\text\entities\TextMetaFields;
use yii\base\Widget;

class MetaWidget extends Widget
{
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        //TextMetaFields::find()->where(['text_id' => $id, 'key'=> $key])->one()->value;
        $text = TextMetaFields::find()->where(['text_id' => 9])->all();
        return $this->render('_meta', ['text' => $text]);
    }
}