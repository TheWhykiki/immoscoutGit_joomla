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

use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Multilanguage;
use Joomla\CMS\MVC\Model\ListModel;
use Joomla\Database\ParameterType;
use Joomla\Registry\Registry;
use VmmimmoscoutNamespace\Component\Vmmimmoscout\Site\Helper\VmmimmoscoutHelper;

/**
 * Realestates model class.
 *
 * @since  1.0.0
 */
class RealestatesModel extends ListModel
{
	/**
	 * Constructor.
	 *
	 * @param   array  $config  An optional associative array of configuration settings.
	 *
	 * @since   1.0.0
	 */
	public function __construct($config = array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = [
				'id', 'a.id',
				'title', 'a.title',
			];
		}

		parent::__construct($config);
	}

	/**
	 * Method to get a list of items.
	 *
	 * @return  mixed  An array of objects on success, false on failure.
	 */
	public function getItems()
	{

        //$start = (int) $this->getState('list.start');

        $app = Factory::getApplication();
        $input = $app->input;
        $start = $input->get('start', 0, 'INT');

        $total = (int) self::getTotal();

        $response = VmmimmoscoutHelper::realestatesAPIHelper(false, $start, $total);

        $realestates = json_decode($response);
        $realestatesData = $realestates->{"realestates.realEstates"};
        $realestateList = $realestatesData->{"realEstateList"}->{"realEstateElement"};

        $realestatesActive = [];

        foreach ($realestateList as $realestate) {
            if ($realestate->{"realEstateState"} === "ACTIVE") {
                $realestatesActive[] = $realestate;
            }
            // Debug -> show also inactive realestates
            else{
                $realestatesActive[] = $realestate;

            }
        }

		return $realestatesActive;
	}

    /**
     * Method to auto-populate the model state.
     *
     * Note. Calling getState in this method will result in recursion.
     *
     * @param   string  $ordering   An optional ordering field.
     * @param   string  $direction  An optional direction (asc|desc).
     *
     * @since   1.0.0
     */
    protected function populateState($ordering = null, $direction = null)
    {
        $app = Factory::getApplication();

        // Hole den aktuellen Menüpunkt und dessen Parameter
        $menu = $app->getMenu();
        $active = $menu->getActive(); // Dies holt den aktuellen Menüpunkt
        $paramsMenu = $active->getParams();

        // Hole die Seitengröße aus den Menüparametern, Standardwert ist 10
        $realestatePageSize = $paramsMenu->get('realestate_pagesize', 10);

        // Setze list.limit basierend auf dem Menüparameter oder dem Benutzerzustand
        $value = $app->getUserStateFromRequest($this->context . '.list.limit', 'limit', $realestatePageSize, 'uint');
        $this->setState('list.limit', $value);

        // Lade den Beginn der Liste aus dem Request.
        $value = $app->input->getUInt('start', 0);
        $this->setState('list.start', $value);

        // Rufe die Elternmethode auf, um die Standardreihenfolge und -richtung festzulegen.
        parent::populateState($ordering, $direction);
    }


    /**
     * Get the pagination object.
     *
     * @return \Joomla\CMS\Pagination\Pagination A pagination object.
     * @since  1.0.0
     */
    public function getPagination()
    {
        // Check if the pagination object already exists.
        if (empty($this->_pagination)) {
            $app = Factory::getApplication();

            // Hole den aktuellen Menüpunkt und dessen Parameter
            $menu = $app->getMenu();
            $active = $menu->getActive(); // Dies holt den aktuellen Menüpunkt
            $paramsMenu = $active->getParams();

            // Hole die Seitengröße aus den Menüparametern, Standardwert ist 10
            $realestatePageSize = $paramsMenu->get('realestate_pagesize', 10);

            // Import the Joomla pagination library.
            jimport('joomla.html.pagination');
            // Create a new pagination object.
            $this->_pagination = new \Joomla\CMS\Pagination\Pagination($this->getTotal(), $app->input->get('start', 0, 'INT'),$realestatePageSize);
        }
        return $this->_pagination;
    }


    /**
     * Get the total number of items.
     *
     * @return integer The total number of items.
     * @since  1.0.0
     */
    public function getTotal()
    {

        $response = VmmimmoscoutHelper::realestatesAPIHelper(false,  (int) $this->getState('list.start'), false);
        $realestateData = json_decode($response);
        $total = $realestateData->{"realestates.realEstates"}->Paging->{"numberOfHits"};

        return $total;
    }





}
