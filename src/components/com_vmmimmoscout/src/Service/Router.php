<?php
/**
* @package      DigiNerds VMMImmoscout24 Package
*
* @author       Christian Schuelling <info@diginerds.de>
* @copyright    2024 diginerds.de - All rights reserved.
* @license      GNU General Public License version 3 or later
*/

    namespace VmmimmoscoutNamespace\Component\Vmmimmoscout\Site\Service;


\defined('_JEXEC') or die;

use Joomla\CMS\Application\SiteApplication;
use Joomla\CMS\Component\Router\RouterBase;
use Joomla\CMS\Component\Router\RouterView;
use Joomla\CMS\Component\Router\RouterViewConfiguration;
use Joomla\CMS\Component\Router\Rules\MenuRules;
use Joomla\CMS\Component\Router\Rules\NomenuRules;
use Joomla\CMS\Component\Router\Rules\StandardRules;
use Joomla\CMS\Factory;
use Joomla\CMS\Menu\AbstractMenu;
use Joomla\CMS\Uri\Uri;
use Joomla\Database\ParameterType;

/**
 * Routing class from com_banners
 *
 * @since  3.3
 */

class Router extends RouterView
{


    public function __construct(SiteApplication $app, AbstractMenu $menu)
    {
        $views = ['realestates', 'realestate'];

        foreach($views as $view)
        {
            $route = new RouterViewConfiguration($view);
            if(in_array($view, array('realestate')))
            {
                $route->setKey('id');
            }
            $this->registerView($route);
        }

        parent::__construct($app, $menu);

        $this->attachRule(new MenuRules($this));
        $this->attachRule(new StandardRules($this));
        $this->attachRule(new NomenuRules($this));
    }


    /**
     * Build the route for the com_banners component
     *
     * @param   array  $query  An array of URL arguments
     *
     * @return  array  The URL arguments to use to assemble the subsequent URL.
     *
     * @since   3.3
     */
    public function build(&$query)
    {
        $segments = array();

        if (isset($query['view']))
        {
            if($query['view'] !== 'realestates')
            {
                //$segments[] = $query['view'];
                $segments[] = 'exposee';
            }

            unset($query['view']);
        }

        if (isset($query['realestateID']))
        {
            $segments[] = $query['realestateID'];
            unset($query['realestateID']);
        }

        return $segments;
    }

    /**
     * Parse method for URLs
     * This method is meant to transform the human readable URL back into
     * query parameters. It is only executed when SEF mode is switched on.
     *
     * @param   array  &$segments  The segments of the URL to parse.
     *
     * @return  array  The URL attributes to be used by the application.
     *
     * @since   3.3
     */
    public function parse(&$segments)
    {
        $vars = array();

        /*
        if($segments[0] !== 'realestates')
        {
            $vars['view'] = $segments[0];
            $vars['realestateID'] = (int) $segments[1];
        }
        */

        if($segments[0] !== 'realestates')
        {
            $vars['view'] = $segments[0];
            $vars['realestateID'] = (int) $segments[1];
            if($segments[0] === 'exposee')
            {
                $vars['view'] = 'realestate';
            }
        }

        $segments = [];

        return $vars;
    }

}
