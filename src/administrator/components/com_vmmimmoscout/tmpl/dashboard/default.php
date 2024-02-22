<?php
/**
* @package      DigiNerds VMMImmoscout24 Package
*
* @author       Christian Schuelling <info@diginerds.de>
* @copyright    2024 diginerds.de - All rights reserved.
* @license      GNU General Public License version 3 or later
*/


    defined('_JEXEC') or die;

    use Joomla\CMS\Language\Text;
?>

<div class="container-fluid">
    <!-- Willkommenskasten -->
    <div class="card mb-3">
        <div class="card-header">
            <h2><?php echo Text::_('COM_VMMIMMOSCOUT_WELCOME_HEADER'); ?></h2>
        </div>
        <div class="card-body">
            <h5 class="card-title"><?php echo Text::_('COM_VMMIMMOSCOUT_COMPONENT_NAME'); ?></h5>
            <p class="card-text"><?php echo Text::_('COM_VMMIMMOSCOUT_COMPONENT_VERSION'); ?></p>
        </div>
    </div>

    <!-- Kontaktinformationen -->
    <div class="card mb-3">
        <div class="card-header">
            <h3><?php echo Text::_('COM_VMMIMMOSCOUT_CONTACT_HEADER'); ?></h3>
        </div>
        <div class="card-body">
            <p class="card-text"><?php echo Text::_('COM_VMMIMMOSCOUT_CONTACT_ADDRESS'); ?></p>
            <p class="card-text"><?php echo Text::_('COM_VMMIMMOSCOUT_CONTACT_EMAIL'); ?></p>
            <p class="card-text"><?php echo Text::_('COM_VMMIMMOSCOUT_CONTACT_PHONE'); ?></p>
        </div>
    </div>

    <!-- Hilfe & Informationen -->
    <div class="card mb-3">
        <div class="card-header">
            <h3><?php echo Text::_('COM_VMMIMMOSCOUT_HELP_HEADER'); ?></h3>
        </div>
        <div class="card-body">
            <p class="card-text"><?php echo Text::_('COM_VMMIMMOSCOUT_HELP_SUPPORT_PHONE'); ?></p>
            <p class="card-text"><?php echo Text::_('COM_VMMIMMOSCOUT_HELP_SUPPORT_EMAIL'); ?></p>
            <p class="card-text"><?php echo Text::_('COM_VMMIMMOSCOUT_HELP_DOC_INFO'); ?></p>
            <a href="index.php?option=com_config&view=component&component=com_vmmimmoscout" class="btn btn-primary"><?php echo Text::_('COM_VMMIMMOSCOUT_HELP_OPTIONS_BUTTON'); ?></a>
        </div>
    </div>

    <!-- Plugin Information Card -->
    <div class="card mb-3">
        <div class="card-header">
            <h3><?php echo Text::_('COM_VMMIMMOSCOUT_PLUGIN_INFO_HEADER'); ?></h3>
        </div>
        <div class="card-body">
            <p class="card-text"><?php echo Text::_('COM_VMMIMMOSCOUT_PLUGIN_INFO_JTF'); ?></p>
            <hr />
            <p class="card-text"><?php echo Text::_('COM_VMMIMMOSCOUT_PLUGIN_INFO_TPL'); ?></p>
            <hr />
            <p class="card-text"><?php echo Text::_('COM_VMMIMMOSCOUT_PLUGIN_INFO_SETTINGS'); ?></p>
            <a href="index.php?option=com_plugins&view=plugins&filter_search=Content - JTF" class="btn btn-primary"><?php echo Text::_('COM_VMMIMMOSCOUT_PLUGIN_INFO_SETTINGS_BUTTON'); ?></a>
            <br><br>
            <p class="card-text"><?php echo Text::_('COM_VMMIMMOSCOUT_PLUGIN_INFO_MORE_INFO'); ?></p>
            <a href="https://github.com/joomtools/plg_content_jtf/tree/release/joomla4" class="btn btn-info"><?php echo Text::_('COM_VMMIMMOSCOUT_PLUGIN_INFO_MORE_INFO_BUTTON'); ?></a>
            <br><br>
            <p class="card-text"><?php echo Text::_('COM_VMMIMMOSCOUT_PLUGIN_INFO_DOCUMENTATION'); ?></p>
            <a href="https://github.com/joomtools/plg_content_jtf/blob/master/JTF-Documentation_EN_DE.pdf" class="btn btn-secondary"><?php echo Text::_('COM_VMMIMMOSCOUT_PLUGIN_INFO_DOCUMENTATION_BUTTON'); ?></a>
        </div>
    </div>
</div>
