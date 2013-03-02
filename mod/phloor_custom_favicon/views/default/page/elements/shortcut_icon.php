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
 * Creates the favicon link in the header
 */

// get site entity
$site = elgg_get_site_entity();
// get settings
$params = phloor_custom_favicon_prepare_vars($site);

$favicon      = $params['favicon'];
$favicon_time = $params['time'];
$favicon_mime = $params['mime'];

$content = '';

// default settings for the elgg_favicon
$params = array(
	'href' => elgg_get_site_url() . '_graphics/favicon.ico',
	'mime' => 'image/vnd.microsoft.icon',
);

// if favicon is set.. apply its parameters
if (!(empty($favicon) || empty($favicon_time) || empty($favicon_mime))) {
	$params['href'] = "{$vars['url']}favicon/$favicon_time.ico";
	$params['mime'] = $favicon_mime;
}

// create the link string
$content = <<<HTML
<link rel="SHORTCUT ICON" type="{$params['mime']}" href="{$params['href']}">
HTML;

// display content
echo $content;
