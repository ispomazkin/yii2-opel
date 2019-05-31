yii2-chevrolet
=================



Установка
------------------
* Установка пакета с помощью Composer
```
composer require ispomazkin/yii2-opel
```


В конфигурации добавить параметры
    'modules' => [
        ......
        'opel'=>[
            'class'=>'\ispomazkin\chevrolet\Module',
            'host'=>'http://149.154.64.192',
            'image_path'=>'/img/img_opel',
            'search_pattern'=>'http://site.com/search/?article={article}&brand=opel'
        ],
        ........
    ],

Строка поиска может быть любая, вместо паттерна {article}
будет подставляться артикул

