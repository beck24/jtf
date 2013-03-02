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

// restrict action to admin users
admin_gatekeeper();

// get site entity
$site = elgg_get_site_entity();

// load vars from post requests 
$params = phloor_custom_favicon_get_input_vars();

// save the settings and display success message
if(phloor_custom_favicon_save_vars($site, $params)) {
	system_message(elgg_echo('phloor_custom_favicon:save:success'));
}
// ... or display an error message on failure
else {
	register_error(elgg_echo('phloor_custom_favicon:save:failure'));
}

// back o da bus
forward($_SERVER['HTTP_REFERER']);
