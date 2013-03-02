<?php 
/*****************************************************************************
 * Phloor Favicon                                                            *
 *                                                                           *
 * Copyright (C) 2011 Alois Leitner                                          *
 *                                                                           *
 * This program is free software: you can redistribute it and/or modify      *
 * it under the terms of the GNU General Public License as published by      *
 * the Free Software Foundation, either version 2 of the License, or         *
 * (at your option) any later version.                                       *
 *                                                                           *
 * This program is distributed in the hope that it will be useful,           *
 * but WITHOUT ANY WARRANTY; without even the implied warranty of            *
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the             *
 * GNU General Public License for more details.                              *
 *                                                                           *
 * You should have received a copy of the GNU General Public License         *
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.     *
 *                                                                           *
 * "When code and comments disagree both are probably wrong." (Norm Schryer) *
 *****************************************************************************/ 
?>
<?php 

/**
 * Default attributes
 * 
 * @return array with default values
 */
function phloor_custom_favicon_default_vars() {
	$defaults = array(
		'favicon'   => '',
		'mime'   => '',
	    'time' => time(),
	    'delete' => 'no',
	);
	
	return $defaults;
}

/**
 * Load vars from post or get requests and returns them as array
 * 
 * @return array with values from the request
 */
function phloor_custom_favicon_get_input_vars() {
	$input_var_prefix = 'phloor_custom_favicon_';
	
	// get default values
	$defaults = phloor_custom_favicon_default_vars();
	
	$params = array();
	foreach($defaults as $key => $default_value) {
		$var_name = $input_var_prefix . $key;
		
		if($key == 'favicon') {
			// read favicon from files
			$params['favicon'] = $_FILES[$var_name];
		}
		else {
			$params[$key] = get_input($var_name, $default_value);
		}
	}
	
	return $params;
}

/**
 * Load vars from given site into and returns them as array
 * 
 * @return array with stored values
 */
function phloor_custom_favicon_prepare_vars(ElggSite $site) {
	// get default values
	$defaults = phloor_custom_favicon_default_vars();

	$params = array();
	// decode settings if existing
	if(isset($site->phloor_custom_favicon_settings)) {
		$params = json_decode($site->phloor_custom_favicon_settings, true);
	}
	// merge default with given params
	$vars = array_merge($defaults,  $params);
	
	return $vars;
}

/**
 * Load vars from given site into and returns them as array
 * 
 * @return array with stored values
 */
function phloor_custom_favicon_save_vars($site, $params = array()) {
	global $CONFIG;
	
	// get default values
	$defaults = phloor_custom_favicon_default_vars();
	// merge with params	
	$vars = array_merge($defaults, $params);
	// check variables
	if(!phloor_custom_favicon_check_vars($vars)) {
		return false;
	}
	
	// store as an  json encoded attribute of the site entity
	$site->phloor_custom_favicon_settings = json_encode($vars);
	
	// save site and return status
	return $site->save();
}

function phloor_custom_favicon_check_vars(&$params) {
	global $CONFIG;

	if ($params['delete'] == 'yes') {
		$params['favicon'] = '';
	}
	
	// create data directory if not exists
	if (!file_exists(elgg_get_data_path() . 'favicon')) {
		if(!mkdir(elgg_get_data_path() . 'favicon')) {
			register_error(elgg_echo('phloor_custom_favicon:couldnotcreatefavicondir'));
			return false;
		}
		
		system_message(elgg_echo('phloor_custom_favicon:favicondircreated'));
	}
	
	if (isset($params['favicon']) && !empty($params['favicon']) && $params['favicon']['error'] != 4) {
		$mime = array(	
			'image/vnd.microsoft.icon' => 'ico',
			'image/x-icon' => 'ico',
		);  
	
		if (!array_key_exists($params['favicon']['type'], $mime)) {
			register_error(elgg_echo('phloor_custom_favicon:favicon_mime_type_not_supported', array(
				$params['favicon']['type'],
			)));
			return false;
		}
		if ($params['favicon']['error'] != 0) {
			register_error(elgg_echo('phloor_custom_favicon:upload_error', 
				array($params['favicon']['error'])));
			return false;
		}
		
		$tmp_filename = $params['favicon']['tmp_name'];
		$params['mime'] = $params['favicon']['type'];
		$params['favicon'] = 'favicon.' . $mime[$params['mime']];
		
		// move the file to the data directory
		$move = move_uploaded_file($tmp_filename, elgg_get_data_path() . 'favicon/' . $params['favicon']);
		// report errors if that did not succeed
		if(!$move) {
			register_error(elgg_echo('phloor_custom_favicon:coultnotmoveuploadedfile'));
			return false;
		}
	}
	
	unset($params['delete']);
	
	return true;
}

