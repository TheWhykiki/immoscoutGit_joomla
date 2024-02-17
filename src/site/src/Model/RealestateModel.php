<?php
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

        if (array_key_exists('realestates.apartmentRent', $properties)) {
            $realestateData = $realestate->{"realestates.apartmentRent"};
            $realestateData->{"realestateType"} = "apartmentRent";
        }

        elseif (array_key_exists('realestates.houseBuy', $properties)) {
            $realestateData = $realestate->{"realestates.houseBuy"};
            $realestateData->{"realestateType"} = "houseBuy";
        }

        $response = VmmimmoscoutHelper::realestatesContactData();
        $contactData = json_decode($response);

        $contactEmail = $contactData->{'common.realtorContactDetailsList'}->{'realtorContactDetails'}[0]->{"email"};

        return $realestateData;
	}


}
