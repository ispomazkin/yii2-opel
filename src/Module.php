<?php

namespace ispomazkin\opel;

use yii\base\Module as BaseModule;



class Module extends BaseModule
{
    /**
     * @var string
     * Хост для обращениий к АПИ и Картинкам
     */
    public $host;

    /**
     * @var string
     * Адрес папки с картинками на хосте
     */
    public $image_path;

    /**
     * @var string
     * поисковый шаблон
     */
    public $search_pattern;

    /**
     * @var string
     * Базовый путь к каталогу
     */
    public $base_url='/katalogi/opel';


    /**
     * @var array
     * Паттерн для вывода различного типа title на страницах
     * Доступны шаблоны
     * {model},{category},{group},{subgroup},{last}
     */
    public $titlePattern=[
        'models'=>'Запчасти Опель',
        'categories'=>'Запчасти Opel {model}',
        'groups'=>'{category}',
        'sub-groups'=>'{group}',
        'parts'=>'{parts}'
    ];

    /**
     * @var array
     * Паттерн для вывода различного типа keywords на страницах
     * Доступны шаблоны
     * {model},{category},{group},{subgroup},{last}
     */
    public $kwdsPattern=[
        'models'=>'EPC Opel',
        'categories'=>'Opel {model}',
        'groups'=>'{model}',
        'sub-groups'=>'{group}',
        'parts'=>'{parts}'

    ];


    /**
     * @var array
     * Паттерн для вывода различного типа description на страницах
     * Доступны шаблоны
     * {model},{category},{group},{subgroup},{last}
     */
    public $descriptionPattern=[
        'models'=>'Каталог запчастей Опель',
        'categories'=>'Каталог запчастей Опель {model}',
        'groups'=>'Каталог запчастей Опель {model}  по категории {category}',
        'sub-groups'=>'Каталог запчастей Опель {model} {category} Группа {group}',
        'parts'=>'Каталог запчастей Опель {model} {category} {group} {parts}'

    ];




    public $controllerNamespace = 'ispomazkin\opel\controllers';

}
