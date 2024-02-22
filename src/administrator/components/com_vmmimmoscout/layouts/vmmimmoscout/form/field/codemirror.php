<?php

    /**
     * @package      DigiNerds VMMImmoscout24 Package
     *
     * @author       Christian Schuelling <info@diginerds.de>
     * @copyright    2024 diginerds.de - All rights reserved.
     * @license      GNU General Public License version 3 or later
     */

    // No direct access
    defined('_JEXEC') or die;

    use Joomla\CMS\Factory;
    use Joomla\CMS\Language\Text;
    use Joomla\Registry\Registry;

    extract($displayData);

    /**
     * Layout variables
     *
     * @var   array    $options     JS options for editor
     * @var   Registry $params      Plugin parameters
     * @var   string   $id          The id of the input
     * @var   string   $name        The name of the input
     * @var   integer  $cols        Textarea cols attribute
     * @var   integer  $rows        Textarea rows attribute
     * @var   string   $content     The value
     */

    $option  = ' options="' . $this->escape(json_encode($options)) . '"';
    $style   = '';

    if ($options->width) {
        $style .= 'width:' . $options->width . ';';
    }
    if ($options->height) {
        $style .= 'height:' . $options->height . ';';
    }

    /** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
    $wa = Factory::getApplication()->getDocument()->getWebAssetManager();

    $wa->getRegistry()->addExtensionRegistryFile('plg_editors_codemirror');
    $wa->useStyle('plg_editors_codemirror')
        ->useScript('webcomponent.editor-codemirror');

?>
<style>
    .editor-container {
        position: relative;
        margin-bottom: 20px; /* Abstand zwischen Titel und Editor */
    }

    .editor-title {
        background-color: #f5f5f5; /* Hintergrundfarbe des Titels */
        padding: 10px; /* Innenabstand des Titels */
        border-bottom: 1px solid #ddd; /* Untere Grenze des Titels */
        font-family: Arial, sans-serif; /* Schriftart des Titels */
        font-size: 14px; /* Schriftgröße des Titels */
        color: #333; /* Textfarbe des Titels */
    }
</style>
<joomla-editor-codemirror <?php echo $option; ?> id="<?= $id ?>">
    <div class="editor-title">
        <?= Text::_('COM_VMMIMMOSCOUT_HELP_FILE_PATH'). ': <a href="' . $params['filePath'] . '">' . $params['filePath'] . '</a>' ?>
</div>

    <?php echo '<textarea name="' . $name . '" id="textarea_' . $id . '" cols="' . $cols . '" rows="' . $rows . '" style="' . $style . '">' . $content . '</textarea>'; ?>
    <?php echo $buttons ?? ''; ?>

</joomla-editor-codemirror>
