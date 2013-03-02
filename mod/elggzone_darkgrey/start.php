<?php
/*
 *
 * Elggzone Darkgrey
 *
 * @author Elggzone
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2
 * @copyright Copyright (c) 2013, Elggzone
 *
 * @link http://www.perjensen-online.dk/
 *
 */
 
elgg_register_event_handler('init','system','elggzone_darkgrey_init');
 
function elggzone_darkgrey_init() {

	elgg_register_event_handler('pagesetup', 'system', 'elggzone_darkgrey_pagesetup_handler', 1000);
	
	elgg_register_plugin_hook_handler('entity:icon:url', 'user', 'elggzone_darkgrey_theme_icon_url_handler');
	elgg_register_plugin_hook_handler('entity:icon:url', 'group', 'elggzone_darkgrey_theme_groups_icon_url_handler');
	
	elgg_extend_view('css/elgg', 'elggzone_darkgrey/css');
	elgg_unextend_view('css/elgg', 'custom_index/css');
		
	elgg_unregister_menu_item('topbar', 'elgg_logo');

	// If you want to get rid of the more button, uncomment the line below	
	//elgg_unregister_plugin_hook_handler('prepare', 'menu:site', 'elgg_site_menu_setup');
		
}

function elggzone_darkgrey_theme_icon_url_handler($hook, $entity_type, $returnvalue, $params) {

	$user = $params['entity'];
	$size = $params['size'];

	if (isset($user->icontime)) {
		return "avatar/view/$user->username/$size/$user->icontime";
	} else {
		return "mod/elggzone_darkgrey/graphics/user/default{$size}.gif";
	}
}

function elggzone_darkgrey_theme_groups_icon_url_handler($hook, $entity_type, $returnvalue, $params) {

	$group = $params['entity'];
	$size = $params['size'];

	$icontime = $group->icontime;
		
	if ($icontime) {
		// return thumbnail
		return "groupicon/$group->guid/$size/$icontime.jpg";
	}
	return "mod/elggzone_darkgrey/graphics/groups/default{$size}.gif";
}

function elggzone_darkgrey_pagesetup_handler() {

	elgg_unregister_menu_item('topbar', 'dashboard');

	elgg_unextend_view('page/elements/header', 'search/header');	
	if (elgg_is_logged_in()) {
		elgg_extend_view('page/elements/header', 'search/header');
	}
	
	// Extend footer with copyright
	$year = date('Y');	
	$href = "http://www.perjensen-online.dk";
	elgg_register_menu_item('footer', array(
		'name' => 'copyright_this',
		'href' => $href,
		'title' => elgg_echo('elggzone_darkgrey:tooltip'),
		'text' => elgg_echo('elggzone_darkgrey:copyright') . $year . elgg_echo(' Elggzone'),
		'priority' => 1,
		'section' => 'alt',
	));	
		
	if (!elgg_is_logged_in()) {	
		elgg_register_menu_item('topbar', array(
			'name' => 'item_guest',
			'href' => '/register',
			'title' => elgg_echo('elggzone_darkgrey:guest:tooltip'),
			'text' => elgg_echo('elggzone_darkgrey:guest'),
			'priority' => 1,
		));
	}
	
	if (elgg_is_logged_in()) {
		$user = elgg_get_logged_in_user_entity();

		if (elgg_is_active_plugin('dashboard')) {			
			elgg_register_menu_item('topbar', array(
				'name' => 'dashboard',
				'href' => '/dashboard',
				'text' => elgg_echo('dashboard'),
				'section' => 'alt',
				'priority' => 1,
			));
		}
		
		if (elgg_is_active_plugin('reportedcontent')) {
			elgg_unregister_menu_item('footer', 'report_this');
		
			$href = "javascript:elgg.forward('reportedcontent/add'";
			$href .= "+'?address='+encodeURIComponent(location.href)";
			$href .= "+'&title='+encodeURIComponent(document.title));";
				
			elgg_register_menu_item('extras', array(
				'name' => 'report_this',
				'href' => $href,
				'text' => elgg_view_icon('report-this') . elgg_echo(''),
				'title' => elgg_echo('reportedcontent:this:tooltip'),
				'priority' => 2000,
			));
		}
	}
	
}


?>