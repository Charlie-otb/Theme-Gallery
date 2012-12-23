<?php
/**
 * PostNuke Application Framework
 *
 * @copyright (c) 2002, PostNuke Development Team
 * @link http://www.postnuke.com
 * @version $Id: pninit.php 19503 2006-07-30 10:39:21Z rgasch $
 * @license GNU/GPL - http://www.gnu.org/copyleft/gpl.html
 * @package PostNuke_3rdParty
 * @subpackage ThemeGallery
 */

/**
 * initialise the ThemeGallery module
 *
 * This function is only ever called once during the lifetime of a particular
 * module instance.
 * This function MUST exist in the pninit file for a module
 *
 * @author       Mark West
 * @return       bool       true on success, false otherwise
 */
function ThemeGallery_init()
{
    // set module vars
    pnModSetVar('ThemeGallery', 'itemsperpage', 10);

    // Initialisation successful
    return true;
}


/**
 * upgrade the ThemeGallery module from an old version
 *
 * This function can be called multiple times
 * This function MUST exist in the pninit file for a module
 *
 * @author       Mark West
 * @return       bool       true on success, false otherwise
 */
function ThemeGallery_upgrade($oldversion)
{
    // Update successful
    return true;
}


/**
 * delete the ThemeGallery module
 *
 * This function is only ever called once during the lifetime of a particular
 * module instance
 * This function MUST exist in the pninit file for a module
 *
 * @author       Mark West
 * @return       bool       true on success, false otherwise
 */
function ThemeGallery_delete()
{
    // delete all module vars
    pnModDelVar('ThemeGallery');

    // Deletion successful
    return true;
}

