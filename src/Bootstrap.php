<?php

namespace ispomazkin\opel;

use Yii;
use yii\base\BootstrapInterface;





class Bootstrap implements BootstrapInterface{

    //Метод, который вызывается автоматически при каждом запросе
    public function bootstrap($app)
    {
        $routes = require 'Routes.php';
        //Правила маршрутизации
        $app->getUrlManager()->addRules($routes, false);

        //для совместимости с проектом zp24.shop
        $app->params['relative'] = false;

    }
}