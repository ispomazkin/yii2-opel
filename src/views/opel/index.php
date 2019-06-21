<?php
/**
 * Created by PhpStorm.
 * User: pomazkinis
 * Date: 30.05.2019
 * Time: 13:16
 *
 * @var $this \yii\web\View
 * @var $data array
 */

use ispomazkin\opel\OpelAssetBundle;
use yii\helpers\Html;
use yii\helpers\Url;


OpelAssetBundle::register($this);
?>
<?=Html::tag('h1',$this->title)?>
<table class="table table-bordered table-responsive">
    <tr>
        <th>Модель</th>
    </tr>
    <?php foreach($data as $row):?>
        <tr>
            <td><?=Html::a($row['model'],Url::to([
                    'opel/categories',
                    'model_url'=>$row['url']
                ]),[
                    'title'=>$row['model']
                ])?></td>
        </tr>
    <?php endforeach;?>
</table>
