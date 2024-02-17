<?php

    /**
     * @package      DigiNerds Immoscout24 Komponente
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
            <?php echo Text::_('COM_VMMIMMOSCOUT_WELCOME_HEADER'); ?>
        </div>
        <div class="card-body">
            <h5 class="card-title"><?php echo Text::_('COM_VMMIMMOSCOUT_COMPONENT_NAME'); ?></h5>
            <p class="card-text"><?php echo Text::_('COM_VMMIMMOSCOUT_COMPONENT_VERSION'); ?></p>
        </div>
    </div>

    <!-- Kontaktinformationen -->
    <div class="card mb-3">
        <div class="card-header">
            <?php echo Text::_('COM_VMMIMMOSCOUT_CONTACT_HEADER'); ?>
        </div>
        <div class="card-body">
            <p class="card-text"><?php echo Text::_('COM_VMMIMMOSCOUT_CONTACT_ADDRESS'); ?></p>
            <p class="card-text"><?php echo Text::_('COM_VMMIMMOSCOUT_CONTACT_EMAIL'); ?></p>
            <p class="card-text"><?php echo Text::_('COM_VMMIMMOSCOUT_CONTACT_PHONE'); ?></p>
        </div>
    </div>

    <!-- Hilfe & Informationen -->
    <div class="card">
        <div class="card-header">
            <?php echo Text::_('COM_VMMIMMOSCOUT_HELP_HEADER'); ?>
        </div>
        <div class="card-body">
            <p class="card-text"><?php echo Text::_('COM_VMMIMMOSCOUT_HELP_SUPPORT_PHONE'); ?></p>
            <p class="card-text"><?php echo Text::_('COM_VMMIMMOSCOUT_HELP_SUPPORT_EMAIL'); ?></p>
            <p class="card-text"><?php echo Text::_('COM_VMMIMMOSCOUT_HELP_DOC_INFO'); ?></p>
            <a href="index.php?option=com_config&view=component&component=com_vmmimmoscout" class="btn btn-primary"><?php echo Text::_('COM_VMMIMMOSCOUT_HELP_OPTIONS_BUTTON'); ?></a>
        </div>
    </div>
</div>
