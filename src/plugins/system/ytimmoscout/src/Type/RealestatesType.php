<?php

//
namespace Joomla\Plugin\System\Ytimmoscout\Type;

use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Factory;

use Joomla\CMS\Router\Route;
use Joomla\Component\Categories\Administrator\Model\CategoryModel;
use Joomla\Component\Fields\Administrator\Model\FieldModel;
use Joomla\String\StringHelper;
use VmmdatabaseNamespace\Component\Vmmdatabase\Site\Model\DatasetModel;


class RealestatesType
{

    public function setFields($fieldname, $fieldtype, $label, $tab)
    {
        $array = [
            $fieldname => [
                'type'       => $fieldtype,
                'metadata'   => [
                    'label' => $label,
                    'group' => $tab
                ],
                'extensions' => [
                    'call' => [
                        'func' => __CLASS__ . '::resolve',
                        'args' => [
                            'fieldname' => $fieldname,
                        ]
                    ]

                ]

            ],
        ];

        return $array;
    }


    public static function config()
    {

        return [
            'fields' => [
                'id' => [
                    'type'     => 'String',
                    'metadata' => [
                        'label'   => 'ID',
                        'filters' => ['limit'],
                        'value'   => '', // Setze hier den dynamischen Wert
                    ],
                ],
                'title' => [
                    'type'     => 'String',
                    'metadata' => [
                        'label'   => 'Title',
                        'filters' => ['limit'],
                        'value'   => '', // Setze hier den dynamischen Wert
                    ],
                ],
                'type' => [
                    'type'     => 'String',
                    'metadata' => [
                        'label'   => 'Type',
                        'filters' => ['limit'],
                        'value'   => '', // Setze hier den dynamischen Wert
                    ],
                ],
                'externalId' => [
                    'type'     => 'String',
                    'metadata' => [
                        'label'   => 'External ID',
                        'filters' => ['limit'],
                        'value'   => '', // Setze hier den dynamischen Wert
                    ],
                ],
                'creationDate' => [
                    'type'     => 'String',
                    'metadata' => [
                        'label'   => 'Creation Date',
                        'filters' => ['limit'],
                        'value'   => '', // Setze hier den dynamischen Wert
                    ],
                ],
                'modifiedDate' => [
                    'type'     => 'String',
                    'metadata' => [
                        'label'   => 'Modified Date',
                        'filters' => ['limit'],
                        'value'   => '', // Setze hier den dynamischen Wert
                    ],
                ],
                'street' => [
                    'type'     => 'String',
                    'metadata' => [
                        'label'   => 'Street',
                        'filters' => ['limit'],
                        'value'   => '', // Setze hier den dynamischen Wert
                    ],
                ],
                'houseNumber' => [
                    'type'     => 'String',
                    'metadata' => [
                        'label'   => 'House Number',
                        'filters' => ['limit'],
                        'value'   => '', // Setze hier den dynamischen Wert
                    ],
                ],
                'zipCode' => [
                    'type'     => 'String',
                    'metadata' => [
                        'label'   => 'Zip Code',
                        'filters' => ['limit'],
                        'value'   => '', // Setze hier den dynamischen Wert
                    ],
                ],
                'city' => [
                    'type'     => 'String',
                    'metadata' => [
                        'label'   => 'City',
                        'filters' => ['limit'],
                        'value'   => '', // Setze hier den dynamischen Wert
                    ],
                ],
                'livingSpace' => [
                    'type'     => 'String',
                    'metadata' => [
                        'label'   => 'Living Space',
                        'filters' => ['limit'],
                        'value'   => '', // Setze hier den dynamischen Wert
                    ],
                ],
                'numberOfRooms' => [
                    'type'     => 'String',
                    'metadata' => [
                        'label'   => 'Number Of Rooms',
                        'filters' => ['limit'],
                        'value'   => '', // Setze hier den dynamischen Wert
                    ],
                ],
                'price' => [
                    'type'     => 'String',
                    'metadata' => [
                        'label'   => 'Price',
                        'filters' => ['limit'],
                        'value'   => '', // Setze hier den dynamischen Wert
                    ],
                ],
                'currency' => [
                    'type'     => 'String',
                    'metadata' => [
                        'label'   => 'Currency',
                        'filters' => ['limit'],
                        'value'   => '', // Setze hier den dynamischen Wert
                    ],
                ],
                'realestateState' => [
                    'type'     => 'String',
                    'metadata' => [
                        'label'   => 'Real Estate State',
                        'filters' => ['limit'],
                        'value'   => '', // Setze hier den dynamischen Wert
                    ],
                ],
                'titlePicture' => [
                    'type'     => 'String',
                    'metadata' => [
                        'label'   => 'Title Picture',
                        'filters' => ['limit'],
                        'value'   => '', // Setze hier den dynamischen Wert
                    ],
                ],
                'titlePictureUrl' => [
                    'type'     => 'String',
                    'metadata' => [
                        'label'   => 'Title Picture URL',
                        'filters' => ['limit'],
                        'value'   => '', // Setze hier den dynamischen Wert
                    ],
                ],
                // Füge hier weitere Felder hinzu, wie benötigt
            ],

            'metadata' => [
                'type'  => true,
                'label' => 'Realestate'
            ]
        ];

    }

}
