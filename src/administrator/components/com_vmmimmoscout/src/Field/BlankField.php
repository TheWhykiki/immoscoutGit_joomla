<?php
/**
* @package      DigiNerds VMMImmoscout24 Package
*
* @author       Christian Schuelling <info@diginerds.de>
* @copyright    2024 diginerds.de - All rights reserved.
* @license      GNU General Public License version 3 or later
*/

namespace VmmimmoscoutNamespace\Component\Vmmimmoscout\Administrator\Field;

\defined('_JEXEC') or die;

use Joomla\CMS\Form\Field\ListField;
use Joomla\CMS\Language\Associations;

/**
 * Blank Field class. Only a boilerplate
 * Supports a generic list of options.
 * Displays only when Associations are enabled.
 *
 * @since  1.0.0
 */
class BlankField extends ListField
{
	/**
	 * The form field type.
	 *
	 * @var    string
	 * @since  1.0.0
	 */
	protected $type = 'Blank';

	/**
	 * Method to attach a Form object to the field.
	 *
	 * @param   \SimpleXMLElement  $element  The SimpleXMLElement object representing the `<field>` tag for the form field object.
	 * @param   mixed              $value    The form field value to validate.
	 * @param   string             $group    The field name group control value. This acts as an array container for the field.
	 *                                       For example if the field has name="foo" and the group value is set to "bar" then the
	 *                                       full field name would end up being "bar[foo]".
	 *
	 * @return  boolean  True on success.
	 *
	 * @since   4.0.0
	 */
	public function setup(\SimpleXMLElement $element, $value, $group = null)
	{
		return parent::setup($element, $value, $group);
	}
}
