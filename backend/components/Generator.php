<?php

namespace backend\components;

use kartik\mpdf\Pdf;
use yii\base\Component;

class Generator
{
    const TYPE_CONTRACT          = 1;
    const TYPE_ACT               = 2;
    const TYPE_INVOICE           = 3;

    const TEMPLATE_FOLDER = '//document/templates/';

    public $template;

    public function __construct($model = null)
    {
        if($model) {
            $this->template = $this->getTemplatePath($model->type_id);
        }
    }

    /**
     * @return array
     */
    public static function getTypes()
    {
        return [
            self::TYPE_CONTRACT => 'Договор',
            self::TYPE_ACT      => 'Акт выполненных работ',
            self::TYPE_INVOICE  => 'Счет',
        ];
    }

    public static function getTemplates()
    {
        return [
            self::TYPE_CONTRACT => '_contract',
            self::TYPE_ACT      => '_act',
            self::TYPE_INVOICE  => '_invoice',
        ];
    }

    public function getTemplatePath($type_id)
    {
        $templates = self::getTemplates();
        if(array_key_exists($type_id, $templates)) return self::TEMPLATE_FOLDER.$templates[$type_id];
        return false;

    }

}
