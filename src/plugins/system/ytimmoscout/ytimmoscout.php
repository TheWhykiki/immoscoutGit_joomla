<?php
/**
* @package      DigiNerds VMMImmoscout24 Package
*
* @author       Christian Schuelling <info@diginerds.de>
* @copyright    2024 diginerds.de - All rights reserved.
* @license      GNU General Public License version 3 or later
*/


use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Plugin\CMSPlugin;
use YOOtheme\Application;

defined('_JEXEC') or die;

/**
* StudiogongDataset plugin.
*
* @package   plg_system_ytdataset
* @since     1.0.0
*/
class plgSystemYtimmoscout extends CMSPlugin
{
/**
 * onAfterInitialise.
 *
 * @return  void
 *
 * @since   1.0.0
 */
public function onAfterInitialise ()
{
    // Check if YOOtheme Pro is loaded
    if (!class_exists(Application::class, false)) {
        return;
    }

    // Load a single module from the same directory
    $app = Application::getInstance();
    $app->load(__DIR__ . '/bootstrap.php');
}

}
