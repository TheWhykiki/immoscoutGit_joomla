<?php
/**
 * @package      DigiNerds Immoscout24 Komponente
 *
 * @author       Christian Schuelling <info@diginerds.de>
 * @copyright    2024 diginerds.de - All rights reserved.
 * @license      GNU General Public License version 3 or later
 */

namespace VmmimmoscoutNamespace\Component\Vmmimmoscout\Site\Service;

\defined('_JEXEC') or die;

use Joomla\CMS\Application\SiteApplication;
use Joomla\CMS\Categories\CategoryFactoryInterface;
use Joomla\CMS\Categories\CategoryInterface;
use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Component\Router\RouterView;
use Joomla\CMS\Component\Router\RouterViewConfiguration;
use Joomla\CMS\Component\Router\Rules\MenuRules;
use Joomla\CMS\Component\Router\Rules\NomenuRules;
use Joomla\CMS\Component\Router\Rules\StandardRules;
use Joomla\CMS\Menu\AbstractMenu;
use Joomla\Database\DatabaseInterface;
use Joomla\Database\ParameterType;

/**
 * Routing class from com_vmmimmoscout *
 * @since  1.0.0
 */
class Router extends RouterView
{
	/**
	 * Flag to remove IDs
	 *
	 * @var    boolean
	 */
	protected $noIDs = false;

	/**
	 * The category factory
	 *
	 * @var CategoryFactoryInterface
	 *
	 * @since  1.0.0
	 */
	private $categoryFactory;

    /**
	 * The category cache
	 *
	 * @var  array
	 *
	 * @since  1.0.0
	 */
	private $categoryCache = [];

	/**
	 * The db
	 *
	 * @var DatabaseInterface
	 *
	 * @since  1.0.0
	 */
	private $db;

	/**
	 * Vmmimmoscout Component router constructor
	 *
	 * @param   SiteApplication           $app              The application object
	 * @param   AbstractMenu              $menu             The menu object to work with
	 * @param   CategoryFactoryInterface  $categoryFactory  The category object
	 * @param   DatabaseInterface         $db               The database object
	 */
	public function __construct(SiteApplication $app, AbstractMenu $menu, CategoryFactoryInterface $categoryFactory, DatabaseInterface $db)
	{

        /*
		$this->categoryFactory = $categoryFactory;
		$this->db = $db;

		$params = ComponentHelper::getParams('com_vmmimmoscout');

		$this->noIDs = (bool) $params->get('sef_ids');


		$realestate = new RouterViewConfiguration('realestate');
        $realestate->setKey('id');
		$this->registerView($realestate);

		$this->registerView(new RouterViewConfiguration('featured'));

		$this->registerView(new RouterViewConfiguration('realestates'));

		parent::__construct($app, $menu);

		$this->attachRule(new MenuRules($this));
		$this->attachRule(new StandardRules($this));
		$this->attachRule(new NomenuRules($this)); */
	}

    /**
	 * Method to get the segment(s) for a realestate
	 *
	 * @param   string  $id     ID of the realestate to retrieve the segments for
	 * @param   array   $query  The request that is built right now
	 *
	 * @return  array|string  The segments of this item
	 *
	 * @since  1.0.0
	 */
	public function getRealestateSegment($id, $query)
	{
		if (!strpos($id, ':'))
		{
			$id = (int) $id;
			$dbquery = $this->db->getQuery(true);
			$dbquery->select($this->db->quoteName('alias'))
				->from($this->db->quoteName('#__vmmimmoscout_realestates'))
				->where($this->db->quoteName('id') . ' = :id')
				->bind(':id', $id, ParameterType::INTEGER);
			$this->db->setQuery($dbquery);

			$id .= ':' . $this->db->loadResult();
		}

		if ($this->noIDs)
		{
			list($void, $segment) = explode(':', $id, 2);

			return [$void => $segment];
		}

		return [(int) $id => $id];
	}

    /**
	 * Method to get the segment(s) for a realestate
	 *
	 * @param   string  $segment  Segment of the realestate to retrieve the ID for
	 * @param   array   $query    The request that is parsed right now
	 *
	 * @return  mixed   The id of this item or false
	 *
	 * @since  1.0.0
	 */
	public function getRealestateId($segment, $query)
	{
		if ($this->noIDs)
		{
			$dbquery = $this->db->getQuery(true);
			$dbquery->select($this->db->quoteName('id'))
				->from($this->db->quoteName('#__vmmimmoscout_realestates'))
				->where(
					[
						$this->db->quoteName('alias') . ' = :alias',
						$this->db->quoteName('catid') . ' = :catid',
					]
				)
				->bind(':alias', $segment)
				->bind(':catid', $query['id'], ParameterType::INTEGER);
			$this->db->setQuery($dbquery);

			return (int) $this->db->loadResult();
		}

		return (int) $segment;
	}


}
