<?php
/**
 * @package      DigiNerds Immoscout24 Komponente
 *
 * @author       Christian Schuelling <info@diginerds.de>
 * @copyright    2024 diginerds.de - All rights reserved.
 * @license      GNU General Public License version 3 or later
 */

namespace VmmimmoscoutNamespace\Component\Vmmimmoscout\Administrator\Field\Modal;

\defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Form\FormField;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Language\LanguageHelper;
use Joomla\CMS\Session\Session;
use Joomla\Database\ParameterType;

/**
 * Supports a modal realestate picker.
 *
 * @since  1.0.0
 */
class RealestateField extends FormField
{
	/**
	 * The form field type.
	 *
	 * @var     string
	 * @since   1.0.0
	 */
	protected $type = 'Modal_Realestate';

	/**
	 * Method to get the field input markup.
	 *
	 * @return  string  The field input markup.
	 *
	 * @since   1.0.0
	 */
	protected function getInput()
	{
		$allowNew       = ((string) $this->element['new'] == 'true');
		$allowEdit      = ((string) $this->element['edit'] == 'true');
		$allowClear  = ((string) $this->element['clear'] != 'false');
		$allowSelect = ((string) $this->element['select'] != 'false');
		$allowPropagate = ((string) $this->element['propagate'] == 'true');

		// Load language
		$languages = LanguageHelper::getContentLanguages(array(0, 1), false);
		Factory::getLanguage()->load('com_vmmimmoscout', JPATH_ADMINISTRATOR);
		
		// The active realestate id field.
		$value = (int) $this->value > 0 ? (int) $this->value : '';

		// Create the modal id.
		$modalId = 'Realestate_' . $this->id;

		// Add the modal field script to the document head.
		/** @var \Joomla\CMS\WebAsset\WebAssetManager $wa */
		$wa = Factory::getApplication()->getDocument()->getWebAssetManager();

		// Add the modal field script to the document head.
		$wa->useScript('field.modal-fields');

		// Script to proxy the select modal function to the modal-fields.js file.
		if ($allowSelect)
        {
			static $scriptSelect = null;

			if (is_null($scriptSelect))
            {
				$scriptSelect = array();
			}

			if (!isset($scriptSelect[$this->id]))
            {
				$wa->addInlineScript("
				window.jSelectRealestate_" . $this->id . " = function (id, title, object) {
					window.processModalSelect('Realestate', '" . $this->id . "', id, title, '', object);
				}",
					[],
					['type' => 'realestate']
				);

				Text::script('JGLOBAL_ASSOCIATIONS_PROPAGATE_FAILED');
				
				$scriptSelect[$this->id] = true;
			}
		}

        // Setup variables for display.
        $linkRealestates = 'index.php?option=com_vmmimmoscout&amp;view=realestates&amp;layout=modal&amp;tmpl=component&amp;' . Session::getFormToken() . '=1';
        $linkRealestate  = 'index.php?option=com_vmmimmoscout&amp;view=realestate&amp;layout=modal&amp;tmpl=component&amp;' . Session::getFormToken() . '=1';
		$modalTitle   = Text::_('COM_VMMIMMOSCOUT_SELECT_A_REALESTATE');

		if (isset($this->element['language']))
        {
			$linkRealestates .= '&amp;forcedLanguage=' . $this->element['language'];
			$linkRealestate   .= '&amp;forcedLanguage=' . $this->element['language'];
			$modalTitle .= ' &#8212; ' . $this->element['label'];
		}

		$urlSelect = $linkRealestates . '&amp;function=jSelectRealestate_' . $this->id;
		$urlEdit   = $linkRealestate . '&amp;task=realestate.edit&amp;id=\' + document.getElementById("' . $this->id . '_id").value + \'';
		$urlNew    = $linkRealestate . '&amp;task=realestate.add';

		if ($value)
        {
			$db    = Factory::getContainer()->get('DatabaseDriver');
			$query = $db->getQuery(true)
				->select($db->quoteName('title'))
				->from($db->quoteName('#__vmmimmoscout_realestates'))
				->where($db->quoteName('id') . ' = :id')
				->bind(':id', $value, ParameterType::INTEGER);
			$db->setQuery($query);

			try
            {
				$title = $db->loadResult();
			}
            catch (\RuntimeException $e)
            {
				Factory::getApplication()->enqueueMessage($e->getMessage(), 'error');
			}
		}

		$title = empty($title) ? Text::_('COM_VMMIMMOSCOUT_SELECT_A_REALESTATE') : htmlspecialchars($title, ENT_QUOTES, 'UTF-8');

		// The current realestate display field.
		$html  = '';

		if ($allowSelect || $allowNew || $allowEdit || $allowClear)
        {
			$html .= '<span class="input-group">';
		}

		$html .= '<input class="form-control" id="' . $this->id . '_name" type="text" value="' . $title . '" readonly size="35">';

		// Select realestate button
		if ($allowSelect)
		{
			$html .= '<button'
				. ' class="btn btn-primary' . ($value ? ' hidden' : '') . '"'
				. ' id="' . $this->id . '_select"'
				. ' data-bs-toggle="modal"'
				. ' type="button"'
				. ' data-bs-target="#ModalSelect' . $modalId . '">'
				. '<span class="icon-file" aria-hidden="true"></span> ' . Text::_('JSELECT')
				. '</button>';
		}

		// New realestate button
		if ($allowNew)
		{
			$html .= '<button'
				. ' class="btn btn-secondary' . ($value ? ' hidden' : '') . '"'
				. ' id="' . $this->id . '_new"'
				. ' data-bs-toggle="modal"'
				. ' type="button"'
				. ' data-bs-target="#ModalNew' . $modalId . '">'
				. '<span class="icon-plus" aria-hidden="true"></span> ' . Text::_('JACTION_CREATE')
				. '</button>';
		}

		// Edit realestate button
		if ($allowEdit)
		{
			$html .= '<button'
				. ' class="btn btn-primary' . ($value ? '' : ' hidden') . '"'
				. ' id="' . $this->id . '_edit"'
				. ' data-bs-toggle="modal"'
				. ' type="button"'
				. ' data-bs-target="#ModalEdit' . $modalId . '">'
				. '<span class="icon-pen-square" aria-hidden="true"></span> ' . Text::_('JACTION_EDIT')
				. '</button>';
		}

		// Clear realestate button
		if ($allowClear)
		{
			$html .= '<button'
				. ' class="btn btn-secondary' . ($value ? '' : ' hidden') . '"'
				. ' id="' . $this->id . '_clear"'
				. ' type="button"'
				. ' onclick="window.processModalParent(\'' . $this->id . '\'); return false;">'
				. '<span class="icon-times" aria-hidden="true"></span> ' . Text::_('JCLEAR')
				. '</button>';
		}


		// Propagate realestate button
		if ($allowPropagate && count($languages) > 2)
		{
			// Strip off language tag at the end
			$tagLength = (int) strlen($this->element['language']);
			$callbackFunctionStem = substr("jSelectRealestate_" . $this->id, 0, -$tagLength);

			$html .= '<button'
			. ' class="btn btn-primary' . ($value ? '' : ' hidden') . '"'
			. ' type="button"'
			. ' id="' . $this->id . '_propagate"'
			. ' title="' . Text::_('JGLOBAL_ASSOCIATIONS_PROPAGATE_TIP') . '"'
			. ' onclick="Joomla.propagateAssociation(\'' . $this->id . '\', \'' . $callbackFunctionStem . '\');">'
			. '<span class="icon-sync" aria-hidden="true"></span> ' . Text::_('JGLOBAL_ASSOCIATIONS_PROPAGATE_BUTTON')
			. '</button>';
		}

		if ($allowSelect || $allowNew || $allowEdit || $allowClear)
		{
			$html .= '</span>';
		}

		// Select realestate modal
		if ($allowSelect)
		{
			$html .= HTMLHelper::_(
				'bootstrap.renderModal',
				'ModalSelect' . $modalId,
				array(
					'title'       => $modalTitle,
					'url'         => $urlSelect,
					'height'      => '400px',
					'width'       => '800px',
					'bodyHeight'  => 70,
					'modalWidth'  => 80,
					'footer'      => '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">'
										. Text::_('JLIB_HTML_BEHAVIOR_CLOSE') . '</button>',
				)
			);
		}

		// New realestate modal
		if ($allowNew)
		{
			$html .= HTMLHelper::_(
				'bootstrap.renderModal',
				'ModalNew' . $modalId,
				array(
					'title'       => Text::_('COM_VMMIMMOSCOUT_NEW_REALESTATE'),
					'backdrop'    => 'static',
					'keyboard'    => false,
					'closeButton' => false,
					'url'         => $urlNew,
					'height'      => '400px',
					'width'       => '800px',
					'bodyHeight'  => 70,
					'modalWidth'  => 80,
					'footer'      => '<button type="button" class="btn btn-secondary"'
							. ' onclick="window.processModalEdit(this, \''
							. $this->id . '\', \'add\', \'realestate\', \'cancel\', \'realestate-form\', \'jform_id\', \'jform_name\'); return false;">'
							. Text::_('JLIB_HTML_BEHAVIOR_CLOSE') . '</button>'
							. '<button type="button" class="btn btn-primary"'
							. ' onclick="window.processModalEdit(this, \''
							. $this->id . '\', \'add\', \'realestate\', \'save\', \'realestate-form\', \'jform_id\', \'jform_name\'); return false;">'
							. Text::_('JSAVE') . '</button>'
							. '<button type="button" class="btn btn-success"'
							. ' onclick="window.processModalEdit(this, \''
							. $this->id . '\', \'add\', \'realestate\', \'apply\', \'realestate-form\', \'jform_id\', \'jform_name\'); return false;">'
							. Text::_('JAPPLY') . '</button>',
				)
			);
		}

		// Edit realestate modal.
		if ($allowEdit)
		{
			$html .= HTMLHelper::_(
				'bootstrap.renderModal',
				'ModalEdit' . $modalId,
				array(
					'title'       => Text::_('COM_VMMIMMOSCOUT_EDIT_REALESTATE'),
					'backdrop'    => 'static',
					'keyboard'    => false,
					'closeButton' => false,
					'url'         => $urlEdit,
					'height'      => '400px',
					'width'       => '800px',
					'bodyHeight'  => 70,
					'modalWidth'  => 80,
					'footer'      => '<button type="button" class="btn btn-secondary"'
							. ' onclick="window.processModalEdit(this, \'' . $this->id
							. '\', \'edit\', \'realestate\', \'cancel\', \'realestate-form\', \'jform_id\', \'jform_name\'); return false;">'
							. Text::_('JLIB_HTML_BEHAVIOR_CLOSE') . '</button>'
							. '<button type="button" class="btn btn-primary"'
							. ' onclick="window.processModalEdit(this, \''
							. $this->id . '\', \'edit\', \'realestate\', \'save\', \'realestate-form\', \'jform_id\', \'jform_name\'); return false;">'
							. Text::_('JSAVE') . '</button>'
							. '<button type="button" class="btn btn-success"'
							. ' onclick="window.processModalEdit(this, \''
							. $this->id . '\', \'edit\', \'realestate\', \'apply\', \'realestate-form\', \'jform_id\', \'jform_name\'); return false;">'
							. Text::_('JAPPLY') . '</button>',
				)
			);
		}

		// Note: class='required' for client side validation.
		$class = $this->required ? ' class="required modal-value"' : '';

		$html .= '<input type="hidden" id="' . $this->id . '_id"' . $class . ' data-required="' . (int) $this->required . '" name="' . $this->name
			. '" data-text="' . htmlspecialchars(Text::_('COM_VMMIMMOSCOUT_SELECT_A_REALESTATE', true), ENT_COMPAT, 'UTF-8') . '" value="' . $value . '">';

		return $html;
	}

	/**
	 * Method to get the field label markup.
	 *
	 * @return  string  The field label markup.
	 *
	 * @since   1.0.0
	 */
	protected function getLabel()
	{
		return str_replace($this->id, $this->id . '_name', parent::getLabel());
	}
}
