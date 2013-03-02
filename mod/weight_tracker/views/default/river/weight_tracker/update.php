<?php

$user = get_user($vars['item']->subject_guid);

$url = elgg_get_site_url() . 'weight_tracker/graph/' . $user->username;
$link = "<a href=\"{$url}\" class=\"elgg-lightbox\">" . elgg_echo('weight_tracker:graph') . "</a>";

$summary = elgg_echo('weight_tracker:river:update', array("<a href=\"".$user->getURL()."\">{$user->name}</a>"));

//echo elgg_view_entity_icon($user, 'small');
echo elgg_view('river/elements/layout', array(
	'item' => $vars['item'],
	'summary' => $summary,
    'message' => elgg_echo('weight_tracker:river:message', array($link))
));