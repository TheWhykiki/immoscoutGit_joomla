<?php
/**
* @package      DigiNerds VMMImmoscout24 Package
*
* @author       Christian Schuelling <info@diginerds.de>
* @copyright    2024 diginerds.de - All rights reserved.
* @license      GNU General Public License version 3 or later
*/

    \defined('_JEXEC') or die;

    use Joomla\CMS\Factory;
    use Joomla\CMS\Language\Text;
    use Joomla\CMS\Router\Route;
    use VmmimmoscoutNamespace\Component\Vmmimmoscout\Site\Helper\RouteHelper;

    /** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
    $wa = $this->document->getWebAssetManager();
    $wa->useScript('com_vmmimmoscout.script');

    $menu   = Factory::getApplication()->getMenu()->getActive();
    $Itemid = $menu->id;

    if($this->items)
    {
        echo '<h1>' . Text::_('COM_VMMIMMOSCOUT_CONNECT_TITLE') . '</h1>';
        echo '<p>' . Text::_('COM_VMMIMMOSCOUT_CONNECT_TEXT') . '</p>';

    }

?>
