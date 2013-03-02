<?php
	/**
	 * Elgg recaptcha plugin
	 * 
	 * @package ElggCaptcha
	 	 * @author Shyfti.com
	 * @copyright 2011 shyfti.com
	 */


	function captcha_init()
	{
		global $CONFIG;
		
		// Register page handler for captcha functionality
		register_page_handler('captcha','captcha_page_handler');
		
		// Register a function that provides some default override actions
		register_plugin_hook('actionlist', 'captcha', 'captcha_actionlist_hook');
		
		// Register actions to intercept
		$actions = array();
		$actions = trigger_plugin_hook('actionlist', 'captcha', null, $actions);
		
		if (($actions) && (is_array($actions)))
		{
			foreach ($actions as $action)
				register_plugin_hook("action", $action, "captcha_verify_action_hook");
		}
	}
	
	function captcha_page_handler($page) 
	{
		global $CONFIG;
		
		if (isset($page[0])) {
			set_input('captcha_token',$page[0]);
		}

		include($CONFIG->pluginspath . "captcha/captcha.php");
	}
	
	/**
	 * Verify a captcha based on the input value entered by the user and the seed token passed.
	 *
	 * @param string $recaptcha_challenge_field
	 * @param string $recaptcha_response_field
	 * @return bool
	 */
	function captcha_verify_captcha($recaptcha_challenge_field, $recaptcha_response_field)
	{

	 	require_once(dirname(dirname(__FILE__)) . "/qli_recaptcha/views/default/input/recaptchalib.php");
		$privatekey = get_plugin_setting('privatekey', 'qli_recaptcha');
		$resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $recaptcha_challenge_field,
                                $recaptcha_response_field);

		if (!$resp->is_valid) {
			return false;
		}else{
			return true;
		}
			
		
	}
	
	/**
	 * Listen to the action plugin hook and check the captcha.
	 *
	 * @param unknown_type $hook
	 * @param unknown_type $entity_type
	 * @param unknown_type $returnvalue
	 * @param unknown_type $params
	 */
	function captcha_verify_action_hook($hook, $entity_type, $returnvalue, $params)
	{
		$recaptcha_challenge_field = get_input('recaptcha_challenge_field');
		$recaptcha_response_field = get_input('recaptcha_response_field');
		
		if (captcha_verify_captcha($recaptcha_challenge_field, $recaptcha_response_field)){
			return true;
		}
		register_error(elgg_echo('captcha:captchafail'));
			
		return false;
	}
	
	/**
	 * This function returns an array of actions the captcha will expect a captcha for, other plugins may
	 * add their own to this list thereby extending the use.
	 *
	 * @param unknown_type $hook
	 * @param unknown_type $entity_type
	 * @param unknown_type $returnvalue
	 * @param unknown_type $params
	 */
	function captcha_actionlist_hook($hook, $entity_type, $returnvalue, $params)
	{
		if (!is_array($returnvalue))
			$returnvalue = array();
			
		$returnvalue[] = 'register';
		$returnvalue[] = 'user/requestnewpassword';
			
		return $returnvalue;
	}
	
	register_elgg_event_handler('init','system','captcha_init');
?>