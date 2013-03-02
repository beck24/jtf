<?php

$group_guid = (int) get_input('group_guid');
$subject = get_input('subject', $_SESSION['_adminshout:subject']);
$message = get_input('message', $_SESSION['_adminshout:message']);
$__elgg_ts = get_input('__elgg_ts');
$__elgg_token = get_input("__elgg_token");

$offset = (int) get_input('offset', 0);
$limit = 2000;

$group = get_entity($group_guid);

if ($group instanceof ElggGroup) {

	if (elgg_is_logged_in() && $group->canEdit()) {

		//check there is a title and message
		if($subject && $message){
			$users = get_group_members($group->guid, $limit, $offset, false);
	
			if ($users) {
				$_SESSION['_adminshout:subject'] = $subject;
				$_SESSION['_adminshout:message'] = $message;
		
				foreach ($users as $u) {
					set_time_limit(30); // ask for more time
					notify_user($u->guid, $group->guid, $subject, $message);
				}
		
				$offset += $limit;
		
				forward(elgg_get_site_url() .  "action/adminshout/groupshout?offset=$offset&__elgg_ts=$__elgg_ts&__elgg_token=$__elgg_token&group_guid=$group->guid");
			} else {
				// If there are no more users and the offset is greater than zero that means we have processed some messages
				if ($offset>0) {
					system_message(elgg_echo('adminshout:success'));
				} else {
					register_error(elgg_echo('adminshout:fail'));
				}
			}
	
			// Cleanup session
			$_SESSION['_adminshout:subject'] = "";
			$_SESSION['_adminshout:message'] = "";
			unset($_SESSION['_adminshout:subject']);
			unset($_SESSION['_adminshout:message']);
	
		} else {
			register_error(elgg_echo('adminshout:inputs'));
		}

		// Forward to shout page
		forward(REFERER);
	} else {
		register_error(elgg_echo('adminshout:notowner'));
		forward(REFERER);
	}
} else {
	register_error(elgg_echo('adminshout:nogroup') . get_input('group_guid'));
	forward(REFERER);
}