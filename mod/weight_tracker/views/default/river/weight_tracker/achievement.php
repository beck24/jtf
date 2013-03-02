<?php

$user = get_user($vars['item']->subject_guid);

$achievement = elgg_get_annotation_from_id($vars['item']->annotation_id);

$summary = elgg_echo('weight_tracker:river:achievement', array("<a href=\"".$user->getURL()."\">{$user->name}</a>"));

echo elgg_view('river/elements/layout', array(
	'item' => $vars['item'],
	'summary' => $summary,
    'message' => "<img class=\"weight_tracker_river_achievement\" src=\"" . elgg_get_site_url() . "mod/weight_tracker/graphics/" . $achievement->value . ".png\">",
));