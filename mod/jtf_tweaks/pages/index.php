<?php
$content = "";
$matt = get_user(35);

// get graph
  $oldaccess = elgg_set_ignore_access(TRUE);
  $rawdata = weight_tracker_get_weight_objects($matt);
  $params = array(
  	'datapoints' => weight_tracker_get_datapoints($rawdata, 'graph'),
  	'entity' => $matt,
  	'width' => 200,
  	'height' => 200
  );
  
  $graph = elgg_view('weight_tracker/graph', $params);
  
  $rawdata = weight_tracker_get_exercise_objects($matt);
  $params['datapoints'] = weight_tracker_get_datapoints($rawdata, 'exercise');
  $params['legend'] = "false";
  
  $exercisegraph = elgg_view('weight_tracker/exercise_graph', $params);
  
  elgg_set_ignore_access($oldaccess);

//get intro content
$oldaccess = elgg_set_ignore_access(TRUE);
$blog = get_entity(63);
elgg_set_ignore_access($oldaccess);

$content .= "<div class=\"jtf_index_left\">";
$content .= "<iframe width=\"320\" height=\"180\" src=\"http://www.youtube.com/embed/aUaInS6HIGo?wmode=transparent\" frameborder=\"0\" allowfullscreen></iframe>";
$content .= $blog->description;
$content .= "</div>";

$content .= "<div class=\"jtf_index_mid\">";
$content .= elgg_view_entity_icon($matt, 'large');
$content .= "<br><br>";
$content .= $graph;
$content .= "<div style=\"text-align: center;\">";
$content .= "<a href=\"" . elgg_get_site_url() . "weight_tracker/graph/beck24\" class=\"elgg-lightbox\">Full Size Chart</a>";
$content .= "</div>";
$content .= "<br><br>";
$content .= $exercisegraph;
$content .= "<div style=\"text-align: center;\">";
$content .= "<a href=\"" . elgg_get_site_url() . "exercise_tracker/graph/beck24\" class=\"elgg-lightbox\">Full Size Chart</a>";
$content .= "</div><br><br>";
$content .= "<div style=\"text-align: center;\">";
$content .= "
<script type=\"text/javascript\"><!--
google_ad_client = \"ca-pub-4303889349001967\";
/* JTF Homepage Small */
google_ad_slot = \"8378480361\";
google_ad_width = 125;
google_ad_height = 125;
//-->
</script>
<script type=\"text/javascript\" src=\"http://pagead2.googlesyndication.com/pagead/show_ads.js\"></script>
";
$content .= "</div>";
$content .= "</div>";

$content .= "<div class=\"jtf_index_right\">";
if(!elgg_is_logged_in()){
  $content .= elgg_view("core/account/login_box");
}

$content .= elgg_list_river(array('limit' => 15, 'pagination' => FALSE));
$content .= "</div>";



$body = elgg_view_layout('one_column', array('content' => $content));

echo elgg_view_page('Just Too Fat (but trying to fix that..) - Weight Loss through Shame & Humiliation', $body);