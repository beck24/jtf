<?php
$access = elgg_get_plugin_user_setting('graph:access', elgg_get_logged_in_user_guid(), 'weight_tracker');
if($access == ''){
  $access = ACCESS_DEFAULT;
}

echo "<label>" . elgg_echo('weight_tracker:access:label') . "</label><br>";
echo elgg_view('input/access', array('name' => 'access', 'value' => $access));
echo elgg_view('input/submit', array('value' => elgg_echo('Submit')));