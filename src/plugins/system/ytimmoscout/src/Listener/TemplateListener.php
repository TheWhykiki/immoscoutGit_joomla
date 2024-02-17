<?php
    namespace Joomla\Plugin\System\Ytimmoscout\Listener;


use Joomla\CMS\Document\Document;

class TemplateListener
{

    public string $language;

    public function __construct(?Document $document)
    {
        $this->language = $document->language ?? 'en-gb';
    }
    public static function matchTemplate($view, $tpl)
    {
        $layout = $view->getLayout();
        $context = $view->get('context');

        // match context and layout from view object

        if ($context === 'com_vmmimmoscout.realestate' && $layout === 'default' && !$tpl) {

            // return type, query and parameters of the matching view
            return [
                'type' => $context,
                'params' => ['item' => $view->get('realestate')],
            ];
        }

        // match context and layout from view object
        if ($context === 'com_vmmimmoscout.realestates' && $layout === 'default' && !$tpl) {

            // return type, query and parameters of the matching view
            return [
                'type' => $context,
                'params' => ['item' => $view->get('realestates')],
            ];
        }
    }
}
