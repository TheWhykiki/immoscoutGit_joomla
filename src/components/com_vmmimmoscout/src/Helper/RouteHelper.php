<?php
/**
* @package      DigiNerds VMMImmoscout24 Package
*
* @author       Christian Schuelling <info@diginerds.de>
* @copyright    2024 diginerds.de - All rights reserved.
* @license      GNU General Public License version 3 or later
*/

namespace VmmimmoscoutNamespace\Component\Vmmimmoscout\Site\Helper;

\defined('_JEXEC') or die;

use Joomla\CMS\Language\Multilanguage;

/**
 * Vmmimmoscout Component Route Helper
 *
 * @static
 * @package     Joomla.Site
 * @subpackage  com_vmmimmoscout * @since       1.0.0
 */
abstract class RouteHelper
{
	/**
	 * Get the URL route for a realestate from a realestate ID, realestates category ID and language
	 *
	 * @param   integer  $id        The id of the realestates
	 * @param   mixed    $language  The id of the language being used.
	 *
	 * @return  string  The link to the realestates
	 *
	 * @since   1.0.0
	 */
	public static function getRealestateRoute($id, $language = 0)
	{
		// Create the link
		$link = 'index.php?option=com_vmmimmoscout&view=realestate&realestateID=' . $id;


		if ($language && $language !== '*' && Multilanguage::isEnabled())
		{
			$link .= '&lang=' . $language;
		}

		return $link;
	}
}
