<?php

namespace frontend\controllers;

use backend\models\PortfolioSearch;
use Yii;
use yii\base\Controller;
use common\models\Portfolio;
use common\models\Tag;
use yii\data\ActiveDataProvider;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;

/**
 * Site controller
 */
class PortfolioController extends Controller
{
    public $layout = 'portfolio';

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
            'captcha' => [
                'class' => \yii\captcha\CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $this->view->title = 'Портфолио '.Yii::$app->name;

        $type = Yii::$app->request->get('type');
        $searchModel = new PortfolioSearch(['type' => $type]);
        $dataProvider = $searchModel->search();
        $tags = Tag::findModels()->all();
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'tags' => $tags,
        ]);
    }

    public function actionView()
    {
        if($model = Yii::$app->request->get('model')) {
            return $this->render('view', [
                'model' => $model,
            ]);
        }
        throw new NotFoundHttpException('Страница не найдена');
    }
}
