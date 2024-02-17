<?php
    /**
     * @package     Joomla.Site
     * @subpackage  com_vmmimmoscout
     *
     * @copyright   Copyright (C) 2024 Whykiki. All rights reserved.
     * @license     GNU General Public License version 2 or later; see LICENSE.txt
     */

    \defined('_JEXEC') or die;

    use Joomla\CMS\Factory;
    use Joomla\CMS\Router\Route;
    use VmmimmoscoutNamespace\Component\Vmmimmoscout\Site\Helper\RouteHelper;

    /** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
    $wa = $this->document->getWebAssetManager();
    $wa->useScript('com_vmmimmoscout.script');

    $menu   = Factory::getApplication()->getMenu()->getActive();
    $Itemid = $menu->id;

    echo '<pre>';
    // var_dump($this->items);
    echo '</pre>';

    foreach ($this->items as $item)
    {

        $route = RouteHelper::getRealestateRoute($item->{'@id'});
        $url    = Route::_('index.php?option=com_vmmimmoscout&view=realestate&realestateID=' . (int) $item->{'@id'}. '&Itemid=' . $Itemid);
        echo '<h2><a href="' . $url . '">' . $item->title . '</a></h2>';
        echo $route;
        echo $url;
        echo '<p>' . $item->{'@id'} . '</p>';

    }

?>
<div class="com-content-category-blog__navigation w-100">
        <p class="com-content-category-blog__counter counter float-md-end pt-3 pe-2">
            <?php echo $this->pagination->getPagesCounter(); ?>
        </p>
    <div class="com-content-category-blog__pagination">
        <?php echo $this->pagination->getPagesLinks(); ?>
    </div>
</div>
