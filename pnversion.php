<?php
/**
 * PostNuke Application Framework
 *
 * @copyright (c) 2002, PostNuke Development Team
 * @link http://www.postnuke.com
 * @version $Id: pnversion.php 19262 2006-06-12 14:45:18Z markwest $
 * @license GNU/GPL - http://www.gnu.org/copyleft/gpl.html
 * @package PostNuke_3rdParty
 * @subpackage ThemeGallery
 */

$modversion['name']           = DataUtil::formatForDisplay(_THEMEGALLERY_NAME);
$modversion['version']        = '1.0';
$modversion['description']    = DataUtil::formatForDisplay(_THEMEGALLERY_DESCRIPTION);
$modversion['displayname']    = DataUtil::formatForDisplay(_THEMEGALLERY_DISPLAYNAME);
$modversion['changelog']      = 'pndocs/changelog.txt';
$modversion['credits']        = 'pndocs/credits.txt';
$modversion['help']           = 'pndocs/help.txt';
$modversion['license']        = 'pndocs/license.txt';
$modversion['official']       = 1;
$modversion['author']         = 'Mark West';
$modversion['contact']        = 'http://www.markwest.me.uk/';
$modversion['securityschema'] = array('ThemeGallery::' => 'Theme name::');

