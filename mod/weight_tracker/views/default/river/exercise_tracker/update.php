<?php

$user = get_user($vars['item']->subject_guid);
$object = get_entity($vars['item']->object_guid);

$url = elgg_get_site_url() . 'exercise_tracker/graph/' . $user->username;
$link = "<a href=\"{$url}\" class=\"elgg-lightbox\">" . elgg_echo('weight_tracker:graph') . "</a>";

$summary = elgg_echo('exercise_tracker:river:update', array("<a href=\"".$user->getURL()."\">{$user->name}</a>"));

$message = elgg_echo('exercise_tracker:river:message', array($link));
/*
 * @TODO make this display a better view
if(!empty($object->exercise_tracker_mild_description)){
  $message .= $object->exercise_tracker_mild_description . "<br><br>";
}

if(!empty($object->exercise_tracker_moderate_description)){
  $message .= $object->exercise_tracker_moderate_description . "<br><br>";
}

if(!empty($object->exercise_tracker_extreme_description)){
  $message .= $object->exercise_tracker_extreme_description . "<br><br>";
}
*/
//echo elgg_view_entity_icon($user, 'small');
echo elgg_view('river/elements/layout', array(
	'item' => $vars['item'],
	'summary' => $summary,
    'message' => $message
));