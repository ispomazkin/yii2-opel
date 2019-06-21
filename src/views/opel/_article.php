<?php
/**
 * Created by PhpStorm.
 * User: pomazkinis
 * Date: 31.05.2019
 * Time: 9:19
 *
 * @var $article string
 * @var $search_pattern string
 * @var $this \yii\web\View
 */
use yii\helpers\Html;
?>
<a href="<?=str_replace('{article}',$article,$search_pattern)?>" target="_blank" title="<?=$article?>"><?=$article?></a>

