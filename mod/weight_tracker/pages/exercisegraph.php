<?php
$username = get_input('username');
$user = get_user_by_username($username);

if(weight_tracker_graph_access($user, 'exercise')){
  // we have permissions to view it, but the annotations are private
  $oldaccess = elgg_set_ignore_access(TRUE);
  
  $rawdata = weight_tracker_get_exercise_objects($user);
  
  $params = array(
  	'datapoints' => weight_tracker_get_datapoints($rawdata, 'exercise'),
  	'entity' => $user,
  	'width' => 600,
  	'height' => 450
  );
  
  $output = elgg_view('weight_tracker/exercise_graph', $params);
  $output .= "<br>";
  $output .= "<div style=\"width: 600px;\">" . elgg_echo('weight_tracker:graph:instructions') . "</div>";
  
  elgg_set_ignore_access($oldaccess);
}
else{
  $output = "<div style=\"width: 600px; height: 300px; text-align: center; padding-top: 80px;\">Invalid Permissions</div>";
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<div style="width: 675px;">
<?php  
  echo elgg_view('page/elements/head', array());
?>
</div>
</head>
<body>
<?php echo $output; ?>
</body>
</html>