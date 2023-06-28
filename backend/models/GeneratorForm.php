<?php

namespace backend\models;

use backend\components\Generator;
use yii\base\Model;

class GeneratorForm extends Model
{
    const PDF_CSS_FILE_PATH = '/backend/web/css/pdf.css';

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

    public function cssInline()
    {
        $filePath = $_SERVER['DOCUMENT_ROOT'].self::PDF_CSS_FILE_PATH;
        if(file_exists($filePath)) {
            return file_get_contents($filePath);
        }
        return false;
    }






}
