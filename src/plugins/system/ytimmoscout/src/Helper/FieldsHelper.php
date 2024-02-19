<?php
/**
* @package      DigiNerds VMMImmoscout24 Package
*
* @author       Christian Schuelling <info@diginerds.de>
* @copyright    2024 diginerds.de - All rights reserved.
* @license      GNU General Public License version 3 or later
*/

namespace Joomla\Plugin\System\Ytimmoscout\Helper;


use Joomla\CMS\Document\Document;
use Joomla\CMS\Language\Text;

class FieldsHelper
{
    public static function setFieldMappings($realestate)
    {

        $realestateProperties = get_object_vars($realestate);
        $realestateObjectKeys = array_keys($realestateProperties);


        /* ---------- */
        /* Remap all object keys to a new array */
        /* ---------- */

        $realestateRemapped = [];

        foreach ($realestateObjectKeys as $key) {
            if(str_contains('@', $key)) {
                $realestateRemapped[$key] = $realestate->{$key};
            }
            $realestateRemapped[$key] = $realestate->{$key};
        }


        /* ---------- */
        /* Remap Translatable String Fields */
        /* ---------- */

        $remappedTranslatable = [
            'heatingType', 'heatingTypeEnev2014', 'apartmentType', 'condition', 'buildingEnergyRatingType'
        ];
        $remappedTranslatableStrings = [
            'COM_YTIMMOSCOUT_HEATING_TYPE_', 'COM_YTIMMOSCOUT_HEATING_TYPE_', 'COM_YTIMMOSCOUT_APARTMENT_TYPE_', 'COM_YTIMMOSCOUT_CONDITION_', 'COM_YTIMMOSCOUT_ENERGY_CONSUMPTION_'
        ];
        foreach($remappedTranslatable as $key => $value)
        {
            if(property_exists($realestate, $value))
            {
                $realestateRemapped[$value] = Text::_($remappedTranslatableStrings[$key] . $realestate->{$value});
            }
        }


        /* ---------- */
        /* Remap Boolean Fields */
        /* ---------- */

        foreach ($realestateRemapped as $key => $value) {
            if($value === 'YES' || $value == 'true') {
                $realestateRemapped[$key] = Text::_('COM_YTIMMOSCOUT_YES');
            }
            if($value === 'NO' || $value == 'false') {
                $realestateRemapped[$key] =  Text::_('COM_YTIMMOSCOUT_NO');
            }
            if($value === 'NOT_APPLICABLE') {
                $realestateRemapped[$key] =  Text::_('COM_YTIMMOSCOUT_NOT_APPLICABLE');
            }
            if($value === 'NOT_AVAILABLE') {
                $realestateRemapped[$key] =  Text::_('COM_YTIMMOSCOUT_NOT_AVAILABLE');
            }
            if($value === 'NO_INFORMATION') {
                $realestateRemapped[$key] =  Text::_('COM_YTIMMOSCOUT_NO_INFORMATION');
            }
        }


        /* ---------- */
        /* Remap address data to new values */
        /* ---------- */

        $realestateRemapped['street'] = $realestate->address->street;
        $realestateRemapped['houseNumber'] = $realestate->address->houseNumber;
        $realestateRemapped['zipCode'] = $realestate->address->postcode;
        $realestateRemapped['city'] = $realestate->address->city;
        $realestateRemapped['lat'] = $realestate->address->wgs84Coordinate->latitude;
        $realestateRemapped['lng'] = $realestate->address->wgs84Coordinate->longitude;
        $realestateRemapped['latlng'] = $realestate->address->wgs84Coordinate->latitude . ',' . $realestate->address->wgs84Coordinate->longitude;
        unset($realestateRemapped['address']);


        /* ---------- */
        /* Remap Courtage data to new values */
        /* ---------- */

        if($realestate->courtage->hasCourtage === 'YES')
        {
            $realestateRemapped['courtage'] = $realestate->courtage->courtage ?? '';
            $realestateRemapped['courtageNote'] = $realestate->courtage->courtageNote ?? '';
        }


        /* ---------- */
        /* Remap Energy data to new values, generate comma separated string */
        /* ---------- */

        if (isset($realestate->energySourcesEnev2014) && is_object($realestate->energySourcesEnev2014)) {

            if (isset($realestate->energySourcesEnev2014->energySourceEnev2014)) {

                $energySources = $realestate->energySourcesEnev2014->energySourceEnev2014;

                if (is_array($energySources)) {
                    $maxValues = count($energySources);
                    $counter = 0;
                    $energySourcesEnev2014 = '';
                    foreach ($energySources as $value) {
                        $counter++;
                        $energySourcesEnev2014 .= Text::_('COM_YTIMMOSCOUT_ENERGY_SOURCES_ENEV_2014_' . $value) . ', ';
                        if($counter === $maxValues) {
                            $energySourcesEnev2014 .= Text::_('COM_YTIMMOSCOUT_ENERGY_SOURCES_ENEV_2014_' . $value);
                        }
                    }
                } else {
                    $energySourcesEnev2014 = Text::_('COM_YTIMMOSCOUT_ENERGY_SOURCES_ENEV_2014_' . $energySources);
                }
            }

            $realestateRemapped['energySourcesEnev2014'] = $energySourcesEnev2014;
        }


        /* ---------- */
        /* Remap Firing data to new values, generate comma separated string */
        /* ---------- */

        if (isset($realestate->firingTypes)) {

            if (isset($realestate->firingTypes[0]->firingType)) {

                $firingTypes = $realestate->firingTypes[0]->firingType;
                if (is_array($firingTypes)) {
                    $maxValues = count($firingTypes);
                    $counter = 0;
                    $firingTypeLabels = '';
                    foreach ($firingTypes as $value) {
                        $counter++;
                        $firingTypeLabels .= Text::_('COM_YTIMMOSCOUT_ENERGY_SOURCES_ENEV_2014_' . $value) . ', ';
                        if($counter === $maxValues) {
                            $firingTypeLabels .= Text::_('COM_YTIMMOSCOUT_ENERGY_SOURCES_ENEV_2014_' . $value);
                        }
                    }
                } else {
                    $firingTypeLabels = Text::_('COM_YTIMMOSCOUT_ENERGY_SOURCES_ENEV_2014_' . $firingTypes);
                }

            }

            $realestateRemapped['firingTypes'] = $firingTypeLabels;
        }


        /* ---------- */
        /* Remap Energy Certificate data to new values */
        /* ---------- */

        if (isset($realestate->energyCertificate)) {

            if (isset($realestate->energyCertificate->energyCertificateCreationDate)) {
                $realestateRemapped['energyCertificateCreationDate'] = $realestate->energyCertificate->energyCertificateCreationDate;
            }
            if (isset($realestate->energyCertificate->energyEfficiencyClass)) {
                $realestateRemapped['energyEfficiencyClass'] = $realestate->energyCertificate->energyEfficiencyClass;
            }
            unset($realestateRemapped['energyCertificate']);
        }


        return $realestateRemapped;
    }

}
