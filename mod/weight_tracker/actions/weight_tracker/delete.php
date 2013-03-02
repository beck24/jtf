<?php
action_gatekeeper();

$timestamp = get_input('date');

$params = array(
  'owner_guids' => array(elgg_get_logged_in_user_guid()),
  'types' => array('object'),
  'subtypes' => array('weight_tracker'),
  'metadata_names' => array('weight_tracker_date'),
  'metadata_values' => array($timestamp),
);

$weightpoints = elgg_get_entities_from_metadata($params);

$deleted = FALSE;
if(is_array($weightpoints)){
  foreach($weightpoints as $weightpoint){ 
      $weightpoint->delete();
      system_message(elgg_echo('weight_tracker:deleted'));
      $deleted = TRUE;
  }
}

if(!$deleted){
  register_error(elgg_echo('weight_tracker:invalid:input'));
}

// update personal statistics
weight_tracker_update_personal_stats(elgg_get_logged_in_user_entity());

// update site stats
weight_tracker_update_site_stats();

forward(REFERER);