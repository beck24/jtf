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

// only admins are allowed to see the page
admin_gatekeeper();

// get the site entity 
$site = elgg_get_site_entity();
// get site name
$site_name = htmlentities($site->name);
// prepare variables
$params = phloor_custom_favicon_prepare_vars($site);

$title = elgg_view_title(elgg_echo('phloor_custom_favicon:title')); 
$description = elgg_echo('phloor_custom_favicon:description'); 
$form = elgg_view('input/form',array(	
	'action' => $vars['url'] . 'action/phloor_custom_favicon/save',
	'body' => elgg_view('forms/phloor_custom_favicon/save', array(
		'favicon' => $params['favicon'],
	)),
	'method' => 'post',
	'enctype' => 'multipart/form-data',

));

$img = '';	
// if favicon is set -> display it!
if (!empty($params['favicon'])) {
	$favicon_ext = array_pop(explode('/', $params['mime']));
	$favicon_url = "{$vars['url']}favicon/{$params['time']}.$favicon_ext";
	// set image	
	$img = <<<___HTML
<img class="phloor_custom_favicon" src="{$favicon_url}" alt="{$site_name}" />
___HTML;
}

echo <<<___HTML
{$title}
<p>{$description}</p>
<p>{$img}</p>
<div id="phloor-custom-favicon-form">
{$form}
</div>
___HTML;

?>