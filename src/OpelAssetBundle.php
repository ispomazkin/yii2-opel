<?php
/**
 * Created by PhpStorm.
 * User: pomazkinis
 * Date: 30.05.2019
 * Time: 13:17
 */

namespace ispomazkin\opel;

use yii\web\AssetBundle;

class OpelAssetBundle extends AssetBundle
{

    public $sourcePath = '@vendor/ispomazkin/yii2-opel/assets';

    public $css = [
        'css/style.css'
    ];
}