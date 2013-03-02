<?php
action_gatekeeper();

elgg_make_sticky_form('exercise_tracker');

$date = get_input('date');
$milddur = get_input('milddur');
$milddesc = get_input('milddesc');
$moderatedur = get_input('moderatedur');
$moderatedesc = get_input('moderatedesc');
$extremedur = get_input('extremedur');
$extremedesc = get_input('extremedesc');

if(empty($date) || !is_numeric($milddur) || $milddur < 0 || !is_numeric($moderatedur) || $moderatedur < 0 || !is_numeric($extremedur) || $extremedur < 0){
  register_error(elgg_echo('weight_tracker:invalid:input'));
  forward(REFERER);
}

$dateparts = explode('/', $date);

$timestamp = mktime(12,0,0,$dateparts[0],$dateparts[1],$dateparts[2]);

$exercisepoints = weight_tracker_get_exercise_objects(elgg_get_logged_in_user_entity());

if(!is_array($exercisepoints)){
  $exercisepoints = array();
}

foreach($exercisepoints as $exercisepoint){
  if($exercisepoint->exercise_tracker_date == $timestamp){
    register_error(elgg_echo('weight_tracker:error:date:exists'));
    forward(REFERER);
  }
}

elgg_clear_sticky_form('exercise_tracker');

$access = elgg_get_plugin_user_setting('graph:exercise:access', elgg_get_logged_in_user_guid(), 'weight_tracker');
if(empty($access)){
  $access = ACCESS_PUBLIC;
}

$datapoint = new ElggObject();
$datapoint->subtype = "exercise_tracker";
$datapoint->title = $date;
$datapoint->description = "Exercise Tracking Data Point";
$datapoint->container_guid = elgg_get_logged_in_user_guid();
$datapoint->access_id = $access;
$datapoint->owner_guid = elgg_get_logged_in_user_guid();
$datapoint->exercise_tracker_mild_duration = $milddur;
$datapoint->exercise_tracker_mild_description = $milddesc;
$datapoint->exercise_tracker_moderate_duration = $moderatedur;
$datapoint->exercise_tracker_moderate_description = $moderatedesc;
$datapoint->exercise_tracker_extreme_duration = $extremedur;
$datapoint->exercise_tracker_extreme_description = $extremedesc;
$datapoint->exercise_tracker_date = $timestamp;
$datapoint->save();


add_to_river('river/exercise_tracker/update', 'update_exercise_tracker', elgg_get_logged_in_user_guid(), $datapoint->guid, $access, time());

// check for achievements
weight_tracker_achievements_check(elgg_get_logged_in_user_entity(), 'exercise');

system_message(elgg_echo('weight_tracker:datapoint:success'));

forward(REFERER);