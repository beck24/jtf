<?php
action_gatekeeper();

elgg_make_sticky_form('weight_tracker');

$date = get_input('date');
$weight = get_input('weight');

if(empty($date) || empty($weight) || !is_numeric($weight) || $weight < 20 || $weight > 1500){
  register_error(elgg_echo('weight_tracker:invalid:input'));
  forward(REFERER);
}

$dateparts = explode('/', $date);

$timestamp = mktime(12,0,0,$dateparts[0],$dateparts[1],$dateparts[2]);

$weightpoints = weight_tracker_get_weight_objects(elgg_get_logged_in_user_entity());

if(!is_array($weightpoints)){
  $weightpoints = array();
}

foreach($weightpoints as $weightpoint){
  if($weightpoint->weight_tracker_date == $timestamp){
    register_error(elgg_echo('weight_tracker:error:date:exists'));
    forward(REFERER);
  }
}

elgg_clear_sticky_form('weight_tracker');

$access = elgg_get_plugin_user_setting('graph:access', elgg_get_logged_in_user_guid(), 'weight_tracker');
if(empty($access)){
  $access = ACCESS_PUBLIC;
}

$datapoint = new ElggObject();
$datapoint->subtype = "weight_tracker";
$datapoint->title = "Weight Tracker";
$datapoint->description = "Weight Tracking Data Point";
$datapoint->container_guid = elgg_get_logged_in_user_guid();
$datapoint->access_id = $access;
$datapoint->owner_guid = elgg_get_logged_in_user_guid();
$datapoint->weight_tracker_value = round($weight, 1);
$datapoint->weight_tracker_date = $timestamp;
$datapoint->save();


add_to_river('river/weight_tracker/update', 'update_weight_tracker', elgg_get_logged_in_user_guid(), $datapoint->guid, $access, time());

// update personal statistics
weight_tracker_update_personal_stats(elgg_get_logged_in_user_entity());

// update site stats
weight_tracker_update_site_stats();

// check for achievements
weight_tracker_achievements_check(elgg_get_logged_in_user_entity());

system_message(elgg_echo('weight_tracker:datapoint:success'));

forward(REFERER);