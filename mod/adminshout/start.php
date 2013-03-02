<?php
/**
 * AdminShout - send an email message to all site users and group members
 *
 * @package AdminShout
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author slyhne (forked from original Curverider plugin)
 * @link http://zurf.dk/elgg
*/ 

register_elgg_event_handler('init','system','adminshout_init');

function adminshout_init() {

	// Extend CSS
	elgg_extend_view('css/elgg', 'adminshout/css');

	elgg_register_page_handler('adminshout', 'adminshout_page_handler');
	elgg_register_page_handler('groupshout', 'groupshout_page_handler');

	elgg_register_event_handler('pagesetup', 'system', 'adminshout_pagesetup');

	elgg_register_action("adminshout/groupshout", elgg_get_plugins_path() . "adminshout/actions/groupshout.php");
	elgg_register_action("adminshout/siteshout", elgg_get_plugins_path() . "adminshout/actions/siteshout.php", 'admin');

	// admin interface to send site messages
	elgg_register_menu_item('page', array(
					'name' => 'adminshout',
					'href' => elgg_get_site_url() . "admin/adminshout/siteshout",
					'text' => elgg_echo('admin:adminshout'),
					'context' => 'admin',
					'priority' => 201,
					'section' => 'administer'
					));

}

function adminshout_pagesetup() {



	// Get the page owner entity

	$page_owner = elgg_get_page_owner_entity();


	if (elgg_in_context('groups')) {

		if ($page_owner instanceof ElggGroup) {

			if (elgg_is_logged_in() && $page_owner->canEdit()) {

				$url = elgg_get_site_url() . "adminshout/group/{$page_owner->getGUID()}";

				elgg_register_menu_item('page', array(

					'name' => 'groupshout',

					'text' => elgg_echo('adminshout:group'),

					'href' => $url,

				));

			}

		}

	}
}

// Pagehandler for admin shouts
function adminshout_page_handler($page){
	gatekeeper();

	set_page_owner(elgg_get_logged_in_user_guid());



	if (isset($page[0])) {

		$file_dir = elgg_get_plugins_path() . 'adminshout/pages/adminshout';


		$page_type = $page[0];

		switch($page_type) {

			case 'all':

				include("$file_dir/siteshout.php");

				break;

			case 'group':

				set_input('group_guid', $page[1]);

				include("$file_dir/groupshout.php");

				break;

		}

	}
}
