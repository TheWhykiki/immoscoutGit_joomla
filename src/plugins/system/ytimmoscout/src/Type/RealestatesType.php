<?php

/**
 * @package      DigiNerds Immoscout24 Komponente
 *
 * @author       Christian Schuelling <info@diginerds.de>
 * @copyright    2024 diginerds.de - All rights reserved.
 * @license      GNU General Public License version 3 or later
 */


namespace Joomla\Plugin\System\Ytimmoscout\Type;

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
                        'value'   => '', // dynamischer Wert
                    ],
                ],
                'title' => [
                    'type'     => 'String',
                    'metadata' => [
                        'label'   => 'Titel',
                        'filters' => ['limit'],
                        'value'   => '', // dynamischer Wert
                    ],
                ],
                'type' => [
                    'type'     => 'String',
                    'metadata' => [
                        'label'   => 'Typ',
                        'filters' => ['limit'],
                        'value'   => '', // dynamischer Wert
                    ],
                ],
                'externalId' => [
                    'type'     => 'String',
                    'metadata' => [
                        'label'   => 'Externe ID',
                        'filters' => ['limit'],
                        'value'   => '', // dynamischer Wert
                    ],
                ],
                'creationDate' => [
                    'type'     => 'String',
                    'metadata' => [
                        'label'   => 'Erstellungsdatum',
                        'filters' => ['limit'],
                        'value'   => '', // dynamischer Wert
                    ],
                ],
                'modifiedDate' => [
                    'type'     => 'String',
                    'metadata' => [
                        'label'   => 'Änderungsdatum',
                        'filters' => ['limit'],
                        'value'   => '', // dynamischer Wert
                    ],
                ],
                'realestateRoute' => [
                    'type'     => 'String',
                    'metadata' => [
                        'label'   => 'Link Route',
                        'filters' => ['limit'],
                        'value'   => '', // dynamischer Wert
                    ],
                ],
                'realestateUrl' => [
                    'type'     => 'String',
                    'metadata' => [
                        'label'   => 'Link SEO',
                        'filters' => ['limit'],
                        'value'   => '', // dynamischer Wert
                    ],
                ],
                'street' => [
                    'type'     => 'String',
                    'metadata' => [
                        'label'   => 'Straße',
                        'filters' => ['limit'],
                        'value'   => '', // dynamischer Wert
                    ],
                ],
                'houseNumber' => [
                    'type'     => 'String',
                    'metadata' => [
                        'label'   => 'Hausnummer',
                        'filters' => ['limit'],
                        'value'   => '', // dynamischer Wert
                    ],
                ],
                'zipCode' => [
                    'type'     => 'String',
                    'metadata' => [
                        'label'   => 'Postleitzahl',
                        'filters' => ['limit'],
                        'value'   => '', // dynamischer Wert
                    ],
                ],
                'city' => [
                    'type'     => 'String',
                    'metadata' => [
                        'label'   => 'Stadt',
                        'filters' => ['limit'],
                        'value'   => '', // dynamischer Wert
                    ],
                ],
                'livingSpace' => [
                    'type'     => 'String',
                    'metadata' => [
                        'label'   => 'Wohnfläche',
                        'filters' => ['limit'],
                        'value'   => '', // dynamischer Wert
                    ],
                ],
                'numberOfRooms' => [
                    'type'     => 'String',
                    'metadata' => [
                        'label'   => 'Anzahl der Zimmer',
                        'filters' => ['limit'],
                        'value'   => '', // dynamischer Wert
                    ],
                ],
                'price' => [
                    'type'     => 'String',
                    'metadata' => [
                        'label'   => 'Preis',
                        'filters' => ['limit'],
                        'value'   => '', // dynamischer Wert
                    ],
                ],
                'currency' => [
                    'type'     => 'String',
                    'metadata' => [
                        'label'   => 'Währung',
                        'filters' => ['limit'],
                        'value'   => '', // dynamischer Wert
                    ],
                ],
                'realestateState' => [
                    'type'     => 'String',
                    'metadata' => [
                        'label'   => 'Immobilienzustand',
                        'filters' => ['limit'],
                        'value'   => '', // dynamischer Wert
                    ],
                ],
                'titlePictureUrl' => [
                    'type'     => 'String',
                    'metadata' => [
                        'label'   => 'URL des Titelbildes',
                        'filters' => ['limit'],
                        'value'   => '', // dynamischer Wert
                    ],
                ],
            ],

            'metadata' => [
                'type'  => true,
                'label' => 'Realestate'
            ]
        ];

    }

}
