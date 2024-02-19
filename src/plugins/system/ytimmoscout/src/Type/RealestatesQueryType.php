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
use Joomla\Plugin\System\Ytimmoscout\RealestatesTypeProvider;
use VmmimmoscoutNamespace\Component\Vmmimmoscout\Site\Helper\RouteHelper;

class RealestatesQueryType
{
    public static function config()
    {
        return [

            'fields' => [

                'realestates' => [
                    'type' => [
                        'listOf' => 'Realestates',
                    ],
                    'metadata' => [
                        'label' => 'Realestates (List)',
                        'view' => ['com_vmmimmoscout.realestates'],
                        'group' => 'Realestates',
                    ],
                    'extensions' => [
                        'call' => __CLASS__ . '::realestates',
                    ],
                ],

            ]

        ];
    }

    public static function realestates($root)
    {
        $app = Factory::getApplication();

        // Get the FieldsModelField, we need it in a sec
        $mvcFactory = $app->bootComponent('com_vmmimmoscout')->getMVCFactory();
        /** @var \VmmimmoscoutNamespace\Component\Vmmimmoscout\Site\Model\RealestatesModel $realestatesModel */
        $realestatesModel = $mvcFactory->createModel('Realestates', 'Site', ['ignore_request' => true]);
        $realestates = $realestatesModel->getItems(true);

        $realestatesRemapped = [];

        $menu = Factory::getApplication()->getMenu()->getActive();

        foreach ($realestates as $realestate) {

            $Itemid = $menu->id;
            $route = RouteHelper::getRealestateRoute($realestate->{'@id'});
            $url = Route::_('index.php?option=com_vmmimmoscout&view=realestate&realestateID=' . (int)$realestate->{'@id'} . '&Itemid=' . $Itemid);

            $realestatesRemapped[] = [
                'id' => $realestate->{'@id'},
                'title' => $realestate->title,
                'type' => $realestate->{'@xsi.type'},
                'externalId' => $realestate->externalId,
                'creationDate' => $realestate->{'@creation'},
                'modifiedDate' => $realestate->{'@modification'},
                'realestateRoute' => $route,
                'realestateUrl' => $url,
                'street' => $realestate->address->street,
                'houseNumber' => $realestate->address->houseNumber,
                'zipCode' => $realestate->address->postcode,
                'city' => $realestate->address->city,
                'livingSpace' => $realestate->livingSpace,
                'numberOfRooms' => $realestate->numberOfRooms,
                'price' => $realestate->price->value,
                'currency' => $realestate->price->currency,
                'realestateState' => $realestate->realEstateState,
                'titlePicture' => $realestate->titlePicture,
                'titlePictureUrl' => strstr($realestate->titlePicture->urls[0]->url[0]->{'@href'}, '/ORIG', true),
            ];
        }

        return $realestatesRemapped;


    }

}
