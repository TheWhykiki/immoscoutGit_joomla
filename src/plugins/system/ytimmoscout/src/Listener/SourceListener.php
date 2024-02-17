<?php

namespace Joomla\Plugin\System\Ytimmoscout\Listener;

use Joomla\CMS\Table\ContentType;

use Joomla\Plugin\System\Ytimmoscout\Type\RealestatesQueryType;
use Joomla\Plugin\System\Ytimmoscout\Type\RealestatesType;
use YOOtheme\Builder\Source;
use YOOtheme\Config;
use YOOtheme\Metadata;
use YOOtheme\Url;

class SourceListener
{



    public function initCustomizer( $config)
    {
        $config->merge([
            'templates' => [
                'com_vmmimmoscout.realestate' => [
                    'label' => 'Realestate Single',
                    'fieldset' => [
                        'default' => [
                            'fields' => [

                            ],
                        ],
                    ],
                ],

                'com_vmmimmoscout.realestates' => [
                    'label' => 'Realestate List',
                    'fieldset' => [
                        'default' => [
                            'fields' => [

                            ],
                        ],
                    ],

                ],
            ],

        ]);

        //$metadata->set('script:customizer.realestate', ['src' => Url::to('plugins/system/ytimmoscout/realestate.js'), 'defer' => true]);
    }
}
