<?php
/**
 * Created by PhpStorm.
 * User: pomazkinis
 * Date: 30.05.2019
 * Time: 12:40
 */


namespace ispomazkin\opel\controllers;

use Yii;
use yii\httpclient\CurlTransport;
use yii\web\Controller;
use yii\httpclient\Client;
use ispomazkin\opel\Module;
use yii\helpers\Json;
use yii\web\NotFoundHttpException;
use yii\helpers\Url;

use app\components\Helper;

class OpelController extends Controller
{
    /**
     * int
     * Макс Кол-во секунд для ответа сервера
     */
    const TIMEOUT=1;

    /**
     * Макс Кол-во секунд для соединения с сервером
     */
    const CONNECTTIMEOUT=1;

    /**
     * @var null | string
     */
    protected $api_host=null;

    /**
     * @var null | string
     */
    protected $api_image_path=null;

    /**
     * @var null | string
     */
    protected $search_pattern=null;


    /**
     * @var array
     * Паттерн для вывода различного типа title на страницах
     * Доступны шаблоны
     * {model},{category},{group},{subgroup},{last}
     */
    public $titlePattern;

    /**
     * @var array
     * Паттерн для вывода различного типа keywords на страницах
     * Доступны шаблоны
     * {model},{category},{group},{subgroup},{last}
     */
    protected $kwdsPattern;


    /**
     * @var array
     * Паттерн для вывода различного типа description на страницах
     * Доступны шаблоны
     * {model},{category},{group},{subgroup},{last}
     */
    protected $descriptionPattern;



    /**
     * @param $action
     * @return bool
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action)
    {
        $module = Yii::$app->getModule('opel');
        /* @var $module Module*/
        if (!$module)
            throw new \Exception('The module Opel was not configured in your app config file');

        if (!($this->api_host = $module->host))
            throw new \Exception('The property Host of Opel module was not configured in your app config file');

        if (!($this->api_image_path = $module->image_path))
            throw new \Exception('The property Image_path of Opel module was not configured in your app config file');

        if (!($this->search_pattern = $module->search_pattern))
            throw new \Exception('The property search_pattern of Opel module was not configured in your app config file');

        //settings for my project
        Yii::$app->params['main_page'] = false;
        /***/
        $this->descriptionPattern = $module->descriptionPattern;

        $this->kwdsPattern = $module->kwdsPattern;

        $this->titlePattern = $module->titlePattern;

        Yii::setAlias('@opel_views', Yii::getAlias('@ispomazkin/opel/views/opel'))	;

