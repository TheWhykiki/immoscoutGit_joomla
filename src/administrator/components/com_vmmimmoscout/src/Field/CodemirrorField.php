<?php

//
    /**
     * @package      DigiNerds VMMImmoscout24 Package
     *
     * @author       Christian Schuelling <info@diginerds.de>
     * @copyright    2024 diginerds.de - All rights reserved.
     * @license      GNU General Public License version 3 or later
     */

    namespace VmmimmoscoutNamespace\Component\Vmmimmoscout\Administrator\Field;

    use Joomla\CMS\Editor\Button\ButtonInterface;
    use Joomla\CMS\Editor\Button\ButtonsRegistry;
    use Joomla\CMS\Editor\Editor;
    use Joomla\CMS\Factory;
    use Joomla\CMS\Form\Field\TextareaField;
    use Joomla\CMS\Layout\LayoutHelper;
    use Joomla\CMS\Plugin\PluginHelper;
    use Joomla\CMS\Uri\Uri;
    use Joomla\Registry\Registry;

// phpcs:disable PSR1.Files.SideEffects
    \defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

    /**
     * A textarea field for content creation
     *
     * @see    JEditor
     * @since  1.6
     */
    class CodemirrorField extends TextareaField
    {
        /**
         * The form field type.
         *
         * @var    string
         * @since  1.6
         */
        public $type = 'Codemirror';

        /**
         * The Editor object.
         *
         * @var    Editor
         * @since  1.6
         */
        protected $editor;

        /**
         * The height of the editor.
         *
         * @var    string
         * @since  3.2
         */
        protected $height;

        /**
         * The width of the editor.
         *
         * @var    string
         * @since  3.2
         */
        protected $width;

        /**
         * The assetField of the editor.
         *
         * @var    string
         * @since  3.2
         */
        protected $assetField;

        /**
         * The authorField of the editor.
         *
         * @var    string
         * @since  3.2
         */
        protected $authorField;

        /**
         * The asset of the editor.
         *
         * @var    string
         * @since  3.2
         */
        protected $asset;

        /**
         * The buttons of the editor.
         *
         * @var    mixed
         * @since  3.2
         */
        protected $buttons;

        /**
         * The hide of the editor.
         *
         * @var    string[]
         * @since  3.2
         */
        protected $hide;

        /**
         * The editorType of the editor.
         *
         * @var    string[]
         * @since  3.2
         */
        protected $editorType;

        /**
         * The parent class of the field
         *
         * @var  string
         * @since 4.0.0
         */
        protected $parentclass;

        /**
         * Name of the layout being used to render the field
         *
         * @var    string
         * @since  3.7
         */
        protected $layout = 'vmmimmoscout.form.field.codemirror';

        /**
         * Method to get certain otherwise inaccessible properties from the form field object.
         *
         * @param   string  $name  The property name for which to get the value.
         *
         * @return  mixed  The property value or null.
         *
         * @since   3.2
         */
        public function __get($name)
        {
            switch ($name)
            {
                case 'height':
                case 'width':
                case 'assetField':
                case 'authorField':
                case 'asset':
                case 'buttons':
                case 'hide':
                case 'editorType':
                    return $this->$name;
            }

            return parent::__get($name);
        }

        /**
         * Method to set certain otherwise inaccessible properties of the form field object.
         *
         * @param   string  $name   The property name for which to set the value.
         * @param   mixed   $value  The value of the property.
         *
         * @return  void
         *
         * @since   3.2
         */
        public function __set($name, $value)
        {
            switch ($name)
            {
                case 'height':
                case 'width':
                case 'assetField':
                case 'authorField':
                case 'asset':
                    $this->$name = (string) $value;
                    break;

                case 'buttons':
                    $value = (string) $value;

                    if ($value === 'true' || $value === 'yes' || $value === '1')
                    {
                        $this->buttons = true;
                    }
                    elseif ($value === 'false' || $value === 'no' || $value === '0')
                    {
                        $this->buttons = false;
                    }
                    else
                    {
                        $this->buttons = explode(',', $value);
                    }
                    break;

                case 'hide':
                    $value      = (string) $value;
                    $this->hide = $value ? explode(',', $value) : [];
                    break;

                case 'editorType':
                    // Can be in the form of: editor="desired|alternative".
                    $this->editorType = explode('|', trim((string) $value));
                    break;

                default:
                    parent::__set($name, $value);
            }
        }

        /**
         * Method to attach a Form object to the field.
         *
         * @param   \SimpleXMLElement  $element  The SimpleXMLElement object representing the `<field>` tag for the
         *                                       form field object.
         * @param   mixed              $value    The form field value to validate.
         * @param   string             $group    The field name group control value. This acts as an array container
         *                                       for the field. For example if the field has name="foo" and the group
         *                                       value is set to "bar" then the full field name would end up being
         *                                       "bar[foo]".
         *
         * @return  boolean  True on success.
         *
         * @see     FormField::setup()
         * @since   3.2
         */
        public function setup(\SimpleXMLElement $element, $value, $group = null)
        {
            $result = parent::setup($element, $value, $group);

            if ($result === true)
            {
                $this->height      = $this->element['height'] ? (string) $this->element['height'] : '500';
                $this->width       = $this->element['width'] ? (string) $this->element['width'] : '100%';
                $this->assetField  = $this->element['asset_field'] ? (string) $this->element['asset_field'] : 'asset_id';
                $this->authorField = $this->element['created_by_field'] ? (string) $this->element['created_by_field'] : 'created_by';
                $this->asset       = $this->form->getValue($this->assetField) ?: (string) $this->element['asset_id'];

                $buttons    = (string) $this->element['buttons'];
                $hide       = (string) $this->element['hide'];
                $editorType = (string) $this->element['editor'];

                if ($buttons === 'true' || $buttons === 'yes' || $buttons === '1')
                {
                    $this->buttons = true;
                }
                elseif ($buttons === 'false' || $buttons === 'no' || $buttons === '0')
                {
                    $this->buttons = false;
                }
                else
                {
                    $this->buttons = !empty($hide) ? explode(',', $buttons) : [];
                }

                $this->hide       = !empty($hide) ? explode(',', (string) $this->element['hide']) : [];
                $this->editorType = !empty($editorType) ? explode('|', trim($editorType)) : [];
            }

            return $result;
        }

        /**
         * Method to get the field input markup for the editor area
         *
         * @return  string  The field input markup.
         *
         * @since   1.6
         */
        protected function getInput()
        {

            // Laden Sie das Plugin
            PluginHelper::importPlugin('editors', 'codemirror');
            $plugin = PluginHelper::getPlugin('editors', 'codemirror');
            $pluginParams = new Registry($plugin->params);
            $this->params = $pluginParams;
            $pluginParamsArray = $pluginParams->toArray();

            $params = [];

            foreach ($pluginParamsArray as $key => $value) {
                $params[$key] = $value;
            }

            // Initialize variables based on the field attributes
            $buttons = $this->element['buttons'];
            $name = $this->name;
            $content = htmlspecialchars($this->value, ENT_COMPAT, 'UTF-8');
            $contentRaw = $this->value;
            $width = $this->width;
            $height = $this->height;
            $col = $this->columns;
            $row = $this->rows;
            $id = $this->id ?: $name; // Use the field name as ID if no ID is provided
            $asset = $this->asset;
            $author = $this->form->getValue($this->authorField);
            $readonly = $this->readonly || $this->disabled;
            $syntaxMode = (string) $this->element['mode'];
            $markLines = (string) $this->element['marklines'];


            // Prepare the options for the CodeMirror constructor
            $options = new \stdClass();
            $options->readOnly = $readonly;
            $options->width = is_numeric($width) ? $width . 'px' : $width;
            $options->height = is_numeric($height) ? $height . 'px' : $height;
            $options->lineNumbers = true;
            $options->foldGutter = true;
            $options->lineWrapping = true;
            $options->activeLine = true;
            $options->highlightSelection = true;
            $options->mode = $syntaxMode;
            $options->keyMap = 'default';
            $options->markText = '';

            if(!empty($markLines))
            {
                $markLinesJsonString = '(' . substr($markLines, 1,-1) . ')';
                $options->markText = $markLinesJsonString;
            }

            // Only add "px" to width and height if they are not given as a percentage.
            $options->width  = is_numeric($width) ? $width . 'px' : $width;
            $options->height = is_numeric($height) ? $height . 'px' : $height;

            $options->lineNumbers        = (bool) $this->params->get('lineNumbers', 1);
            $options->foldGutter         = (bool) $this->params->get('codeFolding', 1);
            $options->lineWrapping       = (bool) $this->params->get('lineWrapping', 1);
            $options->activeLine         = (bool) $this->params->get('activeLine', 1);
            $options->highlightSelection = (bool) $this->params->get('selectionMatches', 1);

            // Load the syntax mode.
            $modeAlias = [
                'scss' => 'css',
                'sass' => 'css',
                'less' => 'css',
            ];
            $options->mode = $syntaxMode;
            $options->mode = $modeAlias[$options->mode] ?? $options->mode;

            // Special options for non-tagged modes.
            if (!\in_array($options->mode, ['xml', 'html'])) {
                // Autogenerate closing brackets.
                $options->autoCloseBrackets = (bool) $this->params->get('autoCloseBrackets', 1);
            }

            // KeyMap settings.
            $options->keyMap = $this->params->get('keyMap', '');

            // Check for custom extensions
            $customExtensions          = $this->params->get('customExtensions', []);
            $options->customExtensions = [];

            if ($customExtensions) {
                foreach ($customExtensions as $item) {
                    $methods = array_filter(array_map('trim', explode(',', $item->methods ?? '')));

                    if (empty($item->module) || !$methods) {
                        continue;
                    }

                    // Prepend root path if we have a file
                    $module = str_ends_with($item->module, '.js') ? Uri::root(true) . '/' . $item->module : $item->module;

                    $options->customExtensions[] = [$module, $methods];
                }
            }

            $params['filePath'] = $this->element['filePath'];

            $displayData = [
                'options' => $options,
                'params'  => $params,
                'name'    => $name,
                'id'      => $id,
                'cols'    => $col,
                'rows'    => $row,
                'content' => $content,
            ];

            // Specify your custom layout path
            $customLayoutPath = JPATH_BASE . '/administrator/components/com_vmmimmoscout/layouts';

            // Render your custom layout for the editor
            return LayoutHelper::render('vmmimmoscout.form.field.codemirror', $displayData, $customLayoutPath);
        }


        /**
         * Method to get an Editor object based on the form field.
         *
         * @return  Editor  The Editor object.
         *
         * @since   1.6
         */
        protected function getEditor()
        {
            // Only create the editor if it is not already created.
            if (empty($this->editor))
            {
                $editor = null;

                if ($this->editorType)
                {
                    // Get the list of editor types.
                    $types = $this->editorType;

                    // Get the database object.
                    $db = $this->getDatabase();

                    // Build the query.
                    $query = $db->getQuery(true)
                        ->select($db->quoteName('element'))
                        ->from($db->quoteName('#__extensions'))
                        ->where(
                            [
                                $db->quoteName('element') . ' = :editor',
                                $db->quoteName('folder') . ' = ' . $db->quote('editors'),
                                $db->quoteName('enabled') . ' = 1',
                            ]
                        );

                    // Declare variable before binding.
                    $element = '';
                    $query->bind(':editor', $element);
                    $query->setLimit(1);

                    // Iterate over the types looking for an existing editor.
                    foreach ($types as $element)
                    {
                        // Check if the editor exists.
                        $db->setQuery($query);
                        $editor = $db->loadResult();

                        // If an editor was found stop looking.
                        if ($editor)
                        {
                            break;
                        }
                    }
                }

                // Create the JEditor instance based on the given editor.
                if ($editor === null)
                {
                    $editor = Factory::getApplication()->get('editor');
                }

                $this->editor = Editor::getInstance($editor);
            }

            return $this->editor;
        }

        /**
         * Load the editor buttons.
         *
         * @param   mixed   $buttons  Array with button names to be excluded. Empty array or boolean true to display all buttons.
         * @param   array   $options  Associative array with additional parameters
         *
         * @return  ButtonInterface[]
         * @throws \Exception
         *
         * @since   5.0.0
         */
        public function getButtons($buttons, array $options = []): array
        {
            if ($buttons === false) {
                return [];
            }

            $loadAll = false;

            if ($buttons === true || $buttons === []) {
                $buttons = [];
                $loadAll = true;
            }

            if (!\is_array($buttons)) {
                throw new \UnexpectedValueException('The Buttons variable should be an array of names of disabled buttons or boolean.');
            }

            // Retrieve buttons for current editor
            $result  = [];
            $btnsReg = new ButtonsRegistry();
            $btnsReg->setDispatcher($this->getDispatcher())->initRegistry([
                'editorType'      => $this->getName(),
                'disabledButtons' => $buttons,
                'editorId'        => $options['editorId'] ?? '',
                'asset'           => (int) ($options['asset'] ?? 0),
                'author'          => (int) ($options['author'] ?? 0),
            ]);

            // Go through all and leave only allowed buttons
            foreach ($btnsReg->getAll() as $button) {
                $btnName = $button->getButtonName();

                if (!$loadAll && \in_array($btnName, $buttons)) {
                    continue;
                }

                $result[] = $button;
            }

            return $result;
        }

        /**
         * Helper method for rendering the editor buttons.
         *
         * @param   mixed   $buttons  Array with button names to be excluded. Empty array or boolean true to display all buttons.
         * @param   array   $options  Associative array with additional parameters
         *
         * @return  string
         *
         * @since   5.0.0
         */
        protected function displayButtons($buttons, array $options = [])
        {
            $list = $this->getButtons($buttons, $options);

            return $list ? LayoutHelper::render('joomla.editors.buttons', $list) : '';
        }
    }
