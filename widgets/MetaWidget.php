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
        return $this->render('_meta', [
            'text' => new TextMetaFields()
            ]);
    }
}