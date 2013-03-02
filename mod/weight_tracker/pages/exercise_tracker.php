<?php

// make it available to logged in users only
gatekeeper();

$rawdata = weight_tracker_get_exercise_objects(elgg_get_logged_in_user_entity());

$params = array(
  'datapoints' => weight_tracker_get_datapoints($rawdata, 'exercise'),
  'entity' => elgg_get_logged_in_user_entity(),
  'width' => 630,
  'height' => 450
);

$leftbody = elgg_view_form('exercise_tracker', array('action' => 'action/exercise_tracker/add'));
$leftbody .= "<br><br>";
$leftbody .= elgg_view('weight_tracker/exercise_graph', $params);
$leftbody .= "<br>";
$leftbody .= elgg_echo('weight_tracker:graph:instructions') . "<br><br>";
$leftbody .= elgg_view_form('weight_tracker/graphaccess', array('action' => 'action/exercise_tracker/access'));

$params = array(
  'datapoints' => weight_tracker_get_datapoints($rawdata, 'exerciselist'),
);

$rightbody = elgg_view('weight_tracker/exercisedatalist', $params);

$page = elgg_view_layout('one_sidebar', array('content' => $leftbody, 'sidebar' => $rightbody));

echo elgg_view_page('Exercise Tracker', $page);















