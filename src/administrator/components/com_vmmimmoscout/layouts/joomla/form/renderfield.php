<?php

    /**
     * @package      DigiNerds VMMImmoscout24 Package
     *
     * @author       Christian Schuelling <info@diginerds.de>
     * @copyright    2024 diginerds.de - All rights reserved.
     * @license      GNU General Public License version 3 or later
     */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;

extract($displayData);

/**
 * Layout variables
 * -----------------
 * @var   array   $options      Optional parameters
 * @var   string  $name         The id of the input this label is for
 * @var   string  $label        The html code for the label
 * @var   string  $input        The input field html code
 * @var   string  $description  An optional description to use in a tooltip
 */

if (!empty($options['showonEnabled']))
{
	/** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
	$wa = Factory::getApplication()->getDocument()->getWebAssetManager();
	$wa->useScript('showon');
}

$class           = empty($options['class']) ? '' : ' ' . $options['class'];
$rel             = empty($options['rel']) ? '' : ' ' . $options['rel'];
$id              = $name . '-desc';
$hideLabel       = !empty($options['hiddenLabel']);
$hideDescription = empty($options['hiddenDescription']) ? false : $options['hiddenDescription'];

if (!empty($parentclass))
{
	$class .= ' ' . $parentclass;
}

?>
<div class="control-group<?php echo $class; ?>"<?php echo $rel; ?>>
    <?php if ($hideLabel) : ?>
        <div class="visually-hidden"><?php echo $label; ?></div>
    <?php else : ?>
        <div class="control-label"><?php echo $label; ?></div>
    <?php endif; ?>
    <div class="controls">
        <?php echo $input; ?>
        <?php if (!$hideDescription && !empty($description)) : ?>
            <div id="<?php echo $id; ?>" class="<?php echo $class ?>">
                <small class="form-text">
                    <?php echo $description; ?>
                </small>
            </div>
        <?php endif; ?>
    </div>
</div>
