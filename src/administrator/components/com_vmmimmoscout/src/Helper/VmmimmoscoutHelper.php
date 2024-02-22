<?php
/**
* @package      DigiNerds VMMImmoscout24 Package
*
* @author       Christian Schuelling <info@diginerds.de>
* @copyright    2024 diginerds.de - All rights reserved.
* @license      GNU General Public License version 3 or later
*/
namespace VmmimmoscoutNamespace\Component\Vmmimmoscout\Administrator\Helper;

\defined('_JEXEC') or die;

use Joomla\CMS\Helper\ContentHelper;
use Joomla\CMS\Language\Text;

/**
 * Vmmimmoscout component helper.
 *
 * @since  1.0.0
 */
class VmmimmoscoutHelper extends ContentHelper
{
    /**
     * Checks if a file exists in the specified path and returns its contents.
     * This method adjusts the base path based on the environment (local development or production).
     *
     * @param   string  $filePath  The relative path to the file from the base path.
     * @param   string  $isLinked  Is the file symlinked in the Local Env?
     *
     * @return  string  Returns the content of the file if it exists and is readable; otherwise, returns a warning message.
     */
    public static function checkFile($filePath, $isLinked = false)
    {
        // Check whether the domain is 'immoscout.joomla.local' and whether the file is symlinked in the DEV environment
        if (str_contains($_SERVER['HTTP_HOST'], 'immoscout.joomla.local') && $isLinked)
        {
            // Path for the local development environment
            $basePath = '/srv/git/immoscoutGit_joomla/src';
        }
        else
        {
            // Path for the production environment
            $basePath = '';
        }

        $filePath = $basePath . $filePath;

        $fileExists   = file_exists($filePath);
        $fileContents = file_get_contents($filePath);

        $codeContent = $fileExists ? $fileContents : Text::_('COM_VMMIMMOSCOUT_HELP_FILE_NOT_FOUND');

        return $codeContent;
    }
}
