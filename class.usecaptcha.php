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
 * This class is only for WB 2.7.x so check WB Version first...
 */
if(!defined('VERSION')) {
  include(ADMIN_PATH . '/interface/version.php');
  if (!defined('VERSION')) {
    // assume WB 2.6.x ...
    $version = 2.6; }
  else {
    $version = floatval(VERSION); } }
else {
  $version = floatval(VERSION); }

if ($version > 2.6) {

  if (!isset($MOD_CAPTCHA)) {
    global $MOD_CAPTCHA;
    if(!file_exists(WB_PATH.'/modules/captcha_control/languages/'.LANGUAGE .'.php')) {
	    // no module language file exists for the language set by the user, include default module language file EN.php
	    require_once(WB_PATH.'/modules/captcha_control/languages/EN.php'); }
	  else {
	    // a module language file exists for the language defined by the user, load it
	    require_once(WB_PATH.'/modules/captcha_control/languages/'.LANGUAGE .'.php'); }
  }

  /**
   * Class for use the captcha functions of WB 2.7.x
   *
   */
  class useCaptcha {

    var $time;

    /**
     * Constructor
     * initialize $this->time
     * set $_SESSION['captcha_time']
     *
     * @return useCaptcha
     */
    function useCaptcha() {
      $this->time = time();
      $_SESSION['captcha_time'] = $this->time;
    }

    /**
     * Get WB Version, in case of error assume WB 2.6.x
     *
     * @return FLOAT
     */
    function getWBVersion() {
      if(!defined('VERSION')) {
        // keine Fehlermeldung erwuenscht
        @include(ADMIN_PATH . '/interface/version.php');
        if (!defined('VERSION')) {
          $version = 2.6; }
        else {
          $version = floatval(VERSION); } }
      else {
        $version = floatval(VERSION); }
      return $version;
    }

    /**
     * Return the Captcha for display,
     * depending on the selected CAPTCHA_TYPE
     *
     * @return unknown
     */
    function getCaptcha() {
      global $MOD_CAPTCHA;
      switch (CAPTCHA_TYPE):
      case 'text':
      case 'calc_text':
        ob_start();
        include(WB_PATH.'/include/captcha/captchas/'.CAPTCHA_TYPE.'.php');
        $result = ob_get_contents();
        ob_end_clean();
        return $result;
      case 'calc_image':
      case 'calc_ttf_image':
      case 'ttf_image':
      case 'old_image':
        return '<img src="'. WB_URL.'/include/captcha/captchas/'.CAPTCHA_TYPE.'.php?t='.$this->time.'" alt="Captcha" />';
      default:
        return '<strong>Error</strong>, unknown CAPTCHA_TYPE!';
      endswitch;
    }

    /**
     * Return the explanation depending on the CAPTCHA_TYPE
     *
     * @return unknown
     */
    function getCaptchaExplanation() {
      global $MOD_CAPTCHA;
      switch (CAPTCHA_TYPE):
      case 'text':
        return $MOD_CAPTCHA['VERIFICATION_INFO_QUEST'];
      case 'calc_image':
      case 'calc_ttf_image':
      case 'calc_text':
        return $MOD_CAPTCHA['VERIFICATION_INFO_RES'];
      case 'ttf_image':
      case 'old_image':
        return $MOD_CAPTCHA['VERIFICATION_INFO_TEXT'];
      default:
        return '<strong>Error</strong>, unknown CAPTCHA_TYPE!';
      endswitch;
    }


  } // class useCaptcha

} // WB Version > 2.6

?>