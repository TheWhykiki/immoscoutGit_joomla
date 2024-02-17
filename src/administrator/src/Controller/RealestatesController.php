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

use Joomla\CMS\Language\Text;
use Joomla\Utilities\ArrayHelper;
use Joomla\CMS\Application\CMSApplication;
use Joomla\CMS\MVC\Controller\AdminController;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\Input\Input;
use Joomla\CMS\Session\Session;
use Joomla\CMS\Router\Route;

/**
 * The Realestates list controller class.
 *
 * @since  1.0.0
 */
class RealestatesController extends AdminController
{	
	/**
	 * The prefix to use with controller messages.
	 *
	 * @var    string
	 * @since  1.6
	 */
	protected $text_prefix = 'COM_VMMIMMOSCOUT_REALESTATES';
	
	/**
	 * Proxy for getModel.
	 *
	 * @param   string  $name    The name of the model.
	 * @param   string  $prefix  The prefix for the PHP class name.
	 * @param   array   $config  Array of configuration parameters.
	 *
	 * @return  \Joomla\CMS\MVC\Model\BaseDatabaseModel
	 *
	 * @since   1.0.0
	 */
	public function getModel($name = 'Realestate', $prefix = 'Administrator', $config = array('ignore_request' => true))
	{
		return parent::getModel($name, $prefix, $config);
	}
    
	/**
	 * Method to delete a record.
	 *
	 * @return  void
	 */
	public function delete()
	{
		// Check for request forgeries.
		Session::checkToken() or jexit(Text::_('JINVALID_TOKEN'));

		$ids    = $this->input->get('cid', array(), 'array');
		
		if (empty($ids))
		{
			JError::raiseWarning(500, Text::_('COM_VMMIMMOSCOUT_NO_ITEM_SELECTED'));
		}
		else
		{
			// Get the model.
			$model = $this->getModel();
			
			foreach ($ids as $id)
			{
				$model->delete($id);
			}
		}

		$this->setRedirect('index.php?option=com_vmmimmoscout&view=realestates');
	}
}
