<?php

namespace frontend\components;

use common\models\PortfolioTag;
use common\models\Tag;
use yii\base\Model;
use common\models\Portfolio;

class PortfolioFilter extends Model
{
    const PARAMS_FILE_NAME = 'upload/filter-params.txt';

    public $dataProvider;

    private $searchParams = [];

    // массив параметров фильтра
    // передается вот в таком виде ['filter_teacher' => [3], 'filter_general' => [1,2]]
    public $params;
    public $searchModel;

    // отфильтрованные модели Portfolio
    public $models = [];

    // ID отфильтрованных моделей Portfolio
    public $modelIds = [];


    public function init()
    {
        $this->setSearchParams();
        $this->setModels();
    }


    /**
     * Загружает dataProvider
     */
    private function setSearchParams()
    {
        $searchModel = $this->searchModel;
        $className = $searchModel::className();
        $class = end(explode('\\', $className));
        $queryParams = [
            $class => [],
        ];
        if($this->params) {
            foreach($this->params as $paramName => $paramValues) {
                $queryParams[$class][$paramName] = $paramValues;
            }
        }
        $this->searchParams = $queryParams;
        $this->dataProvider = $this->searchModel->search($this->searchParams);
    }

    /**
     * Загружает модели ->models и ->modelIds
     */
    private function setModels()
    {
        $this->models = $this->dataProvider->getModels();
        if($this->models) {
            foreach($this->models as $model) {
                $this->modelIds[] = $model->id;
            }
        }
    }



    /**
     * Возвращает все данные по фильтру Filter
     *
     * @param $type_id
     * @return array
     */
    public function getFilterList($showAll = true)
    {
        $data = [];
        $totalCount = count($this->models);
        if($filters = Tag::findModels()->all()) {
            foreach($filters as $filter) {
                $eachData = $filter->attributes;
                $eachData += ['count' => $this->getCountForItem($filter->id)];
                $eachData += ['disabled' => $eachData['count'] < 1];
                $eachData += ['active' => false];
                $data[] = $eachData;
                //$totalCount += $eachData['count'];
            }
        }
        if($showAll) {
            $all = [[
                'id' => 'all',
                'name' => 'Все',
                'disabled' => $totalCount < 1,
                'count' => $totalCount,
                'active' => true,
            ]];
        }

        return $showAll ? array_merge($all, $data) : $data;
    }


    /**
     * Получает количество по фильтру Filter
     *
     * @param $filter_id
     * @return int
     */
    public function getCountForItem($filter_id)
    {
        $count = 0;
        if($this->filterItems) {
            foreach($this->filterItems as $filterItem) {
                if($filterItem->filter_id == $filter_id) {
                    $count++;
                }
            }
        }
        return $count;
    }



    public static function checkedInput($id, $type, $requestParams)
    {
        if(!$requestParams) return false;
        if(!isset($requestParams[$type])) return false;
        return in_array($id, $requestParams[$type]);
    }

    public static function disabledInput($checked, $disabled)
    {
        if($disabled and $checked) return false;
        return $disabled;
    }

    public static function getRequestParamsFromFile()
    {
        if($contentJson = file_get_contents(PortfolioFilter::PARAMS_FILE_NAME)) {
            if($params = json_decode($contentJson, true)) {
                return $params;
            }
        }
        return false;
    }

    public static function setRequestParamsToFile($requestParams)
    {
        if(array_key_exists('filter_search', $requestParams)) return false;
        if($requestParams) {
            file_put_contents(PortfolioFilter::PARAMS_FILE_NAME, json_encode($requestParams));
        }
        else {
            file_put_contents(FilterItems::PARAMS_FILE_NAME, '');
        }
    }


}
