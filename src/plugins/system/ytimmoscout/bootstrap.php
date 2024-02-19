<?php
/**
* @package      DigiNerds VMMImmoscout24 Package
*
* @author       Christian Schuelling <info@diginerds.de>
* @copyright    2024 diginerds.de - All rights reserved.
* @license      GNU General Public License version 3 or later
*/



use YOOtheme\Builder;
use YOOtheme\Builder\BuilderConfig;
use Joomla\Plugin\System\Ytimmoscout\Listener\SourceListener;
use Joomla\Plugin\System\Ytimmoscout\Listener\TemplateListener;
use Joomla\Plugin\System\Ytimmoscout\Listener\LoadSourceTypes;
use Joomla\Plugin\System\Ytimmoscout\Listener\LoadTemplate;
use YOOtheme\Path;


return [

    'events' => [

        'source.init'      => [LoadSourceTypes::class => '@handle'],
        'builder.template' => [TemplateListener::class => '@matchTemplate'],

        BuilderConfig::class => [SourceListener::class => '@initCustomizer'],

    ],

    'extend' => [

        Builder::class => function (Builder $builder) {
            $builder->addTypePath(Path::get('./element/*/element.json'));

        }

    ]

];
