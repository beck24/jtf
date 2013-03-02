<?php
/**
 * AdminShout - send an email message to all site users and group members
 *
 * @package AdminShout
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author slyhne (forked from original Curverider plugin)
 * @link http://zurf.dk/elgg
*/ 

$group_guid = (int) get_input('group_guid');
$group = new ElggGroup($group_guid);
if (!$group) {
	forward();
}
if (!$group->canEdit()) {
	forward($group->getURL());
}

group_gatekeeper();

elgg_set_page_owner_guid($group->guid);
elgg_set_context('groups');

elgg_push_breadcrumb(elgg_echo('groups'), "groups/all");
elgg_push_breadcrumb($group->name, $group->getURL());
elgg_push_breadcrumb(elgg_echo('adminshout:group'));

$title = elgg_echo('adminshout:group');

if (elgg_is_logged_in() && ($group instanceof ElggGroup)) {
	if ((elgg_get_logged_in_user_guid() == $group->owner_guid) || elgg_is_admin_logged_in()) {
		$content = elgg_view_form('adminshout/groupshout');
	} else {
		$content = elgg_echo("adminshout:noaccess");
	}
} else {
	$content .= elgg_echo("adminshout:noaccess");
}

$body = elgg_view_layout('content', array(
	'content' => $content,
	'title' => $title,
	'filter' => '',
));

echo elgg_view_page($title, $body);
