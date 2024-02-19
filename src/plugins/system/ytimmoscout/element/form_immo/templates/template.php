<?php
/**
* @package      DigiNerds VMMImmoscout24 Package
*
* @author       Christian Schuelling <info@diginerds.de>
* @copyright    2024 diginerds.de - All rights reserved.
* @license      GNU General Public License version 3 or later
*/

    use Joomla\CMS\HTML\HTMLHelper;
    use Joomla\CMS\Plugin\PluginHelper;

    $form = '{jtf mailto=' . $props['exposeeContact'] . ' | subject=' . $props['exposeeTitle'] . ' (' . $props['exposeeId'] . ' ) | theme=exposee }';

    if (PluginHelper::isEnabled('content', 'jtf'))
    {
       echo HTMLHelper::_('content.prepare', $form);
    }
