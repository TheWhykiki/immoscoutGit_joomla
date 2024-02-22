<?php
    /**
     * @package      DigiNerds VMMImmoscout24 Package
     *
     * @author       Christian Schuelling <info@diginerds.de>
     * @copyright    2024 diginerds.de - All rights reserved.
     * @license      GNU General Public License version 3 or later
     */


    defined('_JEXEC') or die;

    use Joomla\CMS\Language\Text;
    use Joomla\CMS\Layout\LayoutHelper;

?>

<div class="container-fluid">

    <!-- #########  ######### -->
    <!-- Einleitungskasten -->
    <!-- #########  ######### -->

    <div class="card mb-3">
        <div class="card-header">
            <h2><?php echo Text::_('COM_VMMIMMOSCOUT_HELP_INTRO_TITLE'); ?></h2>
        </div>
        <div class="card-body">
            <p class="card-text"><?php echo Text::_('COM_VMMIMMOSCOUT_HELP_INTRO_DESCRIPTION'); ?></p>
            <p class="card-text"><?php echo Text::_('COM_VMMIMMOSCOUT_HELP_INTRO_ADDITIONAL_INFO'); ?></p>
            <ul>
                <li><?php echo Text::_('COM_VMMIMMOSCOUT_HELP_COMPONENT'); ?></li>
                <li><?php echo Text::_('COM_VMMIMMOSCOUT_HELP_PLUGIN_YT'); ?></li>
                <li><?php echo Text::_('COM_VMMIMMOSCOUT_HELP_PLUGIN_JTF'); ?></li>
                <li><?php echo Text::_('COM_VMMIMMOSCOUT_HELP_THEME_YOOTHEME'); ?></li>
            </ul>
        </div>
    </div>

    <!-- #########  ######### -->
    <!-- Grundlagen & Einstellungen -->
    <!-- #########  ######### -->

    <div class="card mb-3">
        <div class="card-header">
            <h2><?php echo Text::_('COM_VMMIMMOSCOUT_HELP_BASIC_SETTINGS_HEADER'); ?></h2>
        </div>
        <div class="card-body">
            <p class="card-text"><?php echo Text::_('COM_VMMIMMOSCOUT_HELP_BASIC_SETTINGS_INTRO'); ?></p>

            <!-- Step1: OAuth -->
            <div class="accordion" id="basicSettingsAccordion">
                <!-- OAuth-Prozess -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOAuth">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOAuth" aria-expanded="true" aria-controls="collapseOAuth">
                            <?php echo Text::_('COM_VMMIMMOSCOUT_HELP_OAUTH_PROCESS'); ?>
                        </button>
                    </h2>
                    <div id="collapseOAuth" class="accordion-collapse collapse show" aria-labelledby="headingOAuth"
                         data-bs-parent="#basicSettingsAccordion">
                        <div class="accordion-body">
                            <?php echo Text::_('COM_VMMIMMOSCOUT_HELP_OAUTH_PROCESS_DESC'); ?>
                            <ul>
                                <li><a href="https://api.immobilienscout24.de/api-docs/authentication/introduction/"
                                       target="_blank"><?php echo Text::_('COM_VMMIMMOSCOUT_HELP_OAUTH_PROCESS_LINK1'); ?></a>/li>
                                <li><a href="https://api.immobilienscout24.de/api-docs/postman/postman-collections/"
                                       target="_blank"><?php echo Text::_('COM_VMMIMMOSCOUT_HELP_OAUTH_PROCESS_LINK2'); ?></a>
                                </li>
                                <li><a href="https://www.youtube.com/watch?v=ktaWy7_Lsuc"
                                       target="_blank"><?php echo Text::_('COM_VMMIMMOSCOUT_HELP_OAUTH_PROCESS_VIDEO'); ?></a>
                                </li>
                            </ul>
                            <h5><?php echo Text::_('COM_VMMIMMOSCOUT_HELP_OAUTH_PROCESS_VIDEO_POSTMAN'); ?></h5>

                            <iframe width="560" height="315"
                                    src="https://www.youtube.com/embed/ktaWy7_Lsuc?si=he1_uf81sBz92IeY"
                                    title="YouTube video player" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    allowfullscreen></iframe>
                        </div>
                    </div>
                </div>

                <!-- Step 2: Zugangsdaten speichern -->

                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingSaveCredentials">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseSaveCredentials" aria-expanded="false"
                                aria-controls="collapseSaveCredentials">
                            <?php echo Text::_('COM_VMMIMMOSCOUT_HELP_SAVE_CREDENTIALS'); ?>
                        </button>
                    </h2>
                    <div id="collapseSaveCredentials" class="accordion-collapse collapse"
                         aria-labelledby="headingSaveCredentials" data-bs-parent="#basicSettingsAccordion">
                        <div class="accordion-body">
                            <?php echo Text::_('COM_VMMIMMOSCOUT_HELP_SAVE_CREDENTIALS_DESC'); ?>
                            <img src="/media/com_vmmimmoscout/images/helpImages/ConsumerKey.png"
                                 alt="Consumer Key class=" img-fluid">
                        </div>
                    </div>
                </div>

                <!-- Step 3: Menüpunkt Realestate List und Yootheme Template speichern -->

                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingCheckConnection">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseCheckConnection" aria-expanded="false"
                                aria-controls="collapseCheckConnection">
                            <?php echo Text::_('COM_VMMIMMOSCOUT_HELP_CHECK_CONNECTION_HEADER'); ?>
                        </button>
                    </h2>
                    <div id="collapseCheckConnection" class="accordion-collapse collapse"
                         aria-labelledby="headingCheckConnection" data-bs-parent="#basicSettingsAccordion">
                        <div class="accordion-body">
                            <p><?php echo Text::_('COM_VMMIMMOSCOUT_HELP_CHECK_CONNECTION_INTRO'); ?></p>
                            <img src="/media/com_vmmimmoscout/images/helpImages/menu_item_creation.png"
                                 class="img-fluid mb-3"
                                 alt="<?php echo Text::_('COM_VMMIMMOSCOUT_HELP_CHECK_CONNECTION_MENU_ITEM_ALT'); ?>">
                            <p><?php echo Text::_('COM_VMMIMMOSCOUT_HELP_CHECK_CONNECTION_LIST_LAYOUT'); ?></p>
                            <img src="/media/com_vmmimmoscout/images/helpImages/list_layout_setting.png"
                                 class="img-fluid mb-3"
                                 alt="<?php echo Text::_('COM_VMMIMMOSCOUT_HELP_CHECK_CONNECTION_LIST_LAYOUT_ALT'); ?>">
                            <p><?php echo Text::_('COM_VMMIMMOSCOUT_HELP_CHECK_CONNECTION_FRONTEND'); ?></p>
                            <h3><?php echo Text::_('COM_VMMIMMOSCOUT_HELP_CHECK_CONNECTION_YOOTHEME_HEADER'); ?></h3>
                            <p><?php echo Text::_('COM_VMMIMMOSCOUT_HELP_CHECK_CONNECTION_YOOTHEME_CONTENT'); ?></p>
                            <img src="/media/com_vmmimmoscout/images/helpImages/yootheme_template_creation.png"
                                 class="img-fluid mb-3"
                                 alt="<?php echo Text::_('COM_VMMIMMOSCOUT_HELP_CHECK_CONNECTION_YOOTHEME_TEMPLATE_ALT'); ?>">
                            <p><?php echo Text::_('COM_VMMIMMOSCOUT_HELP_CHECK_CONNECTION_YOOTHEME_TRIGGER'); ?></p>
                            <img src="/media/com_vmmimmoscout/images/helpImages/yootheme_trigger.png"
                                 class="img-fluid mb-3"
                                 alt="<?php echo Text::_('COM_VMMIMMOSCOUT_HELP_CHECK_CONNECTION_YOOTHEME_TRIGGER_ALT'); ?>">
                            <p><?php echo Text::_('COM_VMMIMMOSCOUT_HELP_CHECK_CONNECTION_YOOTHEME_LAYOUT'); ?></p>
                            <iframe width="560" height="315" src="https://www.youtube.com/embed/VIDEO_ID"
                                    title="<?php echo Text::_('COM_VMMIMMOSCOUT_HELP_CHECK_CONNECTION_YOOTHEME_VIDEO_TITLE'); ?>"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                            <p><?php echo Text::_('COM_VMMIMMOSCOUT_HELP_CHECK_DYNAMIC_CONTENT_INTRO'); ?></p>
                            <img src="/media/com_vmmimmoscout/images/helpImages/dynamic_content_example.png"
                                 class="img-fluid mb-3"
                                 alt="<?php echo Text::_('COM_VMMIMMOSCOUT_HELP_CHECK_DYNAMIC_CONTENT_ALT'); ?>">
                            <p><?php echo Text::_('COM_VMMIMMOSCOUT_HELP_CHECK_DYNAMIC_CONTENT_EXPLANATION'); ?></p>
                            <a href="https://api.immobilienscout24.de/api-docs/import-export/real-estate/retrieve-all-real-estates/#query-parameters"
                               target="_blank"><?php echo Text::_('COM_VMMIMMOSCOUT_HELP_CHECK_API_LINK'); ?></a>
                            <p><?php echo Text::_('COM_VMMIMMOSCOUT_HELP_CHECK_CONTACT_INFO'); ?></p>


                        </div>
                    </div>
                </div>

                <!--Step 4: Einzelnes Realestate -->

                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingSingleExpose">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseSingleExpose" aria-expanded="false"
                                aria-controls="collapseSingleExpose">
                            <?php echo Text::_('COM_VMMIMMOSCOUT_HELP_CHECK_SINGLE_EXPOSE_HEADER'); ?>
                        </button>
                    </h2>
                    <div id="collapseSingleExpose" class="accordion-collapse collapse"
                         aria-labelledby="headingSingleExpose" data-bs-parent="#basicSettingsAccordion">
                        <div class="accordion-body">
                            <p><?php echo Text::_('COM_VMMIMMOSCOUT_HELP_CHECK_SINGLE_EXPOSE_INTRO'); ?></p>
                            <p><?php echo Text::_('COM_VMMIMMOSCOUT_HELP_CHECK_SINGLE_EXPOSE_LISTING_NOTE'); ?></p>
                            <p><?php echo Text::_('COM_VMMIMMOSCOUT_HELP_CHECK_SINGLE_EXPOSE_BUILDER_INSTRUCTION'); ?></p>
                            <img src="/media/com_vmmimmoscout/images/helpImages/single_template_creation.png"
                                 class="img-fluid mb-3"
                                 alt="<?php echo Text::_('COM_VMMIMMOSCOUT_HELP_CHECK_SINGLE_EXPOSE_TEMPLATE_ALT'); ?>">
                            <p><?php echo Text::_('COM_VMMIMMOSCOUT_HELP_CHECK_SINGLE_EXPOSE_TEMPLATE_NOTICE'); ?></p>
                            <p><?php echo Text::_('COM_VMMIMMOSCOUT_HELP_CHECK_DYNAMIC_CONTENT_EXPLANATION'); ?></p>
                        </div>
                    </div>
                </div>


                <!-- Step 5: Child Theme -->

                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingChildTheme">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseChildTheme" aria-expanded="false"
                                aria-controls="collapseChildTheme">
                            <?php echo Text::_('COM_VMMIMMOSCOUT_HELP_CHILDTHEME_HEADER'); ?>
                        </button>
                    </h2>
                    <div id="collapseChildTheme" class="accordion-collapse collapse" aria-labelledby="headingChildTheme"
                         data-bs-parent="#basicSettingsAccordion">
                        <div class="accordion-body">
                            <p><?php echo Text::_('COM_VMMIMMOSCOUT_HELP_CHILDTHEME_INTRO'); ?></p>
                            <p><?php echo Text::_('COM_VMMIMMOSCOUT_HELP_CHILDTHEME_INSTRUCTION'); ?></p>
                            <p><?php echo Text::_('COM_VMMIMMOSCOUT_HELP_CHILDTHEME_OWN_USAGE'); ?></p>
                            <video width="100%" controls>
                                <source src="/media/com_vmmimmoscout/images/helpImages/videos/choose_child_theme.mp4"
                                        type="video/mp4">
                                <?php echo Text::_('COM_VMMIMMOSCOUT_HELP_CHILDTHEME_VIDEO_NOT_SUPPORTED'); ?>
                            </video>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- #########  ######### -->
    <!-- FAQ & Infos -->
    <!-- #########  ######### -->

    <div class="card mb-3">
        <div class="card-header">
            <h2><?php echo Text::_('COM_VMMIMMOSCOUT_HELP_FAQ_HEADER'); ?></h2>
        </div>
        <div class="card-body">
            <!-- Accordion -->
            <div class="accordion" id="faqAccordion">

                <!-- Weiterentwicklung / kommende Features -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingDevelopment">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseDevelopment" aria-expanded="true"
                                aria-controls="collapseDevelopment">
                            <?php echo Text::_('COM_VMMIMMOSCOUT_HELP_FAQ_DEVELOPMENT_HEADER'); ?>
                        </button>
                    </h2>
                    <div id="collapseDevelopment" class="accordion-collapse collapse show"
                         aria-labelledby="headingDevelopment" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            <p><?php echo Text::_('COM_VMMIMMOSCOUT_HELP_FAQ_DEVELOPMENT_CONTENT'); ?></p>
                        </div>
                    </div>
                </div>

                <!-- Formularinformationen -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFormInfo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseFormInfo" aria-expanded="false"
                                aria-controls="collapseFormInfo">
                            <?php echo Text::_('COM_VMMIMMOSCOUT_HELP_FAQ_FORM_INFO_HEADER'); ?>
                        </button>
                    </h2>
                    <div id="collapseFormInfo" class="accordion-collapse collapse" aria-labelledby="headingFormInfo"
                         data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            <p><?php echo Text::_('COM_VMMIMMOSCOUT_HELP_FAQ_FORM_INFO_JTF'); ?></p>
                            <h5><?php echo Text::_('COM_VMMIMMOSCOUT_HELP_FAQ_FORM_INFO_JTF_XML_HEADER'); ?></h5>
                            <p><?php echo Text::_('COM_VMMIMMOSCOUT_HELP_FAQ_FORM_INFO_JTF_XML_CONTENT'); ?></p>
                            <h5><?php echo Text::_('COM_VMMIMMOSCOUT_HELP_FAQ_FORM_INFO_YOOTHEME_ELEMENT_HEADER'); ?></h5>
                            <p><?php echo Text::_('COM_VMMIMMOSCOUT_HELP_FAQ_FORM_INFO_YOOTHEME_ELEMENT_CONTENT'); ?></p>
                        </div>
                    </div>
                </div>

                <!-- Formular Tutorial -->

                <?php echo LayoutHelper::render('vmmimmoscout.tutorial.formular', $this); ?>


            </div>
        </div>
    </div>


</div>
