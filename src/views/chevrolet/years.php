<?php
/**
 * Created by PhpStorm.
 * User: pomazkinis
 * Date: 30.05.2019
 * Time: 15:28
 *
 * @var $this \yii\web\View
 * @var $years array
 *
 */
use yii\helpers\Html;
use yii\helpers\Url;
use ispomazkin\chevrolet\OpelAssetBundle;
OpelAssetBundle::register($this);

?>



<?php foreach($years as $year):?>
    <?=Html::tag('span',Html::a($year['year'], Url::to(['chevrolet/categories','year_url'=>$year['url']])))?>&nbsp;
<?php endforeach;?>
