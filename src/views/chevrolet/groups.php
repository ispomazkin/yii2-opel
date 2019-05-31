<?php
/**
 * Created by PhpStorm.
 * User: pomazkinis
 * Date: 30.05.2019
 * Time: 16:37
 *
 * @var $this \yii\web\View
 * @var $data array
 *
 * Шаблон для вывода групп списком
 */

use yii\helpers\Html;
use yii\helpers\Url;
use ispomazkin\chevrolet\OpelAssetBundle;

OpelAssetBundle::register($this);
?>
<?=Html::tag('h1',$data['model'].' '.$data['year'])?>
<?=Html::tag('h2',$data['category'])?>
<table class="table table-bordered table-responsive">
    <tr>
        <th>Группа запчастей</th>
    </tr>
    <?php foreach($data['groups'] as $group):?>
        <tr>
            <td><?=Html::a($group['description'],Url::to(['chevrolet/sub-groups','group_url'=>$group['url'],
                    'category_url'=>$data['category_url'],
                    'year_url'=>$data['model_url']
                ]))?></td>
        </tr>
    <?php endforeach;?>
</table>