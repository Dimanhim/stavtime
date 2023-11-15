<?php

namespace frontend\controllers;

use common\models\Portfolio;
use frontend\components\PortfolioFilter;
use Yii;
use yii\filters\ContentNegotiator;
use yii\filters\Cors;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;
use backend\models\PortfolioSearch;

class AjaxController extends Controller
{
    public $result = ['result' => 0, 'message' => null, 'html' => null];
    public $errors = [];

    /**
     * @return array
     */
    public function behaviors() {
        return [
            [
                'class' => ContentNegotiator::className(),
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        $avaliables = ['change-filter'];
        if(in_array($action->id, $avaliables)) {
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }


    public function actionChangeFilter()
    {
        if(Yii::$app->request->isAjax) {
            $requestParams = self::requestParams(Yii::$app->request->post('data'));
            $type = Yii::$app->request->post('type') ? Portfolio::PRIVATE_PARAM : null;
            $searchModel = new PortfolioSearch(['type' => $type]);
            $filterItems = $searchModel->filterItems($requestParams);
            $html = $this->renderPartial('//portfolio/_filter', [
                'searchModel' => $searchModel,
                'dataProvider' => $filterItems->dataProvider,
                'requestParams' => $requestParams,
            ]);
            if($html) {
                $this->result['html'] = $html;
            }
        }
        return $this->responseAjax();
    }



    public static function requestParams($postData = null)
    {
        $data = [];
        if($postData) {
            foreach($postData as $requestParam) {
                if($requestParam) {
                    foreach($requestParam as $paramName => $paramValue) {
                        $data[$paramName][] = $paramValue;
                    }
                }
            }
        }
        return $data;
    }

    public function responseAjax()
    {
        if(!$this->errors and $this->result['html']) {
            $this->result['result'] = 1;
        }
        else {
            $this->result['message'] = 'Произоша ошибка';
            $this->result['html'] = null;
        }
        return $this->result;
    }



}
