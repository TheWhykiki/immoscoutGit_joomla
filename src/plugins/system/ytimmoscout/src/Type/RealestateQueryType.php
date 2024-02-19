<?php
/**
* @package      DigiNerds VMMImmoscout24 Package
*
* @author       Christian Schuelling <info@diginerds.de>
* @copyright    2024 diginerds.de - All rights reserved.
* @license      GNU General Public License version 3 or later
*/


namespace Joomla\Plugin\System\Ytimmoscout\Type;

use Joomla\CMS\Factory;
use Joomla\CMS\Router\Route;
use Joomla\Plugin\System\Ytimmoscout\Helper\FieldsHelper;
use VmmimmoscoutNamespace\Component\Vmmimmoscout\Site\Helper\RouteHelper;


class RealestateQueryType
{
    public static function config()
    {
        return [

            'fields' => [

                'realestate' => [
                    'type' => 'Realestate',
                    'metadata' => [
                        'label' => 'Realestate (Single)',
                        'view' => ['com_vmmimmoscout.realestate'],
                        'group' => 'Realestates',
                    ],
                    'extensions' => [
                        'call' => __CLASS__ . '::realestate',
                    ],
                ],

            ]

        ];
    }

    public static function realestate($root)
    {
        $app = Factory::getApplication();
        $input = $app->input;
        $id = $input->getInt('realestateID');

        // Get the FieldsModelField, we need it in a sec
        $mvcFactory = $app->bootComponent('com_vmmimmoscout')->getMVCFactory();
        /** @var \VmmimmoscoutNamespace\Component\Vmmimmoscout\Site\Model\RealestatesModel $realestatesModel */
        $realestatesModel = $mvcFactory->createModel('Realestate', 'Site', ['ignore_request' => true]);
        $realestate = $realestatesModel->getItem($id);

        $realestateRemapped = FieldsHelper::setFieldMappings($realestate);

        return $realestateRemapped;

    }

}
