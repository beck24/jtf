<?php

function jtf_tweaks_init(){
	global $CONFIG;
	
	// Load the language file
	register_translations($CONFIG->pluginspath . "jtf_tweaks/languages/");
	
	// extend css
	elgg_extend_view('css/elgg', 'jtf_tweaks/css', 9000);
    elgg_register_plugin_hook_handler('index', 'system', 'jtf_tweaks_custom_index');
    
    elgg_register_event_handler('pagesetup', 'system', 'jtf_tweaks_pagesetup_handler', 1000);
    
    elgg_extend_view('page/layouts/content/header','jtf_tweaks/header_ads');
    elgg_extend_view('page/elements/footer','jtf_tweaks/footer_ads');
}

function jtf_tweaks_custom_index($hook, $type, $return, $params){
	if ($return == true) {
		// another hook has already replaced the front page
		return $return;
	}
  
	if (!include_once("pages/index.php")) {
		return false;
	}
  
  return TRUE;
}


function jtf_tweaks_pagesetup_handler(){
  elgg_unregister_menu_item('footer', 'copyright_this');
}

elgg_register_event_handler('init', 'system', 'jtf_tweaks_init');