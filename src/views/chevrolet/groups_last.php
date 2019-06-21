<?php
/**
 * Created by PhpStorm.
 * User: pomazkinis
 * Date: 31.05.2019
 * Time: 7:31
 *
 *
 * @var $this \yii\web\View
 * @var $data array
 * @var $img_path string
 */

use yii\helpers\Html;
use yii\helpers\Url;
use ispomazkin\opel\OpelAssetBundle;

OpelAssetBundle::register($this);
$collection = isset($data['subgroups']) ? $data['subgroups'] :  $data['groups'];

$context = $this->context;
/* @var $context \ispomazkin\opel\controllers\OpelController*/
?>
<?=Html::tag('h1',$data['model'])?>
<?=Html::tag('h2',$data['category'])?>
<?=Html::tag('h3',$data['group'])?>


<div class="container">
    <?php foreach($collection as $item):?>
        <div class="col-sm-6 col-md-4 col-lg-3 chevrolet_item">
            <a class="thumbnail" href="<?=Url::to(['opel/parts','model_url'=>$data['model_url'],'last_url'=>$item['url']])?>">
                <img src="<?=$img_path .'/'. $item['image']?>" height="350px" class="rounded thumbnail mx-auto d-block" title="<?=$item['description']?>" alt="<?=$data['group']?>">
                <p title="<?=$item['description']?>"><?=$item['description']?></p>
            </a>
        </div>
    <?php endforeach;?>
</div>
