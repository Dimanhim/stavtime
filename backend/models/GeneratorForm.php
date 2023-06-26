<?php

namespace backend\models;

use backend\components\Generator;
use yii\base\Model;

class GeneratorForm extends Model
{
    public $type_id;
    public $order_id;

    public function rules()
    {
        return [
            [['type_id', 'order_id'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'type_id' => 'Тип',
            'order_id' => 'Заявка',
        ];
    }

    public function getContent()
    {
        $generator = new Generator($this);
        if($generator->template) {
            return \Yii::$app->controller->renderPartial($generator->template, [

            ]);
        }
    }






}
