<?php

/**
 * FeedbackModule
 *
 * @author Ralf Hertsch <ralf.hertsch@phpmanufaktur.de>
 * @link http://phpmanufaktur.de
 * @copyright 2007 - 2012
 * @license MIT License (MIT) http://www.opensource.org/licenses/MIT
 */

// include class.secure.php to protect this file and the whole CMS!
if (defined('WB_PATH')) {
  if (defined('LEPTON_VERSION')) include (WB_PATH . '/framework/class.secure.php');
}
else {
  $oneback = "../";
  $root = $oneback;
  $level = 1;
  while (($level < 10) && (!file_exists($root . '/framework/class.secure.php'))) {
    $root .= $oneback;
    $level += 1;
  }
  if (file_exists($root . '/framework/class.secure.php')) {
    include ($root . '/framework/class.secure.php');
  }
  else {
    trigger_error(sprintf("[ <b>%s</b> ] Can't include class.secure.php!", $_SERVER['SCRIPT_NAME']), E_USER_ERROR);
  }
}
// end include class.secure.php

if (!file_exists(WB_PATH .'/modules/feedback/languages/' .LANGUAGE .'.php')) {
	require_once(WB_PATH .'/modules/feedback/languages/DE.php');
} else {
		require_once(WB_PATH .'/modules/feedback/languages/' .LANGUAGE .'.php');
}

require_once('class.feedback.php');

global $admin;

// Feedback
$feedback = new sql_feedback();

if (!$feedback->sql_deleteTable()) {
  $admin->print_error($feedback->error);
}

/**
 * Suchfunktionen entfernen
 */
if (!$feedback->sql_removeSearchFeature()) {
  $admin->print_error($feedback->error);
}

// Optionen
$feedback_options = new sql_feedback_options();

if (!$feedback_options->sql_deleteTable()) {
  $admin->print_error($feedback_options->error);
}

?>