<?php
/**
 * PostNuke Application Framework
 *
 * @copyright (c) 2002, PostNuke Development Team
 * @link http://www.postnuke.com
 * @version $Id: pnuser.php 19262 2006-06-12 14:45:18Z markwest $
 * @license GNU/GPL - http://www.gnu.org/copyleft/gpl.html
 * @package PostNuke_3rdParty
 * @subpackage ThemeGallery
 */

/**
 * Get available admin panel links
 *
 * @return array array of admin links
 */
function ThemeGallery_adminapi_getlinks()
{
    // Define an empty array to hold the list of admin links
    $links = array();

    // Load the admin language file
    // This allows this API to be called outside of the module
    pnModLangLoad('ThemeGallery', 'admin');

    // Check the users permissions to each avaiable action within the admin panel
    // and populate the links array if the user has ACCESS_ADMIN
    if (pnSecAuthAction(0, 'ThemeGallery::', '::', ACCESS_READ)) {
        $links[] = array('url' => pnModURL('ThemeGallery', 'admin', 'view'), 'text' => _VIEW);
    }
    if (pnSecAuthAction(0, 'ThemeGallery::', '::', ACCESS_ADMIN)) {
        $links[] = array('url' => pnModURL('ThemeGallery', 'admin', 'modifyconfig'), 'text' => _MODIFYCONFIG);
    }

    // Return the links array back to the calling function
    return $links;
}

