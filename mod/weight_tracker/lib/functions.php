<?php

/**
 * 
 * checks whether the user has earned any weight tracker related achievements
 */
function weight_tracker_achievements_check($user, $type = 'weight'){
  $newachievements = array();
  
  // first get an array of all of the achievements currently held
  $annotations = weight_tracker_get_achievements($user, $type);
  
  $achievements = array();
  foreach($annotations as $annotation){
    $achievements[] = $annotation->value;
  }
  
  //
  // check achievements for weight
  if($type == 'weight'){
    $achievementtype = 'weight_tracker_achievements';
    $rawdata = weight_tracker_get_weight_objects($user);
    //$rawdata = weight_tracker_get_weight_objects($user);
  
    // so our achievements are stored in $achievements as string names
    // see what we qualify for this time
  
    // first datapoint achievement
    //  qualify if there is at least 1 point, and no other achievements have been earned
    // should always be the first achievement
    if(count($rawdata) > 0 && !in_array('started_weight_tracking', $achievements)){
      $newachievements[] = 'started_weight_tracking';
    }
    
    // # of weigh-ins
    $milestones = array(25,50,100,200,500);
    foreach($milestones as $milestone){
      if($milestone <= count($rawdata) && !in_array($milestone . '_weigh_ins', $achievements)){
        $newachievements[] = $milestone . '_weigh_ins';
      }
    }
  
    //x lbs lost
    $milestones = array(10,20,30,40,50,60,70,80);
  
    foreach($milestones as $milestone){
      if($milestone <= ($user->weight_tracker_start_weight - $user->weight_tracker_current_weight)){
        // user has earned this acheivement
        // find out if it's the the first time or not
        if(!in_array('lost_' . $milestone . '_lbs', $achievements)){
          $newachievements[] = 'lost_' . $milestone . '_lbs';
        }
      }
    }
  }
  
  
  //
  // check achievements for exercise
  if($type == 'exercise'){
    $achievementtype = 'exercise_tracker_achievements';
    $rawdata = weight_tracker_get_exercise_objects($user);
  
    // so our achievements are stored in $achievements as string names
    // see what we qualify for this time
  
    // first datapoint achievement
    //  qualify if there is at least 1 point, and no other achievements have been earned
    // should always be the first achievement
    if(count($rawdata) > 0 && !in_array('started_exercise_tracking', $achievements)){
      $newachievements[] = 'started_exercise_tracking';
    }
    
    // check for 7 in a row
    if(!in_array('7_days_in_a_row', $achievements) && count($rawdata) > 6){
      $key = array_pop(array_keys($rawdata));
      $check = 0;
      for($i=0; $i<7; $i++){
        $testkey = $key - $i;
        if($rawdata[$testkey]->exercise_tracker_date == $rawdata[$key]->exercise_tracker_date - (60*60*24*$i)){
          $check++;
        }
      }

      if($check == 7){
        $newachievements[] = '7_days_in_a_row';
      }
    }
    
    // check for hours exercised
    $hours = array(25,100);
    // get start weight
    $options = array(
        'owner_guids' => array($user->guid),
        'types' => array('object'),
        'subtypes' => array('exercise_tracker'),
    	'metadata_names' => array('exercise_tracker_mild_duration'),
    	'metadata_calculation' => 'SUM',
    	'limit' => 0
    );
  
    $mildmin = elgg_get_metadata($options);
    
    $options['metadata_names'] = array('exercise_tracker_moderate_duration');
    $moderatemin = elgg_get_metadata($options);
    
    $options['metadata_names'] = array('exercise_tracker_extreme_duration');
    $extrememin = elgg_get_metadata($options);
    
    $totalmin = $mildmin + $moderatemin + $extrememin;
    
    foreach($hours as $hour){
      if($totalmin/60 > $hour && !in_array($hour . '_hours_exercise', $achievements)){
        $newachievements[] = $hour . '_hours_exercise';
      }
    }
    
    // brawndo extreme - for 100 hours of extreme exercise
    if($extrememin/60 > 100 && !in_array('brawndo_extreme', $achievements)){
      $newachievements[] = 'brawndo_extreme';
    }
    
    // 10 extreme workouts
    if(!in_array('10_extreme_workouts', $achievements)){
      $check = 0;
      foreach($rawdata as $point){
        if($point->exercise_tracker_extreme_duration > 0){
          $check++;
          if($check == 10){
            $newachievements[] = '10_extreme_workouts';
            break;
          }
        }
      }
    }
    
  }
  
  
  foreach($newachievements as $newachievement){
    $id = create_annotation($user->guid, $achievementtype, $newachievement, '', $user->guid, ACCESS_PUBLIC);
    
    if($id){
      add_to_river('river/weight_tracker/achievement', 'earned_achievement', $user->guid, $user->guid, ACCESS_PUBLIC, time(), $id);
    }
  }
 
  if(count($newachievements) > 0){
    $user->weight_tracker_newachievements = serialize($newachievements);
  } 
}

