<?php

namespace frontend\components;

use Yii;
use frontend\components\Header;
use yii\base\Component;

class Site extends Component
{
    public $h1 = 'Разработка<br/><span>Landing Page</span>';
    public $title = 'Создание продающих лендингов';
    public $utm_source = '';
    public $utm_campaign = '';
    public $utm_medium = '';
    public $utm_content = '';
    public $utm_term = '';

    public function init()
    {
        $this->initSite();
        return parent::init();
    }



    public $multi_key = 0;

    public function initSite()
    {
        $this->setUtms();
        $this->createH1();
        $this->createTitle();
    }

    public function createTitle()
    {
        $this->title = strip_tags($this->h1);
    }



    public function setUtms()
    {
        $this->utm_source = Yii::$app->request->get('utm_source');
        $this->utm_campaign = Yii::$app->request->get('utm_campaign');
        $this->utm_medium = Yii::$app->request->get('utm_medium');
        $this->utm_content = Yii::$app->request->get('utm_content');
        $this->utm_term = Yii::$app->request->get('utm_term');
    }

    public function createH1()
    {
        $working_out = 'Разработка';
        $create = 'Создание';
        $sale = 'продающих';
        $product = array(
            'Landing',
            'Лендинг',
            'Лендингов',
            'одностраничных сайтов'
        );
        $key = ' под ключ';
        $word_1 = 'Разработка';

        if(preg_match("/создание/i", $this->utm_term)) $word_1 = $create;
        else $word_1 = $working_out;
        if(preg_match("/продающих/i", $this->utm_term)) $word_2 = $sale.' ';
        else $word_2 = '';

        if(preg_match("/landing/i", $this->utm_term)) $word_2 .= $product[0].' Page';
        else if(preg_match("/лендинг /i", $this->utm_term)) $word_2 .= $product[1].' Пейдж';
        else if(preg_match("/лендингов/i", $this->utm_term)) $word_2 .= $product[2];
        else if(preg_match("/одностранич/i", $this->utm_term)) $word_2 .= $product[3];
        else $word_2 .= $product[0].' Page';
        if(preg_match("/ключ/i", $this->utm_term)) $word_2 .= ' '.$key;
        $header = $word_1.'<br /><span>'.$word_2.'</span>';
        $this->h1 = $header;
    }





}
