<?php
/**
 * @package    com_fourtexx
 *
 * @author     Niels Nübel <niels@kicktemp.com>
 * @copyright  Kicktemp GmbH
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @link       https://kicktemp.com
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
