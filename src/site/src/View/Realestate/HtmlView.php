<?php

    /**
     * @package         Joomla.Site
     * @subpackage      com_content
     *
     * @copyright   (C) 2006 Open Source Matters, Inc. <https://www.joomla.org>
     * @license         GNU General Public License version 2 or later; see LICENSE.txt
     */

    namespace VmmimmoscoutNamespace\Component\Vmmimmoscout\Site\View\Realestate;

    use Joomla\CMS\Factory;
    use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;

// phpcs:disable PSR1.Files.SideEffects
    \defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

    /**
     * HTML Article View class for the Content component
     *
     * @since  1.5
     */
    class HtmlView extends BaseHtmlView
    {
        /**
         * The article object
         *
         * @var  \stdClass
         */
        protected $item;

        /**
         * The page parameters
         *
         * @var    \Joomla\Registry\Registry|null
         *
         * @since  4.0.0
         */
        protected $params = null;

        /**
         * Should the print button be displayed or not?
         *
         * @var   boolean
         */
        protected $print = false;

        /**
         * The model state
         *
         * @var   \Joomla\CMS\Object\CMSObject
         */
        protected $state;

        /**
         * The user object
         *
         * @var   \Joomla\CMS\User\User|null
         */
        protected $user = null;

        /**
         * The page class suffix
         *
         * @var    string
         *
         * @since  4.0.0
         */
        protected $pageclass_sfx = '';

        /**
         * The flag to mark if the active menu item is linked to the being displayed article
         *
         * @var boolean
         */
        protected $menuItemMatchArticle = false;

        /**
         * Execute and display a template script.
         *
         * @param   string  $tpl  The name of the template file to parse; automatically searches through the template
         *                        paths.
         *
         * @return  void
         */
        public function display($tpl = null)
        {


            $app  = Factory::getApplication();
            $user = $this->getCurrentUser();
            $this->item  = $this->get('Item');




            parent::display($tpl);
        }


    }
