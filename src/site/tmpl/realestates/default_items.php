<?php
/**
 * @package      DigiNerds Immoscout24 Komponente
 *
 * @author       Christian Schuelling <info@diginerds.de>
 * @copyright    2024 diginerds.de - All rights reserved.
 * @license      GNU General Public License version 3 or later
 */

\defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Router\Route;
use VmmimmoscoutNamespace\Component\Vmmimmoscout\Site\Helper\RouteHelper;

HTMLHelper::_('behavior.core');

$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn  = $this->escape($this->state->get('list.direction'));
?>
<div class="com-vmmimmoscout-list__items">
	<?php if (empty($this->items)) : ?>
		<p class="com-vmmimmoscout-items__message"> <?php echo Text::_('COM_VMMIMMOSCOUT_NO_REALESTATES'); ?>	 </p>
	<?php else : ?>

        <?php foreach ($this->items as $i => $item) : ?>
            <p>
                <a href="<?php echo Route::_(RouteHelper::getRealestateRoute($item->slug)); ?>">
                    <?php echo $item->title; ?>
                </a>
            </p>
        <?php endforeach; ?>

	<?php endif; ?>
</div>
