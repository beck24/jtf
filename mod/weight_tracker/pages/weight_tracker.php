<?php

// make it available to logged in users only
gatekeeper();

$rawdata = weight_tracker_get_weight_objects(elgg_get_logged_in_user_entity());

$params = array(
  'datapoints' => weight_tracker_get_datapoints($rawdata, 'graph'),
  'entity' => elgg_get_logged_in_user_entity(),
  'width' => 650,
  'height' => 450
);

$leftbody = elgg_view_form('weight_tracker', array('action' => 'action/weight_tracker/add'));
$leftbody .= "<br><br>";
$leftbody .= elgg_view('weight_tracker/graph', $params);
$leftbody .= "<br>";
$leftbody .= elgg_echo('weight_tracker:graph:instructions') . "<br><br>";
$leftbody .= elgg_view_form('weight_tracker/graphaccess', array('action' => 'action/weight_tracker/access'));

$params = array(
  'datapoints' => weight_tracker_get_datapoints($rawdata, 'array'),
);

$rightbody = elgg_view('weight_tracker/datalist', $params);

$page = elgg_view_layout('one_sidebar', array('content' => $leftbody, 'sidebar' => $rightbody));

echo elgg_view_page('Weight Tracker', $page);