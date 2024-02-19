<?php
/**
* @package      DigiNerds VMMImmoscout24 Package
*
* @author       Christian Schuelling <info@diginerds.de>
* @copyright    2024 diginerds.de - All rights reserved.
* @license      GNU General Public License version 3 or later
*/

    namespace VmmimmoscoutNamespace\Component\Vmmimmoscout\Administrator\Model;

\defined('_JEXEC') or die;

use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\ListModel;

/**
 *fourtexx
 *
 * @package   com_fourtexx
 * @since     1.0.0
 */
class DashboardModel extends ListModel
{
    /**
     * Method to get a statistic for the dashboard.
     *
     * @return  object  Returns itself to support chaining.
     */
    public function getStatistic()
    {
        $statistic = 'Stats';
        return $statistic;
    }
}
