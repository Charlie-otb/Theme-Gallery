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
 * the main user function
 *
 * @author       Mark West
 * @return       output       The main module page
 */
function ThemeGallery_user_main()
{
    // Security check
    if (!SecurityUtil::checkPermission('ThemeGallery::', '::', ACCESS_OVERVIEW)) {
        return LogUtil::registerError(_MODULENOAUTH, 403);
    }

    // Create output object
    $pnRender = pnRender::getInstance('ThemeGallery');

    // Return the output that has been generated by this function
    return $pnRender->fetch('themegallery_user_main.htm');
}

/**
 * view items
 *
 * @author       Mark West
 * @param        integer      $startnum    (optional) The number of the start item
 * @return       output       The overview page
 */
function ThemeGallery_user_view($args)
{
    // Security check
    if (!SecurityUtil::checkPermission('ThemeGallery::', '::', ACCESS_OVERVIEW)) {
        return LogUtil::registerError(_MODULENOAUTH, 403);
    }

    // Get parameters from whatever input we need
    $startnum = (int)FormUtil::getPassedValue ('startnum', 0);

    // Create output object
    $pnRender = pnRender::getInstance('ThemeGallery', false);

    // get the number of items per page
    $itemsperpage = pnModGetVar('ThemeGallery', 'itemsperpage');

    // get all installed themes 
    $themes = pnThemeGetAllThemes(PNTHEME_FILTER_USER, PNTHEME_STATE_ACTIVE);

    foreach ($themes as $key => $theme) {
        // theme download link - TODO: integrate to downloads module 
        $themes[$key]['downloadlink'] = '#';
        // check that we've got the right images for all themes
        $dir = DataUtil::formatForOS($theme['directory']);
        $themes[$key]['previewavailable'] = true;
        if (!file_exists('themes/'.$dir.'/images/preview_large.png') ||
            !file_exists('themes/'.$dir.'/images/preview_medium.png') ||
            !file_exists('themes/'.$dir.'/images/preview_small.png')) {
            $themes[$key]['previewavailable'] = false;
        }
	}

    // get the theme count
    $themecount = count($themes);

    // page the themes
    $themes = array_chunk($themes, $itemsperpage);
    $themes = $themes[($startnum - 1)/$itemsperpage];

    $pnRender->assign('themes', $themes);

    // is theme changing allowed?
    $pnRender->assign('theme_change', pnConfigGetVar('theme_change'));

    // assign the values for the smarty plugin to produce a pager
    $pnRender->assign('pager', array('numitems'     => $themecount,
                                     'itemsperpage' => $itemsperpage));

    // Return the output that has been generated by this function
    return $pnRender->fetch('themegallery_user_view.htm');
}

/**
 * display item
 *
 * @author       Mark West
 * @param        straig       $themename    The name of the theme
 * @return       output       The overview page
 */
function ThemeGallery_user_display($args)
{
    // Get parameters from whatever input we need
    $themename = (string)FormUtil::getPassedValue ('themename', null);

    // Security check
    if (!SecurityUtil::checkPermission('ThemeGallery::', "$themename::", ACCESS_READ)) {
        return LogUtil::registerError(_MODULENOAUTH, 403);
    }

    // get the theme info
    $themeinfo = pnThemeGetInfo(pnThemeGetIDFromName($themename));
    if (!$themeinfo) {
        return LogUtil::registerError(_NOSUCHITEM, 404);
    }

    // Create output object
    $pnRender = pnRender::getInstance('ThemeGallery', false);

	// explode the contact and author arrays to allow for
	// multiple authors and contacts
	$themeinfo['author'] = explode(',', $themeinfo['author']);
	$themeinfo['contact'] = explode(',', $themeinfo['contact']);

	// theme download link - TODO: integrate to downloads module 
	$themeinfo['downloadlink'] = '#';

    // check that we've got the right images for all themes
    $themeinfo['previewavailable'] = true;
    $dir = DataUtil::formatForOS($themeinfo['directory']);
    if (!file_exists('themes/'.$dir.'/images/preview_large.png') ||
        !file_exists('themes/'.$dir.'/images/preview_medium.png') ||
        !file_exists('themes/'.$dir.'/images/preview_small.png')) {
        $themeinfo['previewavailable'] = false;
    }

	// check if an e-mail address is given as the contact
	foreach($themeinfo['contact'] as $contactid => $contact) {
		$contact = trim($contact);
		if (eregi("^([a-z0-9_]|\\-|\\.)+@(([a-z0-9_]|\\-)+\\.)+[a-z]{2,4}$", $contact)) {
			$themeinfo['contact'][$contactid] = 'mailto:' . $contact;
		}
	}

    // assgin the theme info
    $pnRender->assign($themeinfo);

    // is theme changing allowed?
    $pnRender->assign('theme_change', pnConfigGetVar('theme_change'));

    // Return the output that has been generated by this function
    return $pnRender->fetch('themegallery_user_display.htm');
}

/**
 * display a template containing the most commonly used tags
 *
 * @author       Mark West
 * @return       output       The overview page
 */
function ThemeGallery_user_loremipsum($args)
{
    // Security check
    if (!SecurityUtil::checkPermission('ThemeGallery::', '::', ACCESS_READ)) {
        return LogUtil::registerError(_MODULENOAUTH, 403);
    }

    // get the theme info
    $themeinfo = pnThemeGetInfo(pnThemeGetIDFromName(pnUserGetTheme()));

    // Create output object
    $pnRender = pnRender::getInstance('ThemeGallery', false);

    // assgin the theme info
    $pnRender->assign($themeinfo);

    // Return the output that has been generated by this function
    return $pnRender->fetch('themegallery_user_loremipsum.htm');
}

