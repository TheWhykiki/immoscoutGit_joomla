<?php
/**
 * @package     Joomla.Administrator 
 * @subpackage  com_vmmimmoscout
 *
 * @copyright   Copyright (C) 2024 Whykiki. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

\defined('_JEXEC') or die;

use Joomla\CMS\Association\AssociationExtensionInterface;
use Joomla\CMS\Categories\CategoryFactoryInterface;
use Joomla\CMS\Component\Router\RouterFactoryInterface;
use Joomla\CMS\Dispatcher\ComponentDispatcherFactoryInterface;
use Joomla\CMS\Extension\ComponentInterface;
use Joomla\CMS\Extension\Service\Provider\CategoryFactory;
use Joomla\CMS\Extension\Service\Provider\ComponentDispatcherFactory;
use Joomla\CMS\Extension\Service\Provider\MVCFactory;
use Joomla\CMS\Extension\Service\Provider\RouterFactory;
use Joomla\CMS\HTML\Registry;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\Component\Contact\Administrator\Helper\AssociationsHelper;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;

use VmmimmoscoutNamespace\Component\Vmmimmoscout\Administrator\Extension\VmmimmoscoutComponent;


/**
 * The vmmimmoscout service provider.
 *
 * @since  1.0.0
 */
return new class implements ServiceProviderInterface
{
	/**
	 * Registers the service provider with a DI container.
	 *
	 * @param   Container  $container  The DI container.
	 *
	 * @return  void
	 *
	 * @since   1.0.0
	 */
	public function register(Container $container)
	{
        $container->set(AssociationExtensionInterface::class, new AssociationsHelper());
    
		$container->registerServiceProvider(new CategoryFactory('\\VmmimmoscoutNamespace\\Component\\Vmmimmoscout'));
		$container->registerServiceProvider(new MVCFactory('\\VmmimmoscoutNamespace\\Component\\Vmmimmoscout'));
		$container->registerServiceProvider(new ComponentDispatcherFactory('\\VmmimmoscoutNamespace\\Component\\Vmmimmoscout'));
        $container->registerServiceProvider(new RouterFactory('\\VmmimmoscoutNamespace\\Component\\Vmmimmoscout'));

		$container->set(
			ComponentInterface::class,
			function (Container $container)
            {
				$component = new VmmimmoscoutComponent($container->get(ComponentDispatcherFactoryInterface::class));
                
				$component->setRegistry($container->get(Registry::class));
				$component->setMVCFactory($container->get(MVCFactoryInterface::class));
				$component->setCategoryFactory($container->get(CategoryFactoryInterface::class));
                $component->setAssociationExtension($container->get(AssociationExtensionInterface::class));
				$component->setRouterFactory($container->get(RouterFactoryInterface::class));
                
				return $component;
			}
		);
	}
};
