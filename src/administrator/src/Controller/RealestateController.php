<?php
/**
 * @package      DigiNerds Immoscout24 Komponente
 *
 * @author       Christian Schuelling <info@diginerds.de>
 * @copyright    2024 diginerds.de - All rights reserved.
 * @license      GNU General Public License version 3 or later
 */
namespace VmmimmoscoutNamespace\Component\Vmmimmoscout\Administrator\Controller;

\defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\FormController;
use Joomla\CMS\MVC\Model\BaseDatabaseModel;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Versioning\VersionableControllerTrait;
use Joomla\Utilities\ArrayHelper;

/**
 * Controller for a single Realestate
 *
 * @since  1.0.0
 */
class RealestateController extends FormController
{
	use VersionableControllerTrait;
	
	/**
	 * The prefix to use with controller messages.
	 *
	 * @var    string
	 * @since  1.6
	 */
	protected $text_prefix = 'COM_VMMIMMOSCOUT_REALESTATE';
}
