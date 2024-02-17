<?php
/**
 * @package    plg_system_studiogongdataset
 *
 * @author     Kicktemp GmbH <hello@kicktemp.com>
 * @copyright  Copyright © 2020 Kicktemp GmbH. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @link       https://kicktemp.com
 */


use YOOtheme\Builder\BuilderConfig;
use Joomla\Plugin\System\Ytimmoscout\Listener\SourceListener;
use Joomla\Plugin\System\Ytimmoscout\Listener\TemplateListener;
use Joomla\Plugin\System\Ytimmoscout\Listener\LoadSourceTypes;




return [

    'events' => [

        'source.init' => [LoadSourceTypes::class => '@handle'],
        'builder.template' => [TemplateListener::class => '@matchTemplate'],

        BuilderConfig::class => [SourceListener::class => '@initCustomizer'],

    ]

];
