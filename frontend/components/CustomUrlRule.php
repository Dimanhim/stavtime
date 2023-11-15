<?php

namespace frontend\components;

use common\models\Portfolio;
use yii\base\BaseObject;
use yii\web\UrlRuleInterface;

class CustomUrlRule extends BaseObject implements UrlRuleInterface
{
    public function createUrl($manager, $route, $params)
    {
        return false; // this rule does not apply
    }

    /**
     * @param \yii\web\UrlManager $manager
     * @param \yii\web\Request $request
     * @return array|bool
     * @throws \yii\base\InvalidConfigException
     */
    public function parseRequest($manager, $request)
    {
        $pathInfo = $request->getPathInfo();
        $pathParts = explode('/', $pathInfo);

        if(isset($pathParts[0]) and isset($pathParts[1]) and $pathParts[0] == 'portfolio') {
            $unique_id = $pathParts[1];
            if($portfolio = Portfolio::findOne(['is_active' => 1, 'unique_id' => $unique_id])) {
                return ['portfolio/view', [
                    'model' => $portfolio
                ]];
            }
        }
        return false;
    }
}
