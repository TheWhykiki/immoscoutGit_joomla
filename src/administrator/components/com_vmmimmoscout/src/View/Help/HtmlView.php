<?php
//
    /**
     * @package      DigiNerds VMMImmoscout24 Package
     *
     * @author       Christian Schuelling <info@diginerds.de>
     * @copyright    2024 diginerds.de - All rights reserved.
     * @license      GNU General Public License version 3 or later
     */

    namespace VmmimmoscoutNamespace\Component\Vmmimmoscout\Administrator\View\Help;

    \defined('_JEXEC') or die;

    use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
    use Joomla\CMS\Factory;
    use Joomla\CMS\HTML\HTMLHelper;
    use Joomla\CMS\Language\Text;


    /**
     * View class for a list of dashboard.
     *
     * @package  KickGDPR
     *
     * @since    1.6
     */
    class HtmlView extends BaseHtmlView
    {
        /**
         * The JForm object
         *
         * @var  JForm
         */
        protected $form;

        /**
         * The Result in a Object from Database
         *
         * @var    object
         */
        protected $statistic;
        /**
         *fourtexx helper
         *
         * @var   fourtexxHelper
         * @since  1.0.0
         */
        protected $helper;
        /**
         * The sidebar to show
         *
         * @var    string
         * @since  1.0.0
         */
        protected $sidebar = '';

        /**
         * Display the view
         *
         * @param   string  $tpl  The name of the template file to parse; automatically searches through the template
         *                        paths.
         *
         * @return  mixed  A string if successful, otherwise a Error object.
         */
        public function display($tpl = \null)
        {
            //$this->statistic = $this->get('Statistic');
            $this->form    = $this->get('Form');
            $this->sidebar = HTMLHelper::_('sidebar.render');
            $this->toolbar();
            parent::display($tpl);
        }

        /**
         * Displays a toolbar for a specific page.
         *
         * @return  void
         *
         * @since   1.0.0
         */
        private function toolbar()
        {
            \Joomla\CMS\Toolbar\ToolbarHelper::title(Text::_('COM_VMMIMMOSCOUT') . ': ' . Text::_('COM_VMMIMMOSCOUT_HELP'), 'dashboard');
            // Options button.
            if (Factory::getUser()->authorise('core.admin', 'com_vmmimmoscout'))
            {
                \Joomla\CMS\Toolbar\ToolbarHelper::preferences('com_vmmimmoscout');
            }
        }

    }
