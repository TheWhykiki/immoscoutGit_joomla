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
    use Joomla\CMS\Router\Route;
    use VmmimmoscoutNamespace\Component\Vmmimmoscout\Site\Helper\RouteHelper;

    /** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
    $wa = $this->document->getWebAssetManager();
    $wa->useScript('com_vmmimmoscout.script');

    $menu   = Factory::getApplication()->getMenu()->getActive();
    $Itemid = $menu->id;



    foreach ($this->items as $item)
    {

        /*
        echo '<pre>';
        var_dump($item);
        echo '</pre>';
        */

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
