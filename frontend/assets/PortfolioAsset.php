<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class PortfolioAsset extends AssetBundle
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
            'css/jquery.fancybox.min.css',
            'css/libs.min.css',
            'css/main.css?v='.mt_rand(1000,10000),
            'css/styles.css?v='.mt_rand(1000,10000),
        ];
    }
    private static function getJs()
    {
        return [
            'js/jquery.fancybox.min.js',
            'js/libs.min.js',
            'js/inputmask.js',
            'js/jquery.inputmask.js',
            'js/wow.min.js',
            'js/common.js?v='.mt_rand(1000,10000),
            'js/filter.js?v='.mt_rand(1000,10000),
        ];
    }
}
