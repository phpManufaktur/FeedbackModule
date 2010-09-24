<?php

/**
  Module developed for the Open Source Content Management System Website Baker (http://websitebaker.org)
  Copyright (c) 2008, Ralf Hertsch
  Contact me: hertsch(at)berlin.de, http://ralf-hertsch.de

  This module is free software. You can redistribute it and/or modify it
  under the terms of the GNU General Public License  - version 2 or later,
  as published by the Free Software Foundation: http://www.gnu.org/licenses/gpl.html.

  This module is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.
**/

/**
 * History:
 *
 * 0.21 - 22.01.2008
 * added:         Searching feature
 *
 * 0.22 - 19.02.2008
 * added:         EN.php
 * fixed:         checking if class.parser.php is already loaded
 *
 * 0.23 - 23.02.2008
 * fixed:         call undefined $_REQUEST['fb_action']
 *
 * 0.24 - 28.02.2008
 * fixed:         security lack enables Cross Site Scripting
 *
 * 0.25 - 29.02.2008
 * added:         extended captcha support for WB 2.7.x
 *
 * 0.26 - 08.03.2008
 * fixed:         date/time string EN.php
 * changed:       moved email body from template to language file
 * fixed:         backend don't show actual email address after changing
 *
 * 0.27 - 30.03.2008
 * fixed:         WB 2.7: extended captcha don't show calculation operator
 * added:         option to check comments before publishing
 * added:         help function for backend
 *
 * 0.28 - 30.03.2008
 * fixed:         Problem detecting if user is authenticated
 *
 * 0.29 - 02.05.2008
 * added:         NL.php, many thanks to Ad Kalle for translation
 * 
 * 0.30 - 02.04.2010
 * fixed:         XSS security patch
 *
 * 0.31 - 07.09.2010
 * fixed:         Datetime format in NL.php
 * fixed:         deprecated functions in class.parser.php
 */

$module_directory 	= 'feedback';
$module_name 			  = 'Feedback';
$module_function 		= 'page';
$module_version 		= '0.31';
$module_platform 		= '2.6.x';

$module_author 		   = 'Ralf Hertsch - rh@phpmanufaktur.de';
$module_license 		 = 'GNU General Public License';
$module_description  = 'Allows visitors to comment pages directly from the frontend.';
$module_home         = 'http://phpManufaktur.de';
$module_guid         = '7CFFACA0-DAEB-4E0B-AA42-C3AA65B69273';

?>