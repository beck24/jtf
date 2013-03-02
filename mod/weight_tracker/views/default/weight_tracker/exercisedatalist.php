<h4 class="weight_tracker_center"><?php echo elgg_echo('weight_tracker:datapoints'); ?></h4>

<div class="weight_tracker_datapoints">
<?php 
if(is_array($vars['datapoints'])){
  echo "<table>";
  foreach($vars['datapoints'] as $timestamp => $duration){
    $url = elgg_get_site_url() . "action/exercise_tracker/delete?date={$timestamp}";
    $url = elgg_add_action_tokens_to_url($url);
    
    echo "<tr>";
    echo "<td>" . date("M j, Y", $timestamp) . ": " . "</td>";
    echo "<td>" . $duration . "</td>";
    echo "<td><a href=\"{$url}\" onclick=\"return confirm('" . sprintf(elgg_echo('weight_tracker:confirm:delete'), date("M j, Y", $timestamp)) . "');\">";
    echo "<img src=\"" . elgg_get_site_url() . "mod/weight_tracker/graphics/delete.png\">";
    echo "</a></td>";
    echo "</tr>";
  }
  echo "</table>";
}
?>
</div>















