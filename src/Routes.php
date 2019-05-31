<?php
/**
 * Created by PhpStorm.
 * User: pomazkinis
 * Date: 30.05.2019
 * Time: 12:41
 */

return [
    //====== Groups ==========================
    'chevrolet/parts/<year_url:[0-9-_\w]+>/<last_url:[0-9-_\w]+>' => 'chevrolet/chevrolet/parts',
    'chevrolet/<year_url:[0-9-_\w]+>/<category_url:[0-9-_\w]+>/<group_url:[0-9-_\w]+>' => 'chevrolet/chevrolet/sub-groups',
    'chevrolet/<year_url:[0-9-_\w]+>/<category_url:[0-9-_\w]+>' => 'chevrolet/chevrolet/groups',
    //====== Categories ==========================
    'chevrolet/<year_url:[0-9-_\w]+>' => 'chevrolet/chevrolet/categories',
    'chevrolet' => 'chevrolet/chevrolet/index',
];