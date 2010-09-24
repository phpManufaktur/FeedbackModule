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

// prevent this file from being accesses directly
if(defined('WB_PATH') == false) {
	exit("Cannot access this file directly");
}

if(!file_exists(WB_PATH .'/modules/feedback/languages/' .LANGUAGE .'.php')) {
	require_once(WB_PATH .'/modules/feedback/languages/DE.php');
} else {
		require_once(WB_PATH .'/modules/feedback/languages/' .LANGUAGE .'.php');
}

if(!function_exists('register_frontend_modfiles') && file_exists(WB_PATH .'/modules/feedback/frontend.css')) {
	echo '<style type="text/css">';
	include(WB_PATH .'/modules/feedback/frontend.css');
	echo "\n</style>\n";
}

$lib = get_included_files();
foreach ($lib as $value) { $library[] = basename($value); }
if (!in_array('class.parser.php',$library)) {
  require_once(WB_PATH.'/modules/feedback/class.parser.php'); }

require_once(WB_PATH.'/modules/feedback/class.feedback.php');

//error_reporting(E_ALL);

@session_start();

$feedback = new feedback_view_dlg($page_id, $section_id);
$feedback->action();

?>