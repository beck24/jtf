<?php
action_gatekeeper();

global $CONFIG;

$access = get_input('access');
$object_guid = elgg_get_logged_in_user_guid();

if($access == '' || !is_numeric($access)){
  register_error(elgg_echo('weight_tracker:invalid:input'));
  forward(REFERER);
}

elgg_set_plugin_user_setting('graph:exercise:access', $access, elgg_get_logged_in_user_guid(), 'weight_tracker');

$exercisepoints = weight_tracker_get_exercise_objects(elgg_get_logged_in_user_entity());

foreach($exercisepoints as $exercisepoint){
  $exercisepoint->access_id = $access;
  $exercisepoint->save();
  //update river with new access
  update_river_access_by_object($exercisepoint->guid, $access);
}

system_message(elgg_echo('weight_tracker:access:saved'));
forward(REFERER);