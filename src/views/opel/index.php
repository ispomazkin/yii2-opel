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

//even && odd
foreach($data as $key=>$row)
{
    if ($key%2 === 0)
        $even[]=$row;
    else $odd[] = $row;
}

OpelAssetBundle::register($this);
?>
<?=Html::tag('h1',$this->title)?>
<table class="table table-bordered table-responsive">
    <tr>
        <th colspan="2">Модель</th>
    </tr>
    <?php foreach($even as $key=>$row):?>
        <tr>
            <td><?=Html::a($row['model'],Url::to([
                    'opel/categories',
                    'model_url'=>$row['url']
                ]),[
                    'title'=>$row['model']
                ])?>
            </td>
            <td><?=Html::a($odd[$key]['model'],Url::to([
                    'opel/categories',
                    'model_url'=>$odd[$key]['url']
                ]),[
                    'title'=>$odd[$key]['model']
                ])?>
            </td>
        </tr>
    <?php endforeach;?>
</table>
