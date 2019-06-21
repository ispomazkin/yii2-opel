<?php

namespace ispomazkin\opel;

use Yii;
use yii\base\BootstrapInterface;
use app\components\Helper;





class Bootstrap implements BootstrapInterface{

    //Метод, который вызывается автоматически при каждом запросе
    public function bootstrap($app)
    {
        $module = $app->getModule('opel');
        /* @var $module \ispomazkin\opel\Module */

        $routes = require 'Routes.php';
        //Правила маршрутизации
        $app->getUrlManager()->addRules($routes);

    }
}