/**
 * Returns an array of the achievement annotations for a user
 * 
 */
function weight_tracker_get_achievements($user, $type = 'weight'){
  $params = array(
    'guids' => array($user->guid),
    'annotation_names' => array($type.'_tracker_achievements'),
    'limit' => 0
  );
  
  $annotations = elgg_get_annotations($params);
  
  if(!is_array($annotations)){
    return array();
  }
  
  return $annotations;
}

/**
 * 
 * Returns all of the datapoints of the weight tracker
 * graph in various formats
 * @param int $guid
 * @param string $type
 */
function weight_tracker_get_datapoints($rawdata, $type = 'graph'){
    
  switch ($type){
    case 'graph':
      $line = "";
      $count = 0;
      foreach($rawdata as $weightpoint){
        if($count != 0){
          $line .= ", ";
        }  
        $count++;
    
        $line .= "['" . date("j-M-Y", $weightpoint->weight_tracker_date) . "', {$weightpoint->weight_tracker_value}]";
      }    
      break;
    case 'array':
        $line = array();
        foreach($rawdata as $weightpoint){
          // create array key = x, value = y
          $line[$weightpoint->weight_tracker_date] = $weightpoint->weight_tracker_value;
        }
        ksort($line);
      break;
    case 'exercise':
      $line = array();
      if(count($rawdata) == 0){
        return array();
      }
      
      $xy = array();
      foreach($rawdata as $exercisepoint){
        $xy[$exercisepoint->exercise_tracker_date] = array(
          $exercisepoint->exercise_tracker_mild_duration,
          $exercisepoint->exercise_tracker_moderate_duration,
          $exercisepoint->exercise_tracker_extreme_duration,
        );
      }
      
      ksort($xy);
      
      $startdate = array_shift(array_keys($xy));
      $enddate = array_pop(array_keys($xy));
      
      $startdate = $startdate - (60*60*24);
      $enddate = $enddate + (60*60*48);
      
      $y = date("Y", $startdate);
      $m = date("n", $startdate);
      $d = date("j", $startdate);

      // create parallel arrays, dates and 
      $dates = array();
      while($startdate < $enddate){
	    if(!isset($xy[$startdate])){
	      $xy[$startdate] = array(
	        0,
	        0,
	        0
	      );
	    }
	    $d++;
	    $startdate = mktime(12,0,0,$m,$d,$y);
      }
      
      ksort($xy);

      $line['series'] = "[[";
      
      for($i=0; $i<3; $i++){
        $prefix = "";
        foreach($xy as $date => $array){
          $line['series'] .= $prefix . "['" . date("j-M-Y H:i", ($date)) . "', {$array[$i]}],";
        }
        
        if($i != 2){
          $line['series'] .= "],[";
        }
      }
      
      $line['series'] .= "]]";
      break;
    case 'exerciselist':
      $line = array();
      foreach($rawdata as $exercisepoint){
        $line[$exercisepoint->exercise_tracker_date] = $exercisepoint->exercise_tracker_mild_duration . "/" . $exercisepoint->exercise_tracker_moderate_duration . "/" . $exercisepoint->exercise_tracker_extreme_duration;
      }
      break;
  }
  
  return $line;
}


// returns an array of exercise objects for a given user
function weight_tracker_get_exercise_objects($user){
  if(!($user instanceof ElggUser)){
    return array();
  }
  
  $options = array(
  	'owner_guids' => array($user->guid),
  	'types' => array('object'),
  	'subtypes' => array('exercise_tracker'),
  	'limit' => 0,
  	'order_by_metadata' => array('name' => 'exercise_tracker_date', 'direction' => 'ASC')
  );

  $exercisepoints = elgg_get_entities_from_metadata($options);

  if(is_array($exercisepoints)){
    return $exercisepoints;
  }
  
  return array();
}


