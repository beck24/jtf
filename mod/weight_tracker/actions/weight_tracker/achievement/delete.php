<?php
action_gatekeeper();

$delete = get_input('achievement');

$guid = get_input('user');
$user = get_user($guid);

if (!$user->canEdit()) {
  register_error(elgg_echo('weight_tracker:invalid:permissions'));
  forward(REFERRER);
}

$annotation = elgg_get_annotation_from_id($delete);

if($annotation->delete()){
  elgg_delete_river(array('annotation_ids' => $annotation->id));
  system_message(elgg_echo('weight_tracker:achievement:deleted'));
}
else{
  register_error(elgg_echo('weight_tracker:invalid:input'));
}

forward(REFERER);