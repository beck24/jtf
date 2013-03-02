<?php
// register entity subtype for exercise tracker
if(!get_subtype_id('object', 'exercise_tracker')){
  add_subtype('object', 'exercise_tracker');
}

if(!get_subtype_id('object', 'weight_tracker')){
  add_subtype('object', 'weight_tracker');
}

// if a previous version was installed, upgrade the weight tracker annotations to objects
$annotations = elgg_get_annotations(array('annotation_names' => array('weight_tracker'), 'limit' => 0));

if(is_array($annotations)){
  foreach($annotations as $annotation){
    $data = explode(":", $annotation->value);
    
    $datapoint = new ElggObject();
    $datapoint->subtype = "weight_tracker";
    $datapoint->title = "Weight Tracker";
    $datapoint->description = "Weight Tracking Data Point";
    $datapoint->container_guid = $annotation->owner_guid;
    $datapoint->access_id = $annotation->access_id;
    $datapoint->owner_guid = $annotation->owner_guid;
    $datapoint->weight_tracker_value = $data[1];
    $datapoint->weight_tracker_date = $data[0];
    $datapoint->save();
    
    $annotation->delete();
  }
}