<?php

include 'lib/functions.php';

function weight_tracker_init(){
	global $CONFIG;
	
	// Load the language file
	register_translations($CONFIG->pluginspath . "weight_tracker/languages/");
	
	// set up css
	elgg_extend_view('css', 'weight_tracker/css');
	elgg_register_css('weight_tracker/jqplot', elgg_get_site_url() . 'mod/weight_tracker/js/jqplot/jquery.jqplot.min.css');
	elgg_register_css('weight_tracker/fireworks', elgg_get_site_url() . 'mod/weight_tracker/js/fireworks/style/fireworks.css');
	
	
	// Register our javascript
	elgg_register_js('weight_tracker/jqplot/canvas', elgg_get_site_url() . 'mod/weight_tracker/js/jqplot/excanvas.min.js', 'head');
	elgg_register_js('weight_tracker/jqplot', elgg_get_site_url() . 'mod/weight_tracker/js/jqplot/jquery.jqplot.min.js', 'head');
	elgg_register_js('weight_tracker/jqplot/highlighter', elgg_get_site_url() . 'mod/weight_tracker/js/jqplot/plugins/jqplot.highlighter.min.js', 'head');
	elgg_register_js('weight_tracker/jqplot/cursor', elgg_get_site_url() . 'mod/weight_tracker/js/jqplot/plugins/jqplot.cursor.min.js', 'head');
	elgg_register_js('weight_tracker/jqplot/dateaxis', elgg_get_site_url() . 'mod/weight_tracker/js/jqplot/plugins/jqplot.dateAxisRenderer.min.js', 'head');
	elgg_register_js('weight_tracker/jqplot/barRender', elgg_get_site_url() . 'mod/weight_tracker/js/jqplot/plugins/jqplot.barRenderer.min.js', 'head');
	elgg_register_js('weight_tracker/jqplot/categoryAxis', elgg_get_site_url() . 'mod/weight_tracker/js/jqplot/plugins/jqplot.categoryAxisRenderer.min.js', 'head');
	elgg_register_js('weight_tracker/jqplot/pointLabels', elgg_get_site_url() . 'mod/weight_tracker/js/jqplot/plugins/jqplot.pointLabels.min.js', 'head');
	elgg_register_js('weight_tracker/jqplot/canvasAxisLabel', elgg_get_site_url() . 'mod/weight_tracker/js/jqplot/plugins/jqplot.canvasAxisLabelRenderer.min.js', 'head');
	elgg_register_js('weight_tracker/jqplot/canvasText', elgg_get_site_url() . 'mod/weight_tracker/js/jqplot/plugins/jqplot.canvasTextRenderer.min.js', 'head');
	elgg_register_js('weight_tracker/fireworks/sound', elgg_get_site_url() . 'mod/weight_tracker/js/fireworks/script/soundmanager2-nodebug-jsmin.js', 'head');
	elgg_register_js('weight_tracker/fireworks/js', elgg_get_site_url() . 'mod/weight_tracker/js/fireworks/script/fireworks.js', 'head');

	
	if(elgg_is_logged_in()){
	  // add weight tracker to site links
	  $item = new ElggMenuItem('weight_tracker', elgg_echo('weight_tracker:myweight'), elgg_get_site_url() . 'weight_tracker/');
	  elgg_register_menu_item('site', $item);
	  
	  // add weight tracker to site links
	  $item = new ElggMenuItem('exercise_tracker', elgg_echo('weight_tracker:myexercise'), elgg_get_site_url() . 'exercise_tracker/');
	  elgg_register_menu_item('site', $item);
	}
	
	elgg_register_page_handler('weight_tracker', 'weight_tracker_page_handler');
	elgg_register_page_handler('exercise_tracker', 'exercise_tracker_page_handler');
	
	// add link to
	elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'weight_tracker_hover_menu');
	elgg_register_plugin_hook_handler('register', 'menu:user_hover', 'weight_tracker_hover_menu');
	elgg_register_plugin_hook_handler('cron', 'daily', 'weight_tracker_cron');
	
    // register actions
    elgg_register_action('weight_tracker/add', elgg_get_plugins_path() . 'weight_tracker/actions/weight_tracker/add.php');
    elgg_register_action('weight_tracker/delete', elgg_get_plugins_path() . 'weight_tracker/actions/weight_tracker/delete.php');
    elgg_register_action('weight_tracker/access', elgg_get_plugins_path() . 'weight_tracker/actions/weight_tracker/access.php');
    elgg_register_action('weight_tracker/achievement/delete', elgg_get_plugins_path() . 'weight_tracker/actions/weight_tracker/achievement/delete.php');
    
    elgg_register_action('exercise_tracker/add', elgg_get_plugins_path() . 'weight_tracker/actions/exercise_tracker/add.php');
    elgg_register_action('exercise_tracker/delete', elgg_get_plugins_path() . 'weight_tracker/actions/exercise_tracker/delete.php');
    elgg_register_action('exercise_tracker/access', elgg_get_plugins_path() . 'weight_tracker/actions/exercise_tracker/access.php');
    
    if(elgg_get_logged_in_user_entity()->weight_tracker_newachievements){
      elgg_extend_view('page/elements/header', 'weight_tracker/fireworksframe');
      elgg_extend_view('page/elements/footer', 'weight_tracker/newachievement');
    }

    // add widget for achievements
    elgg_register_widget_type('weight_tracker', elgg_echo("weight_tracker:widget:title"), elgg_echo('weight_tracker:widget:description'));
    elgg_register_widget_type('exercise_tracker', elgg_echo("exercise_tracker:widget:title"), elgg_echo('exercise_tracker:widget:description'));
}



function weight_tracker_page_handler($page){
  
  switch ($page[0]){
    case 'graph':
      set_input('username', $page[1]);
      if(include elgg_get_plugins_path() . 'weight_tracker/pages/graph.php'){
        return TRUE;
      }
      break;
    default:
      if(include elgg_get_plugins_path() . 'weight_tracker/pages/weight_tracker.php'){
        return TRUE;
      }
    break;
  }
  
  register_error('There was a problem loading the page');
  return FALSE;
}


function exercise_tracker_page_handler($page){
  
  switch ($page[0]){
    case 'graph':
      set_input('username', $page[1]);
      if(include elgg_get_plugins_path() . 'weight_tracker/pages/exercisegraph.php'){
        return TRUE;
      }
      break;
    default:
      if(include elgg_get_plugins_path() . 'weight_tracker/pages/exercise_tracker.php'){
        return TRUE;
      }
    break;
  }
  
  register_error('There was a problem loading the page');
  return FALSE;
}

register_elgg_event_handler('init', 'system', 'weight_tracker_init');