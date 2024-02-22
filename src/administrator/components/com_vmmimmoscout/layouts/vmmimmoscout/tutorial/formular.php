<?php

    /**
     * @package      DigiNerds VMMImmoscout24 Package
     *
     * @author       Christian Schuelling <info@diginerds.de>
     * @copyright    2024 diginerds.de - All rights reserved.
     * @license      GNU General Public License version 3 or later
     */

    use Joomla\CMS\Factory;
    use Joomla\CMS\Language\Text;
    use VmmimmoscoutNamespace\Component\Vmmimmoscout\Administrator\Helper\VmmimmoscoutHelper as Helper;

    $filePath1      = '/plugins/system/ytimmoscout/element/form_immo/element.json';
    $filePath2      = '/plugins/system/ytimmoscout/element/form_immo/element.json';
    $editor2Content = str_replace('form_immo', 'form_immo_custom', Helper::checkFile($filePath2, true));
    $editor2Content = str_replace('Formular Immobilienanfrage', 'Formular Immobilienanfrage (Custom)', $editor2Content);

    $editorFields = [
        'editor1' => [
            'attributes' => [
                'label'   => basename($filePath1),

                'default' => Helper::checkFile($filePath1, true)
            ],
            'filePath'   => $filePath1
        ],
        'editor2' => [
            'attributes' => [
                'label'     => basename($filePath2),
                'mode'      => '',
                'default'   => $editor2Content,
                'marklines' => [
                    ['line' => 3, 'ch' => 0],
                    ['line' => 4, 'ch' => 0],
                    ['line' => 7, 'ch' => 0],
                    ['readOnly' => true],
                ],
            ],
            'filePath'   => $filePath2,
        ],
    ];

    // Get the FieldsModelField, we need it in a sec
    $app        = Factory::getApplication();
    $mvcFactory = $app->bootComponent('com_vmmimmoscout')->getMVCFactory();

    /** @var \VmmimmoscoutNamespace\Component\Vmmimmoscout\Administrator\Model\HelpModel $helpModel */
    $helpModel = $mvcFactory->createModel('Help', 'Administrator', ['ignore_request' => true]);
    $form      = $helpModel->generateHelpFormXML($editorFields);

?>
<style>
    .marked-line {
        background-color: #d2ffff; /* Oder jede andere gewünschte Stilisierung */
    }

</style>
<div class="accordion-item">
    <h2 class="accordion-header" id="headingTutorialForm">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseTutorialForm" aria-expanded="false"
                aria-controls="collapseTutorialForm">
            <?php echo Text::_('COM_VMMIMMOSCOUT_HELP_FAQ_TUTORIAL_FORM_HEADER'); ?>
        </button>
    </h2>
    <div id="collapseTutorialForm" class="accordion-collapse collapse"
         aria-labelledby="headingTutorialForm" data-bs-parent="#faqAccordion">
        <div class="accordion-body">
            <p><?php echo Text::_('COM_VMMIMMOSCOUT_HELP_FAQ_TUTORIAL_FORM_INTRO'); ?></p>
            <p><?php echo Text::_('COM_VMMIMMOSCOUT_HELP_FAQ_TUTORIAL_FORM_STEP1'); ?></p>
            <p><?php echo Text::_('COM_VMMIMMOSCOUT_HELP_FAQ_TUTORIAL_FORM_STEP2_1'); ?></p>

            <?php
                echo $form->renderField('editor1');
            ?>

            <p><?php echo Text::_('COM_VMMIMMOSCOUT_HELP_FAQ_TUTORIAL_FORM_STEP2_2'); ?></p>

            <?php
                $markLines = $editorFields['editor2']['attributes']['marklines'];
                if(!empty($markLines))
                {
                    $markLines = substr(json_encode($markLines), 1,-1);
                }
            ?>

            <script type="module">
                import { JoomlaEditor } from 'editor-api';
                import { markLinesInEditor, markLines } from '/media/com_vmmimmoscout/js/codemirror/codemirror_immo.js';

                document.addEventListener('DOMContentLoaded', function() {
                    console.log('[default.php] DOMContentLoaded event fired.');

                    const editor1 = JoomlaEditor.get('textarea_jform_editor1');
                    const editor2 = JoomlaEditor.get('textarea_jform_editor2');

                    if (editor1) {
                        console.log('[default.php] Found editor1, marking lines...');
                        markLinesInEditor(editor1, [2, 3, 6]);
                    } else {
                        console.log('[default.php] Unable to find editor1.');
                    }

                    if (editor2) {
                        console.log('[default.php] Found editor2, marking lines...');
                        markLinesInEditor(editor2, [1, 4, 5]);
                    } else {
                        console.log('[default.php] Unable to find editor2.');
                    }
                });
            </script>



            <?php
                echo $form->renderField('editor2');
            ?>

            <p><?php echo Text::_('COM_VMMIMMOSCOUT_HELP_FAQ_TUTORIAL_FORM_STEP3'); ?></p>

        </div>
    </div>
</div>
