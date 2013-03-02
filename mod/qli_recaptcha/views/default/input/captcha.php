<?php
	/**
	 * Elgg recaptcha plugin graphics generator
	 * 
	 * @package ElggCaptcha
	 * @author Shyfti.com
	 * @copyright 2011 shyfti.com
	 */

	global $CONFIG;

	require_once("recaptchalib.php");
	$publickey = get_plugin_setting('publickey', 'qli_recaptcha');

	$reCAPTCHA = "	<script type='text/javascript'>
		var RecaptchaOptions = {
			custom_translations : {
					instructions_visual : '" . elgg_echo('captcha:instructions_visual') . "',
					instructions_audio : '" . elgg_echo('captcha:instructions_audio') . "',
					play_again : '" . elgg_echo('captcha:play_again') . "',
					cant_hear_this : '" . elgg_echo('captcha:cant_here_this') . "',
					visual_challenge : '" . elgg_echo('captcha:visual_challenge') . "',
					audio_challenge : '" . elgg_echo('captcha:audio_challenge') . "',
					refresh_btn : '" . elgg_echo('captcha:refresh_btn') . "',
					help_btn : '" . elgg_echo('captcha:help_btn') . "',
					incorrect_try_again : '" . elgg_echo('captcha:incorrect_try_again') . "',
					},
			lang : '" . elgg_echo('captcha:language') . "', // Unavailable while writing this code (just for audio challenge)
			theme : '" . elgg_echo('captcha:theme') . "',
			};
	</script>
";
	$reCAPTCHA .= recaptcha_get_html($publickey);
		
	echo $reCAPTCHA;

?>