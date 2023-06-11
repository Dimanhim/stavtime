<?php

namespace frontend\components;

use yii\base\Component;

class Site extends Component
{
    public $multi_key = 0;

    public function getTitle()
    {
        return 'Создание продающих лендингов';
    }
    public function getH1()
    {
        return 'Разработка<br/><span>Landing Page</span>';
    }




}
