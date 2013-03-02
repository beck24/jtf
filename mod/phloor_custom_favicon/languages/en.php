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

$english = array(
	"admin:plugins:category:PHLOOR" => "PHLOOR Plugins",
	'admin:appearance:phloor_custom_favicon' => 'Favicon',
	
	'phloor_custom_favicon:title' => "Upload favicon",
	
	'phloor_custom_favicon:description' => "Upload a custom favicon for your site. Allowed mimetypes are 'image/x-icon' and 'image/vnd.microsoft.icon'. ",
	
	'phloor_custom_favicon:save:success' => 'Settings successfully saved.',
	'phloor_custom_favicon:save:failure' => 'Settings could not be saved.',

	'phloor_custom_favicon:form:section:favicon' => 'Favicon',

	'phloor_custom_favicon:favicon:label' => 'Upload your facivon',
	'phloor_custom_favicon:favicon:description' => 'Select the file you would like to set as site favicon. In order to fit into the header section consider the height and width of the image. ',

	'phloor_custom_favicon:delete:label' => 'Remove favicon',
	'phloor_custom_favicon:delete:description' => 'If you tick this box the favicon will be removed. ',

	'phloor_custom_favicon:favicondircreated' => "The directory 'favicon/' has been created in the data directory. ",
	'phloor_custom_favicon:couldnotcreatefavicondir' => "Could not create the directory 'favicon/' in the data directory. ",
	'phloor_custom_favicon:coultnotmoveuploadedfile' => "Could not move the uploaded file into 'favicon/' in the data directory. ",

	'phloor_custom_favicon:upload_error' => "Upload Error: %s ",
	'phloor_custom_favicon:favicon_mime_type_not_supported' => "The mimetype of the file ('%s') is not supported. Please use 'image/x-icon' or 'image/vnd.microsoft.icon'. ",

);

add_translation("en", $english);
