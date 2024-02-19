<?php
/**
* @package      DigiNerds VMMImmoscout24 Package
*
* @author       Christian Schuelling <info@diginerds.de>
* @copyright    2024 diginerds.de - All rights reserved.
* @license      GNU General Public License version 3 or later
*/

namespace VmmimmoscoutNamespace\Component\Vmmimmoscout\Site\Helper;

\defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Multilanguage;

/**
 * Vmmimmoscout Component Route Helper
 *
 * @static
 * @package     Joomla.Site
 * @subpackage  com_vmmimmoscout * @since       1.0.0
 */
abstract class MailerHelper
{
    function mailInformation($title, $bestellungId, $datum,$firma, $firstname, $lastname, $email, $booked)
    {
        $app = Jfactory::getApplication();
        $seminarDatum = $booked[0]['datum'];
        $seminartyp = $booked[0]['seminartyp'];

        $mailtextAdmin = '<html>';
        $mailtextAdmin .=    '<head>';
        $mailtextAdmin .=        '<title>' . Text::sprintf('COM_FOURTEXX_ADMIN_MAIL_TITLE') . ' ' . $bestellungId . ' </title>';
        $mailtextAdmin .=    '</head>';
        $mailtextAdmin .=    '<style>';
        $mailtextAdmin .=    '</style>';
        $mailtextAdmin .=    '<body>';
        $mailtextAdmin .=        '<h1>' . Text::sprintf('COM_FOURTEXX_ADMIN_MAIL_TITLE') . ' ' . $bestellungId . ' vom ' . date("d.m.Y | H:i", strtotime($datum)) . '</h1>';
        $mailtextAdmin .=       Text::sprintf('COM_FOURTEXX_ADMIN_MAIL_TEXT_LONG');
        $mailtextAdmin .=       Text::sprintf('COM_FOURTEXX_ADMIN_MAIL_COMPANY') . ' ' . $firma . '<br>';
        $mailtextAdmin .=       Text::sprintf('COM_FOURTEXX_ADMIN_MAIL_PERSON') . ' ' . $firstname . ' ' . $lastname . '<br>';
        $mailtextAdmin .=       Text::sprintf('COM_FOURTEXX_ADMIN_MAIL_TEXT') . ' ' . $title . '<br>';
        $mailtextAdmin .=       Text::sprintf('COM_FOURTEXX_ADMIN_MAIL_TEXT2');

        $mailtextAdmin .=   '<h2>Teilnehmer:</h2>';

        $mailtextAdmin .=   '<ul>';
        foreach ($booked as $person){
            $mailtextAdmin .= '<li>Teilnehmer: ' . $person['firstname'] . ' ' . $person['lastname'] . ' | ' .  $person['seminartyp'] . ' am ' . $person['datum'];
        }
        $mailtextAdmin .=   '</ul>';


        $mailtextAdmin .= '	</body>';
        $mailtextAdmin .= '</html>';

        $mailtextCustomer = '<html>';
        $mailtextCustomer .=    '<head>';
        $mailtextCustomer .=        '<title>' . Text::sprintf('COM_FOURTEXX_CUSTOMER_MAIL_TITLE') .' ' . $seminartyp .  '</title>';
        $mailtextCustomer .=    '</head>';
        $mailtextCustomer .=    '<style>';
        $mailtextCustomer .=    '</style>';
        $mailtextCustomer .=    '<body>';
        $mailtextCustomer .=        '<h1>' . Text::sprintf('COM_FOURTEXX_CUSTOMER_MAIL_TITLE') .' ' . $seminartyp .  '</h1>';

        $mailtextCustomer .=    '<p>' .  Text::sprintf('COM_FOURTEXX_CUSTOMER_MAIL_ANREDE') . '</p>';
        $mailtextCustomer .=    '<p>' .  Text::sprintf('COM_FOURTEXX_CUSTOMER_MAIL_TEXT1') . ' ' . $title . '. ' . Text::sprintf('COM_FOURTEXX_CUSTOMER_MAIL_TEXT3') . ' ';

        if($seminartyp == 'Präsenzseminar'){
            $mailtextCustomer .=  Text::sprintf('COM_FOURTEXX_CUSTOMER_MAIL_TEXT4A');
        }
        if($seminartyp == 'Web-Seminar'){
            $mailtextCustomer .=  Text::sprintf('COM_FOURTEXX_CUSTOMER_MAIL_TEXT4B');
        }

        $mailtextCustomer .=   '<h2>Ihre angemeldeten Teilnehmer auf einen Blick:</h2>';
        $mailtextCustomer .=   '<ul>';
        foreach ($booked as $person){
            $mailtextCustomer .= '<li>Teilnehmer: ' . $person['firstname'] . ' ' . $person['lastname'] . ' | ' .  $person['seminartyp'] . ' am ' . $person['datum'];
        }
        $mailtextCustomer .=   '</ul>';

        $mailtextCustomer .=    Text::sprintf('COM_FOURTEXX_MAIL_KONTAKT');
        $mailtextCustomer .= '	</body>';
        $mailtextCustomer .= '</html>';

        $empfaengerAdmin = "info@whykiki.de";
        $empfaengerCustomer = $email;
        $absender   = "akademie@fourtexx.de";
        $subjectAdmin    = Text::sprintf('COM_FOURTEXX_ADMIN_MAIL_TITLE') . ' ' . $bestellungId;
        $subjectCustomer    = Text::sprintf('COM_FOURTEXX_CUSTOMER_MAIL_TITLE');

        $mailer =  Factory::getMailer();
        $mailer->setSender($absender);
        $mailer->addRecipient($empfaengerAdmin);
        //$mailer->addRecipient('info@whykiki.de');
        $mailer->isHtml( true);
        $mailer->CharSet  = 'UTF-8';
        $mailer->Encoding = 'base64';
        $mailer->setSubject($subjectAdmin);
        $mailer->setBody($mailtextAdmin);
        $mailer->Send();

        $mailer->setSender($absender);
        $mailer->addRecipient($empfaengerCustomer);
        $mailer->isHtml( true);
        $mailer->CharSet  = 'UTF-8';
        $mailer->Encoding = 'base64';
        $mailer->setSubject($subjectCustomer);
        $mailer->setBody($mailtextCustomer);
        $mailer->Send();


        return 'Mail sent';

    }
}
