<?php

    namespace Joomla\Plugin\System\Ytimmoscout\Type;
    use Joomla\CMS\Factory;
    use Joomla\CMS\Router\Route;
    use Joomla\Plugin\System\Ytimmoscout\RealestatesTypeProvider;
    use VmmimmoscoutNamespace\Component\Vmmimmoscout\Site\Helper\RouteHelper;

    /**
     * @package    plg_system_studiogongdataset
     *
     * @author     Kicktemp GmbH <hello@kicktemp.com>
     * @copyright  Copyright © 2020 Kicktemp GmbH. All rights reserved.
     * @license    GNU General Public License version 2 or later; see LICENSE.txt
     * @link       https://kicktemp.com
     */
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
                        'metadata'   => [
                            'label' => 'Realestates (List)',
                            'view'  => ['com_vmmimmoscout.realestates'],
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
            $realestates = $realestatesModel->getItems();

            $realestatesRemapped = [];

            $menu   = Factory::getApplication()->getMenu()->getActive();

            foreach ($realestates as $realestate) {

                $Itemid = $menu->id;
                $route = RouteHelper::getRealestateRoute($realestate->{'@id'});
                $url    = Route::_('index.php?option=com_vmmimmoscout&view=realestate&realestateID=' . (int) $realestate->{'@id'}. '&Itemid=' . $Itemid);

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
                    'titlePictureUrl' => $realestate->titlePicture->urls[0]->url[0]->{'@href'},
                ];
            }

            return $realestatesRemapped;


        }

    }
