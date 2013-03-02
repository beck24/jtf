<?php
action_gatekeeper();

$delete = get_input('achievement');

$user = elgg_get_logged_in_user_entity();

$annotation = elgg_get_annotation_from_id($delete);

if($annotation->delete()){
  elgg_delete_river(array('annotation_ids' => $achievement->id));
  system_message(elgg_echo('weight_tracker:achievement:deleted'));
}
else{
  register_error(elgg_echo('weight_tracker:invalid:input'));
}

forward(REFERER);