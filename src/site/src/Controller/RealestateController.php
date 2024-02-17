<?php
/**
 * @package      DigiNerds Immoscout24 Komponente
 *
 * @author       Christian Schuelling <info@diginerds.de>
 * @copyright    2024 diginerds.de - All rights reserved.
 * @license      GNU General Public License version 3 or later
 */

namespace VmmimmoscoutNamespace\Component\Vmmimmoscout\Site\Controller;

\defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Controller\FormController;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Uri\Uri;
use Joomla\Utilities\ArrayHelper;
use VmmimmoscoutNamespace\Component\Vmmimmoscout\Site\Helper\MailerHelper;
use VmmimmoscoutNamespace\Component\Vmmimmoscout\Site\Helper\VmmimmoscoutHelper;

/**
 * Controller for single realestate view
 *
 * @since  1.0.0
 */
class RealestateController extends FormController
{

    public static function sendContactMail($id)
    {
        $response = VmmimmoscoutHelper::realestatesContactData();
        $contactData = json_decode($response);
        $contactEmail = $contactData->{'realtorContactDetails'}[0]->{"email"};

        $mailerHelper = MailerHelper::mailInformation();
        return $mailerHelper;
    }

}
