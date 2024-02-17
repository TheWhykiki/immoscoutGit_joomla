<?php
//
    /**
     * @package      DigiNerds Immoscout24 Komponente
     *
     * @author       Christian Schuelling <info@diginerds.de>
     * @copyright    2024 diginerds.de - All rights reserved.
     * @license      GNU General Public License version 3 or later
     */

    namespace VmmimmoscoutNamespace\Component\Vmmimmoscout\Site\Model;

    \defined('_JEXEC') or die;

    use Joomla\CMS\Factory;
    use Joomla\CMS\MVC\Model\BaseDatabaseModel;
    use Joomla\CMS\Language\Text;
    use VmmimmoscoutNamespace\Component\Vmmimmoscout\Site\Helper\VmmimmoscoutHelper;

    /**
     * Realestate model for the Joomla Vmmimmoscout component.
     *
     * @since  1.0.0
     */
    class RealestateModel extends BaseDatabaseModel
    {
        /**
         * @var string item
         */
        protected $_item = null;

        /**
         * Gets a realestate
         *
         * @param   integer  $pk  Id for the realestate
         *
         * @return  mixed Object or null
         *
         * @since   1.0.0
         */
        public function getItem($pk = null)
        {

            $response = VmmimmoscoutHelper::realestatesAPIHelper(true, 0, 1);

            $realestate = json_decode($response);

            // Erhalten Sie alle Eigenschaften des Objekts als ein assoziatives Array
            $properties = get_object_vars($realestate);

            $realestateTypes = [
                'realestates.apartmentRent'          => 'apartmentRent',
                'realestates.apartmentBuy'           => 'apartmentBuy',
                'realestates.houseRent'              => 'houseRent',
                'realestates.houseBuy'               => 'houseBuy',
                'realestates.livingRentSite'         => 'livingRentSite',
                'realestates.livingBuySite'          => 'livingBuySite',
                'realestates.garageRent'             => 'garageRent',
                'realestates.garageBuy'              => 'garageBuy',
                'realestates.office'                 => 'office',
                'realestates.store'                  => 'store',
                'realestates.gastronomy'             => 'gastronomy',
                'realestates.industry'               => 'industry',
                'realestates.tradeSite'              => 'tradeSite',
                'realestates.specialPurpose'         => 'specialPurpose',
                'realestates.investment'             => 'investment',
                'realestates.FlatShareRoom'          => 'FlatShareRoom',
                'realestates.houseType'              => 'houseType',
                'realestates.compulsoryAuction'      => 'compulsoryAuction',
                'realestates.assistedLiving'         => 'assistedLiving',
                'realestates.seniorCare'             => 'seniorCare',
                'realestates.shortTermAccommodation' => 'shortTermAccommodation',
            ];

            foreach ($realestateTypes as $propertyKey => $type)
            {
                if (array_key_exists($propertyKey, $properties))
                {
                    $realestateData                 = $realestate->{$propertyKey};
                    $realestateData->realestateType = $type;
                    break; // Stop the loop once we've found and set the data
                }
            }

            // Get the contact data --> TODO: Move this to a helper
            $response    = VmmimmoscoutHelper::realestatesContactData();
            $contactData = json_decode($response);
            $contactEmail = $contactData->{'common.realtorContactDetailsList'}->{'realtorContactDetails'}[0]->{"email"};

            return $realestateData;
        }


    }
