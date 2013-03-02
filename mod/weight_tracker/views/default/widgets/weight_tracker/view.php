<?php

// owner of the profile page
$owner = get_user($vars['entity']->owner_guid);

  $annotations = weight_tracker_get_achievements($owner, 'weight');
  
  foreach($annotations as $achievement){
    echo "<div>";
    if(elgg_get_logged_in_user_guid() == $owner->guid){
      $img = "<img src=\"" . elgg_get_site_url() . "mod/weight_tracker/graphics/delete.png\">";
      $url = elgg_get_site_url() . "action/weight_tracker/achievement/delete?achievement={$achievement->id}";
      $url = elgg_add_action_tokens_to_url($url);      
      
      echo elgg_view('output/confirmlink', array('text' => $img, 'href' => $url, 'class' => 'weight_tracker_widget_delete'));
    }
    echo "<img class=\"weight_tracker_widget_achievement\" src=\"" . elgg_get_site_url() . "mod/weight_tracker/graphics/" . $achievement->value . ".png\">";
    echo "</div>";
  }