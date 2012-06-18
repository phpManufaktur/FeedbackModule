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

if(!file_exists(WB_PATH .'/modules/feedback/languages/' .LANGUAGE .'.php')) {
	require_once(WB_PATH .'/modules/feedback/languages/DE.php');
} else {
	require_once(WB_PATH .'/modules/feedback/languages/' .LANGUAGE .'.php');
}

require_once('class.feedback.php');

global $admin;
global $database;

/**
 * 0.21
 * Suchfunktion eingefuegt
 */
$oldErrorReporting = error_reporting(0);
$sql_result = $database->query("SELECT * FROM ".TABLE_PREFIX."search WHERE name='module' AND value='feedback'");
error_reporting($oldErrorReporting);
if ($database->is_error()) {
  $admin->print_error(sprintf(fb_error_upgrade, '0.21 - Searchfunction', $database->get_error())); }
if ($sql_result->numRows() < 1) {
  // Suchfunktion ist noch nicht installiert
  $feedback = new sql_feedback();
  if (!$feedback->sql_addSearchFeature()) {
    $admin->print_error($feedback->error);  }
}

/**
 * 0.25
 * Aenderung CAPTCHA, alte Dateien entfernen
 */
$thisFile = WB_PATH. '/modules/feedback/htt/frontend.dialog.captcha.htt';
if (file_exists($thisFile)) {
  if (!unlink($thisFile)) {
    $admin->print_error(sprintf(fb_error_delete_file, $thisFile));
  }
}

$thisFile = WB_PATH. '/modules/feedback/captcha.php';
if (file_exists($thisFile)) {
  if (!unlink($thisFile)) {
    $admin->print_error(sprintf(fb_error_delete_file, $thisFile));
  }
}

/**
 * 0.26
 * E-Mail body in Sprachdateien uebernommen, Template entfernen
 */
$thisFile = WB_PATH. '/modules/feedback/htt/mail.htt';
if (file_exists($thisFile)) {
  if (!unlink($thisFile)) {
    $admin->print_error(sprintf(fb_error_delete_file, $thisFile));
  }
}

/**
 * 0.27
 * Datenbanken fuer manuelle Freischaltung der Feedbacks erweitert
 */
$thisQuery = "DESCRIBE ".TABLE_PREFIX."mod_feedback";
$oldErrorReporting = error_reporting(0);
$sql_result = $database->query($thisQuery);
error_reporting($oldErrorReporting);
if ($database->is_error()) {
	// Fehlermeldung anzeigen
	$admin->print_error(sprintf(fb_error_upgrade, '0.27 - Adding Fields', $database->get_error()));  }
else {
	$fields = array();
	$searchField = 'active';
	while (false !== ($data = $sql_result->fetchRow())) {
		$fields[] = $data["Field"];	}
	if (!in_array($searchField, $fields)) {
		// Tabelle muss ergaenzt werden
		$thisQuery = "ALTER TABLE ".TABLE_PREFIX."mod_feedback ADD active TINYINT(1) NOT NULL DEFAULT 1, ADD activation_code VARCHAR(50) NOT NULL DEFAULT '', ADD activation_stamp INT(11) NOT NULL DEFAULT 0";
		$oldErrorReporting = error_reporting(0);
		$sql_result = $database->query($thisQuery);
		error_reporting($oldErrorReporting);
		if ($database->is_error()) {
			// Fehler beim Einfuegen des Feldes
			$admin->print_error(sprintf(fb_error_upgrade, '0.27 - Adding Fields', $database->get_error())); }
	}
}

$thisQuery = "DESCRIBE ".TABLE_PREFIX."mod_feedback_options";
$oldErrorReporting = error_reporting(0);
$sql_result = $database->query($thisQuery);
error_reporting($oldErrorReporting);
if ($database->is_error()) {
	// Fehlermeldung anzeigen
	$admin->print_error(sprintf(fb_error_upgrade, '0.27 - Adding Fields', $database->get_error()));  }
else {
	$fields = array();
	$searchField = 'publish_immediately';
	while (false !== ($data = $sql_result->fetchRow())) {
		$fields[] = $data["Field"];	}
	if (!in_array($searchField, $fields)) {
		// Tabelle muss ergaenzt werden
		$thisQuery = "ALTER TABLE ".TABLE_PREFIX."mod_feedback_options ADD publish_immediately TINYINT(1) NOT NULL DEFAULT 1";
		$oldErrorReporting = error_reporting(0);
		$sql_result = $database->query($thisQuery);
		error_reporting($oldErrorReporting);
		if ($database->is_error()) {
			// Fehler beim Einfuegen des Feldes
			$admin->print_error(sprintf(fb_error_upgrade, '0.27 - Adding Fields', $database->get_error())); }
	}
}

// Upgrade durchgefuehrt
$admin->print_success(fb_backend_success_upgrade);

?>