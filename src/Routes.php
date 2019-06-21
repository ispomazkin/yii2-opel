<?php
/**
 * Created by PhpStorm.
 * User: pomazkinis
 * Date: 30.05.2019
 * Time: 12:41
 *
 * @var $module \ispomazkin\opel\Module
 */
return [
    //====== Groups ==========================
    $module->base_url  . '/parts/<model_url:[0-9-_\w]+>/<last_url:[0-9-_\w]+>' => 'opel/opel/parts',
    $module->base_url  . '/<model_url:[0-9-_\w]+>/<category_url:[0-9-_\w]+>/<group_url:[0-9-_\w]+>' => 'opel/opel/sub-groups',
    $module->base_url  . '/<model_url:[0-9-_\w]+>/<category_url:[0-9-_\w]+>' => 'opel/opel/groups',
    //====== Categories ==========================
    $module->base_url  . '/<model_url:[0-9-_\w]+>' => 'opel/opel/categories',
    $module->base_url  => 'opel/opel/index',
];