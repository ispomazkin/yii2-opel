<?php
/**
 * Created by PhpStorm.
 * User: pomazkinis
 * Date: 31.05.2019
 * Time: 9:19
 *
 * @var $codes array
 * @var $text string
 * @var $this \yii\web\View
 */
use yii\helpers\Html;
?>
<?php if(!empty($codes)):?>
    <?
        foreach($codes as $code)
        {
            if (preg_match('/'.$code['code'].'/si',$text))
                {
                    $code['description'] = trim(preg_replace('/\s+/',' ',$code['description']),',');
                    $text = str_replace($code['code'], Html::tag('span',$code['code'],['title'=>$code['description'],'class'=>'procode']),$text);
                }
        }
    ?>
<?php endif;?>
<?=$text?>

