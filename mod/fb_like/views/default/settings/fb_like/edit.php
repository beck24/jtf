<?php

/* ***********************************************************************
 * @author : Purusothaman Ramanujam
 * @link http://www.iYaffle.com/
 * Under this agreement, No one has rights to sell this script further.
 * ***********************************************************************/

	$senddata    = $vars['entity']->senddata;
	$showfaces   = $vars['entity']->showfaces;
	$action      = $vars['entity']->action;
	$layout      = $vars['entity']->layout;
	$width       = $vars['entity']->width;
        $colorscheme = $vars['entity']->colorscheme;
        $font        = $vars['entity']->font;

?>

<br/>

<table border="0">
<tr>
    <td height=40> 
        <b><?php echo elgg_echo('fb-like:lblLayout'); ?></b><br/>
     </td>

     <td>:</td>

     <td height=40>
         <?php echo elgg_view('input/dropdown', array(
	                      'name' => 'params[layout]',
	                      'options_values' => array(
		                                  'standard'     => elgg_echo('fb-like:lblStandard'),
		                                  'button_count' => elgg_echo('fb-like:lblHorizontal'),
		                                  'box_count'    => elgg_echo('fb-like:lblVertical')),
	                      'value' => $vars['entity']->layout,)); 
         ?>
     </td>
</tr>

<tr>
    <td height=40> 
        <b><?php echo elgg_echo('fb-like:lblSendData'); ?></b><br/>
     </td>

     <td>:</td>

     <td height=40>
         <?php echo elgg_view('input/dropdown', array(
	                      'name' => 'params[senddata]',
	                      'options_values' => array(
		                                  'true' => elgg_echo('fb-like:lblYes'),
		                                  'false' => elgg_echo('fb-like:lblNo')),
	                      'value' => $vars['entity']->senddata,)); 
         ?>
     </td>
</tr>

<tr>
    <td height=40> 
        <b><?php echo elgg_echo('fb-like:lblShowFaces'); ?></b><br/>
     </td>

     <td>:</td>

     <td height=40>
         <?php echo elgg_view('input/dropdown', array(
	                      'name' => 'params[showfaces]',
	                      'options_values' => array(
		                                  'true' => elgg_echo('fb-like:lblYes'),
		                                  'false' => elgg_echo('fb-like:lblNo')),
	                      'value' => $vars['entity']->showfaces,)); 
         ?>
     </td>
</tr>

<tr>
    <td height=40> 
        <b><?php echo elgg_echo('fb-like:lblAction'); ?></b><br/>
     </td>

     <td>:</td>

     <td height=40>
         <?php echo elgg_view('input/dropdown', array(
	                      'name' => 'params[action]',
	                      'options_values' => array(
		                                  'like' => elgg_echo('fb-like:lblLike'),
		                                  'recommend' => elgg_echo('fb-like:lblRecommend')),
	                      'value' => $vars['entity']->action,)); 
         ?>
     </td>
</tr>

<tr>
    <td height=40> 
        <b><?php echo elgg_echo('fb-like:lblWidth'); ?></b><br/>
     </td>

     <td>:</td>

     <td height=40>
         <?php echo elgg_view('input/text', array(
	                      'name' => 'params[width]',
	                      'value' => $vars['entity']->width,));
         ?>
     </td>
</tr>

<tr>
    <td height=40> 
        <b><?php echo elgg_echo('fb-like:lblFont'); ?></b><br/>
     </td>

     <td>:</td>

     <td height=40>
         <?php echo elgg_view('input/dropdown', array(
	                      'name' => 'params[font]',
	                      'options_values' => array(
		                                  'arial'          => elgg_echo('fb-like:lblArial'),
		                                  'lucida grande'  => elgg_echo('fb-like:lblLucida'),
		                                  'segoe ui'       => elgg_echo('fb-like:lblSegoeUI'),
		                                  'tahoma'         => elgg_echo('fb-like:lblTahoma'),
		                                  'trebuchet ms'   => elgg_echo('fb-like:lblTrebuchetMS'),
		                                  'verdana'        => elgg_echo('fb-like:lblVerdana')),
	                      'value' => $vars['entity']->font,)); 
         ?>
     </td>
</tr>

<tr>
    <td height=40> 
        <b><?php echo elgg_echo('fb-like:lblColorScheme'); ?></b><br/>
     </td>

     <td>:</td>

     <td height=40>
         <?php echo elgg_view('input/dropdown', array(
	                      'name' => 'params[colorscheme]',
	                      'options_values' => array(
		                                  'light' => elgg_echo('fb-like:lblLight'),
		                                  'dark'  => elgg_echo('fb-like:lblDark')),
	                      'value' => $vars['entity']->colorscheme,)); 
         ?>
     </td>
</tr>

</table>
<br/>
If the Button Size value is left empty, the default Button Size of 450 will be used. 
<br/>