// returns an array of weight objects for a given user
function weight_tracker_get_weight_objects($user){
  if(!($user instanceof ElggUser)){
    return array();
  }
  
  $options = array(
  	'owner_guids' => array($user->guid),
  	'types' => array('object'),
  	'subtypes' => array('weight_tracker'),
  	'limit' => 0,
  	'metadata_names' => array('weight_tracker_value'),
  	'order_by_metadata' => array('name' => 'weight_tracker_date', 'direction' => 'ASC')
  );

  $weightpoints = elgg_get_entities_from_metadata($options);

  if(is_array($weightpoints)){
    return $weightpoints;
  }
  
  return array();
}


function weight_tracker_check_ie_pre9(){
  $match=preg_match('/MSIE ([0-9]\.[0-9])/',$_SERVER['HTTP_USER_AGENT'],$reg);
  if($match==0){
    return FALSE;
  }

  $version = floatval($reg[1]);
  
  if($reg[1] < 9){
    return TRUE;
  }
  
  return FALSE;
}




function weight_tracker_hover_menu($hook, $type, $return, $params) {
	$user = $params['entity'];
	
	if (!elgg_instanceof($user, 'user')) {
	  return $return;
	}
	
	if(weight_tracker_graph_access($user)){
	
	  $url = elgg_get_site_url() . "weight_tracker/graph/{$user->username}";
	  $item = new ElggMenuItem("weight_tracker_graph", elgg_echo("weight_tracker"), $url);
	  $item->setLinkClass('elgg-lightbox');
	
	  $return[] = $item;
	}
	
	if(weight_tracker_graph_access($user, 'exercise')){
	  
	  $url = elgg_get_site_url() . "exercise_tracker/graph/{$user->username}";
	  $item = new ElggMenuItem("exercise_tracker_graph", elgg_echo("exercise_tracker"), $url);
	  $item->setLinkClass('elgg-lightbox');
	
	  $return[] = $item;
	}
	
	return $return;
}

// checks whether the current user has permission
// to see the graph of the provided user
function weight_tracker_graph_access($user, $type = 'weight'){
  if($type == 'exercise'){
    $accessname = 'graph:exercise:access';
  }
  else{
    $accessname = 'graph:access';
  }
  
  $access = elgg_get_plugin_user_setting($accessname, $user->guid, 'weight_tracker');
  
  if($access == ACCESS_PUBLIC || elgg_is_admin_logged_in()){
    return TRUE;
  }
  
  if(!elgg_is_logged_in()){
    return FALSE;
  }
  
  // access is set higher than public, and we're logged in
  // check if we qualify
  $permissions = get_access_array();
  
  if(in_array($access, $permissions)){
    return TRUE;
  }
  
  return FALSE;
}


// adds metadata for the users start weight, delta weight
function weight_tracker_update_personal_stats($user){
  $rawdata = weight_tracker_get_weight_objects($user);
  $data = weight_tracker_get_datapoints($rawdata, 'array');
  
  if(count($data) == 0){
    return;
  }
  
  $firstkey = array_shift(array_keys($data));
  $lastkey = array_pop(array_keys($data));
  
  $user->weight_tracker_start_weight = $data[$firstkey];
  $user->weight_tracker_current_weight = $data[$lastkey];
}


function weight_tracker_update_site_stats(){
    $oldaccess = elgg_set_ignore_access(TRUE);
  
  // get start weight
  $options = array(
    'metadata_names' => 'weight_tracker_start_weight',
    'metadata_calculation' => 'SUM',
    'limit' => 0
  );
  
  $startweight = elgg_get_metadata($options);
  
  // get current weight
  $options = array(
    'metadata_names' => 'weight_tracker_current_weight',
    'metadata_calculation' => 'SUM',
    'limit' => 0
  );
  
  $currentweight = elgg_get_metadata($options);
  
  elgg_set_plugin_setting('start_weight', $startweight, 'weight_tracker');
  elgg_set_plugin_setting('current_weight', $currentweight, 'weight_tracker');
  
  elgg_set_ignore_access($oldaccess);
}