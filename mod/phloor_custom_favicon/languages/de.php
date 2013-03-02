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

$german = array(
	"admin:plugins:category:PHLOOR" => "PHLOOR Plugins",
	'admin:appearance:phloor_custom_favicon' => 'Favicon',
	
	'phloor_custom_favicon:title' => "Favicon Upload",
	
	'phloor_custom_favicon:description' => "Hier können Sie ein eigenes Favicon hochladen. Unterstützte Mimetypes sind 'image/x-icon' und 'image/vnd.microsoft.icon'. ",
	
	'phloor_custom_favicon:save:success' => 'Einstellungen erfolgreich gespeichert. ',
	'phloor_custom_favicon:save:failure' => 'Einstellungen konnten nicht gespeichert werden. ',

	'phloor_custom_favicon:form:section:favicon' => 'Favicon',

	'phloor_custom_favicon:favicon:label' => 'Laden Sie Ihr Favicon hoch',
	'phloor_custom_favicon:favicon:description' => 'Wählen Sie die Datei die Sie als Favicon einstellen wollen. Um in den Header der Seite zu passen, wählen Sie bitte eine geeignete Größe für das Favicon. ',

	'phloor_custom_favicon:delete:label' => 'Favicon entfernen',
	'phloor_custom_favicon:delete:description' => 'Bei Aktivierung dieser Checkbox wird das momentane Favicon entfernt. ',

	'phloor_custom_favicon:favicondircreated' => "Das Verzeichnis 'favicon/' wurde im Daten-Ordner angelegt. ",
	'phloor_custom_favicon:couldnotcreatefavicondir' => "Der Ordner 'favicon/' konnte im Daten-Verzeichnis nicht angelegt werden. ",
	'phloor_custom_favicon:coultnotmoveuploadedfile' => "Die Datei konnte nicht in das Verzeichnis 'favicon/' im Daten-Ordner verschoben werden. ",

	'phloor_custom_favicon:upload_error' => "Upload Fehler: %s ",
	'phloor_custom_favicon:favicon_mime_type_not_supported' => "Der Mimetype der Datei ('%s') wird nicht unterstützt. Bitte benützen Sie 'image/x-icon' oder 'image/vnd.microsoft.icon'. ",
);

add_translation("de", $german);