        return parent::beforeAction($action); // TODO: Change the autogenerated stub
    }

    /**
     * Отображение списка моделей по Годам
     */
    public function actionIndex()
    {
        $url = $this->api_host.'/opel/get-models';

        $data = Json::decode($this->sendRequest($url));

        $this->createSeo('models',$data);

        return $this->render('@opel_views/index',[
            'data'=>$data,
        ]);
    }

    /**
     * @param $type years|categories|groups|subgroups|parts
     * @param $data array
     */
    protected function createSeo($type,$data)
    {

        $pattern = [
            '{model}'=>isset($data['model']) ? $data['model'] : '',
            '{category}'=>isset($data['category']) ? $data['category'] : '',
            '{group}'=>isset($data['group']) ? $data['group'] : '',
            '{subgroup}'=>isset($data['subgroup']) ? $data['subgroup'] : '',
            '{parts}'=>isset($data['subgroup'])  && $data['subgroup'] ? $data['subgroup'] : $data['group'],
        ];


        foreach($this->titlePattern as $key=>&$value)
            $value = str_replace(array_keys($pattern),$pattern,$value);

        foreach($this->kwdsPattern as $key=>&$value)
            $value = str_replace(array_keys($pattern),$pattern,$value);

        foreach($this->descriptionPattern as $key=>&$value)
            $value = str_replace(array_keys($pattern),$pattern,$value);

        $this->view->title = $this->titlePattern[$type];
        $this->view->registerMetaTag([
            'name' => 'description',
            'content' => $this->descriptionPattern[$type]
        ]);

        $this->view->registerMetaTag([
            'name' => 'keywords',
            'content' => $this->kwdsPattern[$type]
        ]);


        switch($type)
        {
            case 'models':
                break;

            case 'categories':
                $this->view->params['breadcrumbs'][] =  ['label'=>$this->titlePattern['models'],'url'=>Url::to(['opel/index'])];
                break;

            case 'groups':
                $this->view->params['breadcrumbs'][] =  ['label'=>$this->titlePattern['models'],'url'=>Url::to(['opel/index'])];
                $this->view->params['breadcrumbs'][] =  ['label'=>$this->titlePattern['categories'],'url'=>Url::to(['opel/categories',
                    'model_url'=>$data['model_url'],
                ])];
                break;

            case 'sub-groups':
                $this->view->params['breadcrumbs'][] =  ['label'=>$this->titlePattern['models'],'url'=>Url::to(['opel/index'])];
                $this->view->params['breadcrumbs'][] =  ['label'=>$this->titlePattern['categories'],'url'=>Url::to(['opel/categories',
                    'model_url'=>$data['model_url'],
                ])];
                $this->view->params['breadcrumbs'][] = [
                    'label'=>$this->titlePattern['groups'],
                    'url' => Url::to(['opel/groups','model_url'=>$data['model_url'],'category_url'=>$data['category_url'],
                    ])
                ];
                break;

            case 'parts' :
                $this->view->params['breadcrumbs'][] =  ['label'=>$this->titlePattern['models'],'url'=>Url::to(['opel/index'])];
                $this->view->params['breadcrumbs'][] =  ['label'=>$this->titlePattern['categories'],'url'=>Url::to(['opel/categories',
                    'model_url'=>$data['model_url'],
                ])];
                $this->view->params['breadcrumbs'][] = [
                    'label'=>$this->titlePattern['groups'],
                    'url' => Url::to(['opel/groups','model_url'=>$data['model_url'],'category_url'=>$data['category_url'],
                    ])
                ];


                if (isset($data['subgroup'])  && $data['subgroup'])
                {

                    $this->view->params['breadcrumbs'][] = [
                        'label'=> $this->titlePattern['sub-groups'],
                        'url' => Url::to(['opel/sub-groups','model_url'=>$data['model_url'],'category_url'=>$data['category_url'],
                            'group_url'=>$data['group_url']
                        ])
                    ];

                }

        }
        $this->view->params['breadcrumbs'][] = $this->view->title;

    }

    /**
     * @param $year_url
     * @return string
     * @throws NotFoundHttpException
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function actionCategories($model_url)
    {
        $url = $this->api_host.'/opel/get-categories?model_url='.$model_url;
        $data = Json::decode($this->sendRequest($url));
        if ($data['status']!='ok')
            throw new NotFoundHttpException();

        $this->createSeo('categories',$data['body']);

        return $this->render('@opel_views/categories',[
            'data'=>$data['body'],
        ]);
    }


    public function actionGroups($model_url,$category_url)
    {
        $url = $this->api_host.'/opel/get-groups?model_url='.$model_url.'&category_url='.$category_url;

        $data = Json::decode($this->sendRequest($url));
        if ($data['status']!='ok')
            throw new NotFoundHttpException();

        $this->createSeo('groups',$data['body']);

        $template = $data['body']['groups'][0]['is_last'] ? '@opel_views/groups_last' : '@opel_views/groups';

        return $this->render($template,[
            'data'=>$data['body'],
            'img_path'=>$this->api_host . $this->api_image_path
        ]);
    }


    /**
     * @param $model_url
     * @param $category_url
     * @param $group_url
     */
    public function actionSubGroups($model_url,$category_url,$group_url)
    {
        $url = $this->api_host.'/opel/get-sub-groups?model_url='.$model_url.'&category_url='.$category_url.'&group_url='.$group_url;

        $data = Json::decode($this->sendRequest($url));
        if ($data['status']!='ok')
            throw new NotFoundHttpException();

        $this->createSeo('sub-groups',$data['body']);

        return $this->render('@opel_views/groups_last',[
            'data'=>$data['body'],
            'img_path'=>$this->api_host . $this->api_image_path
        ]);
    }


    /**
     * @param $model_url
     * @param $last_url
     */
    public function actionParts($model_url,$last_url)
    {
        $url = $this->api_host.'/opel/get-parts?model_url='.$model_url.'&last_url='.$last_url;

        $data = Json::decode($this->sendRequest($url));

        if ($data['status']!='ok')
            throw new NotFoundHttpException();

        $this->createSeo('parts',$data['body']);

        return $this->render('@opel_views/parts',[
            'data'=>$data['body'],
            'img_path'=>$this->api_host . $this->api_image_path,
            'search_pattern'=>$this->search_pattern
        ]);

    }



    /**
     * @param $url
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\httpclient\Exception
     * @return string
     *
     */
    protected function sendRequest($url)
    {
        $client = new Client([
            'transport' => CurlTransport::class
        ]);

        $result = $client->createRequest()
            ->setUrl($url)
            ->setOptions(['timeout'=>self::TIMEOUT,'connecttimeout'=>self::CONNECTTIMEOUT])
            ->send();

        return $result->content;
    }

}
