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

$module_directory = 'feedback';
$module_name = 'Feedback';
$module_function = 'page';
$module_version = '0.34';
$module_platform = '2.6.x';
$module_author = 'Ralf Hertsch, Berlin (Germany)';
$module_license = 'MIT license (MIT)';
$module_description = 'Allows visitors to comment pages directly from the frontend.';
$module_home = 'http://phpManufaktur.de';
$module_guid = '7CFFACA0-DAEB-4E0B-AA42-C3AA65B69273';