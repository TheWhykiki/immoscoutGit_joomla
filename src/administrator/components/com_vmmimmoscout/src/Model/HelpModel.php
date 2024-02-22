<?php
//

    /**
     * @package      DigiNerds VMMImmoscout24 Package
     *
     * @author       Christian Schuelling <info@diginerds.de>
     * @copyright    2024 diginerds.de - All rights reserved.
     * @license      GNU General Public License version 3 or later
     */

    namespace VmmimmoscoutNamespace\Component\Vmmimmoscout\Administrator\Model;

    \defined('_JEXEC') or die;

    use Joomla\CMS\MVC\Model\FormModel;


    /**
     *fourtexx
     *
     * @package   com_fourtexx
     * @since     1.0.0
     */
    class HelpModel extends FormModel
    {

        /**
         * Method to get the record form.
         *
         * @param   array    $data      Data for the form.
         * @param   boolean  $loadData  True if the form is to load its own data (default case), false if not.
         *
         * @return  mixed    A JForm object on success, false on failure
         *
         * @since   1.0
         */
        public function getForm($data = [], $loadData = \true)
        {
            // Get the form.
            $form = $this->loadForm('com_vmmimmoscout.help', 'help', ['control' => 'jform', 'load_data' => $loadData]);
            if (empty($form))
            {
                return \false;
            }

            return $form;
        }

        /**
         * Method to generate the form XML for the help view.
         *
         * @param   string   $fieldName    Field name
         * @param   array    $attributes   Array of attributes for the field
         * @param   boolean  $codeContent  Content data from a specific file
         *
         * @return  mixed    A JForm object on success, false on failure
         *
         * @since   1.0
         */
        public function generateHelpFormXML($editorFields)
        {
            $loadData = false;
            $form     = $this->loadForm('com_vmmimmoscout.help', 'help', ['control' => 'jform', 'load_data' => $loadData]);

            if (empty($form))
            {
                return false;
            }

            // Erstellen Sie ein neues SimpleXMLElement aus der Formular-XML
            $formXml = new \SimpleXMLElement($form->getXml()->asXML());

            // Verarbeiten Sie jedes Editor-Feld
            foreach ($editorFields as $fieldName => $fieldInfo)
            {
                // Lese den Inhalt der Datei, wenn vorhanden
                $codeContent = file_exists($fieldInfo['filePath']) ? file_get_contents($fieldInfo['filePath']) : '';

                // Aktualisieren Sie das Formular-XML
                $this->_updateFormXML($formXml, $fieldName, $codeContent, $fieldInfo['attributes'], $fieldInfo['filePath']);
            }


            // Laden Sie das aktualisierte XML in das Formular
            $form->load($formXml->asXML());

            return $form;
        }

        /**
         * Method to update the form XML structure with new editor fields.
         *
         * @param   SimpleXMLElement  &$formXml      The form XML object.
         * @param   string             $fieldName    The name of the field to add/update.
         * @param   string             $codeContent  String with content of the file
         * @param   array              $attributes   Array of custo attributes for the field
         * @param   string             $filePath     The path to the file
         *
         * @return  void
         */
        protected function _updateFormXML(&$formXml, $fieldName, $codeContent, $attributes, $filePath)
        {
            $standardFieldParams = [
                'name'        => $fieldName,
                'type'        => 'codemirror',
                'description' => $fieldName,
                'buttons'     => 'false',
                'width'       => '100%',
                'height'      => '500px',
                'filter'      => 'raw',
                'editor'      => 'codemirror',
                'set'         => 'Custom',
                'layout'      => 'vmmimmoscout.form.field.codemirror',
                'readonly'    => 'true',
                'hiddenLabel' => 'true',
                'filePath'    => $filePath
            ];

            // Create a new field element if it does not yet exist
            $found = false;
            foreach ($formXml->fieldset as $fieldset)
            {
                foreach ($fieldset->field as $field)
                {
                    if ((string) $field['name'] === $fieldName)
                    {
                        $found = true;
                        break;
                    }
                }
                if ($found) break;
            }

            if (!$found)
            {
                $field = $fieldset->addChild('field');
                foreach ($standardFieldParams as $key => $value)
                {
                    if (!isset($field[$key])) {
                        $field->addAttribute($key, $value);
                    }
                }

                foreach ($attributes as $key => $value)
                {
                    if (!isset($field[$key])) {
                        if(is_array($value))
                        {
                            $value = json_encode($value);
                        }
                        $field->addAttribute($key, $value);
                    }
                }
            }

            // Add or update the default value
            if (!isset($field->default))
            {
                $defaultNode = $field->addChild('default');
            }
            else
            {
                $defaultNode = $field->default;
            }

            // Add CDATA to support HTML/JS content
            $node = dom_import_simplexml($defaultNode);
            $no   = $node->ownerDocument;
            $node->appendChild($no->createCDATASection($codeContent));
        }

        /**
         * Method to get a control group with label and input.
         *
         * @param   string  $name     The name of the field for which to get the value.
         * @param   string  $group    The optional dot-separated form group path on which to get the value.
         * @param   mixed   $default  The optional default value of the field value is empty.
         * @param   array   $options  Any options to be passed into the rendering of the field
         *
         * @return  string  A string containing the html for the control group
         *
         * @since   3.2.3
         */
        public function renderField($name, $group = null, $default = null, $options = [])
        {
            $field = $this->getField($name, $group, $default);

            if ($field)
            {
                return $field->renderField($options);
            }

            return '';
        }

    }
