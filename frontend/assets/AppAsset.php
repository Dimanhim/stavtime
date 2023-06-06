<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [];
    public $js = [];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset',
    ];

    public function init()
    {
        $this->css = static::getCss();
        $this->js = static::getJs();
    }

    private static function getCss()
    {
        return [
            'css/libs.min.css',
            'css/main.css?v='.mt_rand(1000,10000),
            'css/animate.css',
        ];
    }
    private static function getJs()
    {
        return [
            'https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js',
            'https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js',
            'js/libs.min.js',
            'js/inputmask.js',
            'js/jquery.inputmask.js',
            'js/wow.min.js',
            'js/common.js?v='.mt_rand(1000,10000),
        ];
    }
}
