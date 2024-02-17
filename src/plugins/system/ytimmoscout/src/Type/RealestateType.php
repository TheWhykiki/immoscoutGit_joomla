<?php

//
namespace Joomla\Plugin\System\Ytimmoscout\Type;

use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Factory;

use Joomla\CMS\Router\Route;
use Joomla\Component\Categories\Administrator\Model\CategoryModel;
use Joomla\Component\Fields\Administrator\Model\FieldModel;
use \Joomla\Language\Text;
use Joomla\String\StringHelper;
use VmmdatabaseNamespace\Component\Vmmdatabase\Site\Model\DatasetModel;


class RealestateType
{

    public function setFields($fieldname, $fieldtype, $label, $tab)
    {
        $array = [
            $fieldname => [
                'type' => $fieldtype,
                'metadata' => [
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
                // Generic Fields
                'externalId' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'External ID',
                        'value' => '',
                    ],
                ],
                'title' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Title',
                        'value' => '',
                    ],
                ],
                'street' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Street',
                        'value' => '',
                    ],
                ],
                'houseNumber' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'House Number',
                        'value' => '',
                    ],
                ],
                'zipCode' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'PLZ',
                        'value' => '',
                    ],
                ],
                'city' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'City',
                        'value' => '',
                    ],
                ],
                'searchField1' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Search Field 1',
                        'value' => '',
                    ],
                ],
                'searchField2' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Search Field 2',
                        'value' => '',
                    ],
                ],
                'searchField3' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Search Field 3',
                        'value' => '',
                    ],
                ],
                'groupNumber' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Group Number',
                        'value' => '',
                    ],
                ],
                'descriptionNote' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Description Note',
                        'value' => '',
                    ],
                ],
                'locationNote' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Location Note',
                        'value' => '',
                    ],
                ],
                'otherNote' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Other Note',
                        'value' => '',
                    ],
                ],
                'contactId' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Contact ID',
                        'value' => '',
                    ],
                ],
                'condition' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Condition',
                        'value' => '',
                    ],
                ],
                'constructionYear' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Construction Year',
                        'value' => null,
                    ],
                ],
                'constructionYearUnknown' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Construction Year Unknown',
                        'value' => false,
                    ],
                ],
                'latitude' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Latitude',
                        'value' => null,
                    ],
                ],
                'longitude' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Longitude',
                        'value' => null,
                    ],
                ],
                'latlng' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Lat / Lng combined',
                        'value' => null,
                    ],
                ],
                'creationDate' => [
                    'type' => 'String', // or Date depending on how you want to handle dates
                    'metadata' => [
                        'label' => 'Creation Date',
                        'value' => '',
                    ],
                ],
                'lastModificationDate' => [
                    'type' => 'String', // or Date
                    'metadata' => [
                        'label' => 'Last Modification Date',
                        'value' => '',
                    ],
                ],

                // Apartment Fields

                'apartmentType' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Apartment Type',
                        'group' => 'Apartment Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'floor' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Floor',
                        'group' => 'Apartment Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'lift' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Lift',
                        'group' => 'Apartment Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'cellar' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Cellar',
                        'group' => 'Apartment Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'handicappedAccessible' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Handicapped Accessible',
                        'group' => 'Apartment Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'numberOfParkingSpaces' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Number of Parking Spaces',
                        'group' => 'Apartment Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'lastRefurbishment' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Last Refurbishment',
                        'group' => 'Apartment Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'interiorQuality' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Interior Quality',
                        'group' => 'Apartment Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'freeFrom' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Free From',
                        'group' => 'Apartment Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'heatingType' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Heating Type',
                        'group' => 'Apartment Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'firingType' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Firing Type',
                        'group' => 'Apartment Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'BuildingEnergyRatingType' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Building Energy Rating Type',
                        'group' => 'Apartment Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'thermalCharacteristic' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Thermal Characteristic',
                        'group' => 'Apartment Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'energyConsumptionContainsWarmWater' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Energy Consumption Contains Warm Water',
                        'group' => 'Apartment Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'numberOfFloors' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Number of Floors',
                        'group' => 'Apartment Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'usableFloorSpace' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Usable Floor Space',
                        'group' => 'Apartment Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'numberOfBedRooms' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Number of Bedrooms',
                        'group' => 'Apartment Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'numberOfBathRooms' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Number of Bathrooms',
                        'group' => 'Apartment Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'guestToilet' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Guest Toilet',
                        'group' => 'Apartment Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'parkingSpaceType' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Parking Space Type',
                        'group' => 'Apartment Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],

                // Rent Fields

                'baseRent' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Base Rent',
                        'group' => 'Rent Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'totalRent' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Total Rent',
                        'group' => 'Rent Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'serviceCharge' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Service Charge',
                        'group' => 'Rent Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'deposit' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Deposit',
                        'group' => 'Rent Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'heatingCosts' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Heating Costs',
                        'group' => 'Rent Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'heatingCostsInServiceCharge' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Heating Costs in Service Charge',
                        'group' => 'Rent Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'petsAllowed' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Pets Allowed',
                        'group' => 'Rent Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'parkingSpacePrice' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Parking Space Price',
                        'group' => 'Rent Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'livingSpace' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Living Space',
                        'group' => 'Rent Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'numberOfRooms' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Number of Rooms',
                        'group' => 'Rent Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'builtInKitchen' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Built-in Kitchen',
                        'group' => 'Rent Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'balcony' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Balcony',
                        'group' => 'Rent Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'garden' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Garden',
                        'group' => 'Rent Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'courtage' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Courtage',
                        'group' => 'Rent Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'courtageNote' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Courtage Note',
                        'group' => 'Rent Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],

                // Buy Fields

                'value' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Kaufpreis',
                        'group' => 'Buy Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'currency' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Currency',
                        'group' => 'Buy Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'courtage' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Courtage',
                        'group' => 'Buy Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'courtageNote' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Courtage Note',
                        'group' => 'Buy Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'marketingType' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Marketing Type',
                        'group' => 'Buy Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'priceIntervalType' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Price Interval Type',
                        'group' => 'Buy Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],

                // House Fields

                'livingSpace' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Living Space',
                        'group' => 'House Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'plotArea' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Plot Area',
                        'group' => 'House Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'numberOfRooms' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Number of Rooms',
                        'group' => 'House Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'buildingType' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Building Type',
                        'group' => 'House Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],

                // Commercial Fields

                'commercializationType' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Commercialization Type',
                        'group' => 'Commercial Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'totalFloorSpace' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Total Floor Space',
                        'group' => 'Commercial Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'netFloorSpace' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Net Floor Space',
                        'group' => 'Commercial Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'minDivisible' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Min Divisible',
                        'group' => 'Commercial Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'additionalCosts' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Additional Costs',
                        'group' => 'Commercial Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],

                // Special Purpose

                'shortDescription' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Short Description',
                        'group' => 'Special Purpose Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'trialLivingPossible' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Trial Living Possible',
                        'group' => 'Special Purpose Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'barrierFree' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Barrier Free',
                        'group' => 'Special Purpose Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'numberOfLookedAfterApartments' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Number of Looked After Apartments',
                        'group' => 'Special Purpose Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'numberOfNursingPlaces' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Number of Nursing Places',
                        'group' => 'Special Purpose Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'livingSpaceFrom' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Living Space From',
                        'group' => 'Special Purpose Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'livingSpaceTo' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Living Space To',
                        'group' => 'Special Purpose Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'handicappedAccessible' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Handicapped Accessible',
                        'group' => 'Special Purpose Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'guestApartmentsAvailable' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Guest Apartments Available',
                        'group' => 'Special Purpose Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'restaurantAvailable' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Restaurant Available',
                        'group' => 'Special Purpose Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'cookingFacilitiesAvailable' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Cooking Facilities Available',
                        'group' => 'Special Purpose Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'ownFurniturePossible' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Own Furniture Possible',
                        'group' => 'Special Purpose Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'cleaningServiceAvailable' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Cleaning Service Available',
                        'group' => 'Special Purpose Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'shoppingFacilitiesAvailable' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Shopping Facilities Available',
                        'group' => 'Special Purpose Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'security24Hours' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Security 24 Hours',
                        'group' => 'Special Purpose Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'culturalProgramAvailable' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Cultural Program Available',
                        'group' => 'Special Purpose Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'leisureActivitiesAvailable' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Leisure Activities Available',
                        'group' => 'Special Purpose Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'religiousOfferingsAvailable' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Religious Offerings Available',
                        'group' => 'Special Purpose Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'balconyAvailable' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Balcony Available',
                        'group' => 'Special Purpose Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],

                // Site Fields

                'commercializationType' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Commercialization Type',
                        'group' => 'Site Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'recommendedUseTypes' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Recommended Use Types',
                        'group' => 'Site Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'tenancy' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Tenancy',
                        'group' => 'Site Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'plotArea' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Plot Area',
                        'group' => 'Site Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'minDivisible' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Min Divisible',
                        'group' => 'Site Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'courtage' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Courtage',
                        'group' => 'Site Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'courtageNote' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Courtage Note',
                        'group' => 'Site Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'freeFrom' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Free From',
                        'group' => 'Site Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'shortTermConstructible' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Short Term Constructible',
                        'group' => 'Site Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'buildingPermission' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Building Permission',
                        'group' => 'Site Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'demolition' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Demolition',
                        'group' => 'Site Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'siteDevelopmentType' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Site Development Type',
                        'group' => 'Site Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'siteConstructibleType' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Site Constructible Type',
                        'group' => 'Site Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'grz' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'GRZ',
                        'group' => 'Site Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'gfz' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'GFZ',
                        'group' => 'Site Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'marketingType' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Marketing Type',
                        'group' => 'Site Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'priceIntervalType' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Price Interval Type',
                        'group' => 'Site Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'leaseInterval' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Lease Interval',
                        'group' => 'Site Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],

                // Garage Fields

                'value' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Kaufpreis',
                        'group' => 'Garage Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'currency' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Currency',
                        'group' => 'Garage Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'usableFloorSpace' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Usable Floor Space',
                        'group' => 'Garage Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'garageType' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Garage Type',
                        'group' => 'Garage Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'lengthGarage' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Length',
                        'group' => 'Garage Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'widthGarage' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Width',
                        'group' => 'Garage Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'heightGarage' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Height',
                        'group' => 'Garage Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],

                // CompulsaryAuctionFields

                'marketValue' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Market Value',
                        'group' => 'Compulsory Auction Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'lowestBid' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Lowest Bid',
                        'group' => 'Compulsory Auction Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'recurrenceAppointment' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Recurrence Appointment',
                        'group' => 'Compulsory Auction Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'dateOfAuction' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Date of Auction',
                        'group' => 'Compulsory Auction Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'lastChangeDate' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Last Change Date',
                        'group' => 'Compulsory Auction Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'cancellationDate' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Cancellation Date',
                        'group' => 'Compulsory Auction Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'recordationDate' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Recordation Date',
                        'group' => 'Compulsory Auction Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'area' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Area',
                        'group' => 'Compulsory Auction Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'auctionObjectType' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Auction Object Type',
                        'group' => 'Compulsory Auction Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'countyCourt' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'County Court',
                        'group' => 'Compulsory Auction Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'fileReferenceAtCountyCourt' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'File Reference at County Court',
                        'group' => 'Compulsory Auction Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'numberOfFolio' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Number of Folio',
                        'group' => 'Compulsory Auction Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'splittingAuction' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Splitting Auction',
                        'group' => 'Compulsory Auction Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'owner' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Owner',
                        'group' => 'Compulsory Auction Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'energyPerformanceCertificate' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Energy Performance Certificate',
                        'group' => 'Compulsory Auction Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],

                // FlatShareRoomFields

                'roomSize' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Room Size',
                        'group' => 'FlatShareRoom Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'Bodenbelag' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Bodenbelag',
                        'group' => 'FlatShareRoom Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'numberOfRooms' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Number of Rooms',
                        'group' => 'FlatShareRoom Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'apartmentType' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Apartment Type',
                        'group' => 'FlatShareRoom Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'cellar' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Cellar',
                        'group' => 'FlatShareRoom Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'heatingTypeEnev2014' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Heating Type Enev2014',
                        'group' => 'FlatShareRoom Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'barrierFree' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Barrier Free',
                        'group' => 'FlatShareRoom Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'courtage' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Courtage',
                        'group' => 'FlatShareRoom Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'energyCertificate' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Energy Certificate',
                        'group' => 'FlatShareRoom Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'energySourcesEnev2014' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Energy Sources Enev2014',
                        'group' => 'FlatShareRoom Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'buildingEnergyRatingType' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Building Energy Rating Type',
                        'group' => 'FlatShareRoom Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'thermalCharacteristic' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Thermal Characteristic',
                        'group' => 'FlatShareRoom Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'energyConsumptionContainsWarmWater' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Energy Consumption Contains Warm Water',
                        'group' => 'FlatShareRoom Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'baseRent' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Base Rent',
                        'group' => 'FlatShareRoom Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'totalRent' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Total Rent',
                        'group' => 'FlatShareRoom Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'serviceCharge' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Service Charge',
                        'group' => 'FlatShareRoom Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'deposit' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Deposit',
                        'group' => 'FlatShareRoom Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'heatingCosts' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Heating Costs',
                        'group' => 'FlatShareRoom Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'heatingCostsInServiceCharge' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Heating Costs In Service Charge',
                        'group' => 'FlatShareRoom Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'calculatedTotalRent' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Calculated Total Rent',
                        'group' => 'FlatShareRoom Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'calculatedTotalRentScope' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Calculated Total Rent Scope',
                        'group' => 'FlatShareRoom Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'freeFrom' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Free From',
                        'group' => 'FlatShareRoom Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'freeUntil' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Free Until',
                        'group' => 'FlatShareRoom Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'minimumTermOfLease' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Minimum Term Of Lease',
                        'group' => 'FlatShareRoom Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'totalSpace' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Total Space',
                        'group' => 'FlatShareRoom Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'numberOfMaleFlatMates' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Number Of Male Flat Mates',
                        'group' => 'FlatShareRoom Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'numberOfFemaleFlatMates' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Number Of Female Flat Mates',
                        'group' => 'FlatShareRoom Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'ageOfFlatMatesFrom' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Age Of Flat Mates From',
                        'group' => 'FlatShareRoom Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'ageOfFlatMatesTo' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Age Of Flat Mates To',
                        'group' => 'FlatShareRoom Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'ageOfRequestedFrom' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Age Of Requested From',
                        'group' => 'FlatShareRoom Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'ageOfRequestedTo' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Age Of Requested To',
                        'group' => 'FlatShareRoom Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'numberOfRequestedFlatMates' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Number Of Requested Flat Mates',
                        'group' => 'FlatShareRoom Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'floor' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Floor',
                        'group' => 'FlatShareRoom Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'numberOfFloors' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Number Of Floors',
                        'group' => 'FlatShareRoom Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'numberOfBathRooms' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Number Of Bath Rooms',
                        'group' => 'FlatShareRoom Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'balcony' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Balcony',
                        'group' => 'FlatShareRoom Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'garden' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Garden',
                        'group' => 'FlatShareRoom Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'lift' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Lift',
                        'group' => 'FlatShareRoom Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'oven' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Oven',
                        'group' => 'FlatShareRoom Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'refrigerator' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Refrigerator',
                        'group' => 'FlatShareRoom Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'stove' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Stove',
                        'group' => 'FlatShareRoom Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'dishwasher' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Dishwasher',
                        'group' => 'FlatShareRoom Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'washingMachine' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Washing Machine',
                        'group' => 'FlatShareRoom Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'bathHasWc' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Bath Has Wc',
                        'group' => 'FlatShareRoom Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'bathHasShower' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Bath Has Shower',
                        'group' => 'FlatShareRoom Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'bathHasTub' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Bath Has Tub',
                        'group' => 'FlatShareRoom Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'guestToilet' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Guest Toilet',
                        'group' => 'FlatShareRoom Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'petsAllowed' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Pets Allowed',
                        'group' => 'FlatShareRoom Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'internetConnection' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Internet Connection',
                        'group' => 'FlatShareRoom Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'smokingAllowed' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Smoking Allowed',
                        'group' => 'FlatShareRoom Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'requestedGender' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Requested Gender',
                        'group' => 'FlatShareRoom Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'furnishing' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Furnishing',
                        'group' => 'FlatShareRoom Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'tvConnection' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'TV Connection',
                        'group' => 'FlatShareRoom Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'telephoneConnection' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Telephone Connection',
                        'group' => 'FlatShareRoom Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'parkingSituation' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Parking Situation',
                        'group' => 'FlatShareRoom Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
                'flatShareSize' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => 'Flat Share Size',
                        'group' => 'FlatShareRoom Fields',
                        'filters' => ['limit'],
                        'value' => '',
                    ],
                ],
            ],

            'metadata' => [
                'type' => true,
                'label' => 'Realestate',
                'value' => '', // Falls benötigt
            ]
        ];
    }


}
