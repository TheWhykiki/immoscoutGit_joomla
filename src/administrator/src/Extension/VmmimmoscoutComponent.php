<?php
/**
 * @package      DigiNerds Immoscout24 Komponente
 *
 * @author       Christian Schuelling <info@diginerds.de>
 * @copyright    2024 diginerds.de - All rights reserved.
 * @license      GNU General Public License version 3 or later
 */
namespace VmmimmoscoutNamespace\Component\Vmmimmoscout\Administrator\Extension;

\defined('_JEXEC') or die;

use Joomla\CMS\Application\SiteApplication;
use Joomla\CMS\Association\AssociationServiceInterface;
use Joomla\CMS\Association\AssociationServiceTrait;
use Joomla\CMS\Categories\CategoryServiceInterface;
use Joomla\CMS\Categories\CategoryServiceTrait;
use Joomla\CMS\Component\Router\RouterServiceInterface;
use Joomla\CMS\Component\Router\RouterServiceTrait;
use Joomla\CMS\Extension\BootableExtensionInterface;
use Joomla\CMS\Extension\MVCComponent;
use Joomla\CMS\Factory;
use Joomla\CMS\Fields\FieldsServiceInterface;
use Joomla\CMS\Form\Form;
use Joomla\CMS\HTML\HTMLRegistryAwareTrait;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Tag\TagServiceInterface;
use Joomla\CMS\Tag\TagServiceTrait;
use VmmimmoscoutNamespace\Component\Vmmimmoscout\Administrator\Service\HTML\AdministratorService;
use VmmimmoscoutNamespace\Component\Vmmimmoscout\Administrator\Service\HTML\Icon;
use Psr\Container\ContainerInterface;

/**
 * Vmmimmoscout master display controller.
 *
 * @since  1.0.0
 */
class VmmimmoscoutComponent extends MVCComponent implements 
	BootableExtensionInterface, CategoryServiceInterface, FieldsServiceInterface, AssociationServiceInterface, RouterServiceInterface,
	TagServiceInterface
{
	use AssociationServiceTrait;
	use HTMLRegistryAwareTrait;
	use RouterServiceTrait;
	use CategoryServiceTrait, TagServiceTrait {
		CategoryServiceTrait::getTableNameForSection insteadof TagServiceTrait;
		CategoryServiceTrait::getStateColumnForSection insteadof TagServiceTrait;
	}

	/**
	 * Booting the extension. This is the function to set up the environment of the extension like
	 * registering new class loaders, etc.
	 *
	 * If required, some initial set up can be done from services of the container, eg.
	 * registering HTML services.
	 *
	 * @param   ContainerInterface  $container  The container
	 *
	 * @return  void
	 *
	 * @since   1.0.0
	 */
	public function boot(ContainerInterface $container)
	{
		$this->getRegistry()->register('vmmimmoscoutadministrator', new AdministratorService);
        $this->getRegistry()->register('vmmimmoscouticon', new Icon($container->get(SiteApplication::class)));
	}

    /**
	 * Returns a valid section for the given section. If it is not valid then null
	 * is returned.
	 *
	 * @param   string  $section  The section to get the mapping for
	 * @param   object  $item     The item
	 *
	 * @return  string|null  The new section
	 *
	 * @since   4.0.0
	 */
	public function validateSection($section, $item = null)
	{
		if ($section != 'realestate')
		{
			// We don't know other sections
			return null;
		}

		return $section;
	}

	/**
	 * Returns valid contexts
	 *
	 * @return  array
	 *
	 * @since   4.0.0
	 */
	public function getContexts(): array
	{
		Factory::getLanguage()->load('com_vmmimmoscout', JPATH_ADMINISTRATOR);

		$contexts = array(
			'com_vmmimmoscout.realestate'    => Text::_('COM_VMMIMMOSCOUT'),
            'com_vmmimmoscout.categories' => Text::_('JCATEGORY')
		);

		return $contexts;
	}


	/**
	 * Returns the table for the count items functions for the given section.
	 *
	 * @param   string  $section  The section
	 *
	 * @return  string|null
	 *
	 * @since   4.0.0
	 */
	protected function getTableNameForSection(string $section = null)
	{
		return ($section === 'category' ? 'categories' : 'vmmimmoscout_realestates');
	}

	/**
	 * Returns the state column for the count items functions for the given section.
	 *
	 * @param   string  $section  The section
	 *
	 * @return  string|null
	 *
	 * @since   4.0.0
	 */
	protected function getStateColumnForSection(string $section = null)
	{
		return 'published';
	}
}
