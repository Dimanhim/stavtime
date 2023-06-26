<?php

namespace frontend\modules\profile;

use yii\filters\AccessControl;

/**
 * profile module definition class
 */
class Profile extends \yii\base\Module
{
    const ROUTE = '/profile/default';
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'frontend\modules\profile\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
}
