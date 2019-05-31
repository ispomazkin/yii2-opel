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

use ispomazkin\chevrolet\OpelAssetBundle;
use yii\helpers\Html;
use yii\helpers\Url;


OpelAssetBundle::register($this);
?>
<?=Html::tag('h1','Каталог запчастей Шевроле Европа')?>
<table class="table table-bordered table-responsive">
    <tr>
        <th>Модель</th>
        <th>Год выпуска</th>
    </tr>
    <?php foreach($data as $row):?>
        <tr>
            <td><?=$row['model']?></td>
            <td><?=$this->render('years',['years'=>$row['years']])?></td>
        </tr>
    <?php endforeach;?>
</table>
