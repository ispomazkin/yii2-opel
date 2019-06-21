yii2-opel
=================



Установка
------------------
* Установка пакета с помощью Composer
```
composer require ispomazkin/yii2-opel
```


В конфигурации добавить параметры

    'modules' => [
        'opel'=>[
            'class'=>'\ispomazkin\opel\Module',
            'host'=>'http://149.154.64.192',
            'image_path'=>'/img/img_opel/img',
            'search_pattern'=>'http://site.com/search/?article={article}&brand=opel'
        ],
    ],

Строка поиска может быть любая, вместо паттерна {article}
будет подставляться артикул

Чтобы задать собственные шаблон генерации title, keywords, description,
используются предустановленные шаблоны переменные {model},{group},{subgroup},{parts} 

        'chevrolet'=>[
            'class'=>'\ispomazkin\opel\Module',
            'host'=>'http://149.154.64.192',
            'image_path'=>'/img/img_opel/img',
            'search_pattern'=>'http://site.com/search/?article={article}&brand=opel',
            'base_url'=>'/chevrolet'
            'titlePattern=>[
                  'years'=>'Запчасти Опель',
                  'categories'=>'{model}',
                  'groups'=>'{category}',
                  'sub-groups'=>'{group}',
                  'parts'=>'{parts}'
            ],
            'descriptionPattern'=>[
                    'years'=>'Каталог запчастей Опель',
                    'categories'=>'Каталог запчастей Опель {model}',
                    'groups'=>'Каталог запчастей Опель {model} по категории {category}',
                    'sub-groups'=>'Каталог запчастей Опель {model} {category} Группа {group}',
                    'parts'=>'Каталог запчастей Опель {model} {category} {group} {parts}'
            ],
            'keywordsPattern'=>[
                    'years'=>'EPC Opel',
                    'categories'=>'{model}',
                    'groups'=>'{model} {group}',
                    'sub-groups'=>'{subgroup}',
                    'parts'=>'{parts}'
            ],
        ],
        

