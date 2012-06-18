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

define('fb_not_implemented',									'<p><strong>Denne funksjonen er ikke tatt i bruk enda.</strong></p>');

define('fb_error_add_record',						      '<p>En feil oppsto ved lagring av innlegget.</p><p>[%s] <strong>%s</strong></p>');
define('fb_error_add_search_feature',         '<p>En feil oppsto ved innlegging av feedback-modulen i s&oslash;ke tabellen.</p><p>[%s] <strong>%s</strong></p>');
define('fb_error_already_published',					'Kommentaren med ID <strong>%u</strong> er allerede ul&aring;st og publisert p&aring; %s.');
define('fb_error_create_table',               '<p>En feil oppsto ved lagring av ny tabell</p><p>[%s] <strong>%s</strong></p>');
define('fb_error_delete_file',								'<p>Feil ved sletting av fil <strong>%s</strong>');
define('fb_error_delete_record',							'<p>Feil ved sletting av innlegg</p><p>[%s] <strong>%s</strong></p>');
define('fb_error_delete_table',               '<p>En feil oppsto ved sletting av tabell</p><p>[%s] <strong>%s</strong></p>');
define('fb_error_double_body',								'Dette innlegget aksisterer allerede.');
define('fb_error_empty_email',								'Fyll inn e-post adresse!');
define('fb_error_get_defaults',               'Feil ved lesing av standardverdiene: <strong>%s</strong>');
define('fb_error_header',                     'Feil i Feedback-Modulen');
define('fb_error_invalid_captcha',						'Identifikasjonen stemmer ikke, vennligst pr&oslash;v igjen!');
define('fb_error_invalid_code_for_publish',		'Identifikasjonen stemmer ikke, innlegget kan derfor ikke publiseres!');
define('fb_error_invalid_email',							'E-postadessen <strong>%s</strong> er feil, vennligst skriv den inn p&aring; nytt!');
define('fb_error_invalid_header',							'Emne <strong>%s</strong> er for kort, det m&aring; inneholde minst %u tegn!');
define('fb_error_invalid_id_for_publish',			'Kommentaren med ID <strong>%s</strong> eksisterer ikke og kan ikke publiseres!');
define('fb_error_invalid_name',								'Navnet <strong>%s</strong> inneholder mindre enn %u tegn, skriv navnet p&aring; nytt!');
define('fb_error_invalid_text',								'Din kommentar <strong>%s</strong> er for kort, det m&aring; minst ha %u tegn!');
define('fb_error_no_error',                   'Ingen feil');
define('fb_error_not_specified',              'ikke spesifisert');
define('fb_error_reading_records',						'<p>En feil oppsto ved lesing av innlegg</p><p>[%s] <strong>%s</strong></p>');
define('fb_error_remove_search_feature',      '<p>En feil oppsto ved fjerning av søkefunksjon</p><p>[%s] <strong>%s</strong>');
define('fb_error_record_not_exists',					'Oppf&oslash;ringen [<strong>%05d</strong>] eksisterer ikke!');
define('fb_error_update_record',							'<p>En feil oppsto ved oppdatering av innlegget</p><p>[%s] <strong>%s</strong></p>');
define('fb_error_upgrade',                    '<p>En feil oppsto ved oppgraderingen av feedback-modulen:</p><p>[%s] <strong>%s</strong></p>');

define('fb_backend_comment',									'<strong>%s</strong> skrevet %s:<br>%s');
define('fb_backend_comment_header',						'Kommentar fra administrator');
define('fb_backend_comment_intro',						'<strong>Her kan du kommentere brukerinnlegg.</strong>');
define('fb_backend_edit_intro',								'<p><strong>Her kan du redigere brukerinnlegg.</strong></p><p>V&aelig;r oppmerksom p&aring; at du da opptrer som moderator av innlegg!!!</p>');
define('fb_backend_header',                   'Feedback-Module');
define('fb_backend_info_email',								'Send e-post ved nytt innlegg');
define('fb_backend_intro',										'<p>Les/slett eller kommenter innlegg.</p>');
define('fb_backend_latest_first',							'Vis innlegg synkende');
define('fb_backend_no_feedbacks',							'<p>ingen kommentarer p&aring; denne siden</p>');
define('fb_backend_options_updated',					'Valg for feedback-modulen n&aring;r oppdatert.');
define('fb_backend_publish_immediately',			'Nye innlegg vil bli publisert umiddelbart.');
define('fb_backend_success_delete',						'Innlegget [<strong>%05d</strong>] ble slettet.');
define('fb_backend_success_update',						'Innlegget [<strong>%05d</strong>] ble oppdatert.');
define('fb_backend_success_upgrade',          'Oppgradering av feedback-modulen var vellykket.');

define('fb_frontend_comment_header',					'<a href="mailto:%s">%s</a> skrevet %s:');
define('fb_frontend_header',									'Vi vil gjerne høre dine kommentarer og meninger.');
define('fb_frontend_intro',										'Fortell leserne av %s <strong><a href="%s">dine meninger her.</strong></a>.');

define('fb_captcha_explain',									'Verifikasjon: Skriv inn bokstavene i bildet:');
define('fb_dialog_intro',											'Alle felt må fylles ut.<br />Din e-postadresse <strong>vil ikke bli publisert.</strong><br /><strong>HTML</strong> kode kan ikke benyttes.');

define('fb_feedback_added',										'Takk for ditt innlegg!');
define('fb_feedback_datetime',								'j. F, Y - h:i A');
define('fb_feedback_item_sender',							'<strong>%s</strong> skrev den %s:');
define('fb_feedback_not_published_immediately','Takk for innlegget ditt. Etter sjekk av modeartor vil det bli publisert. Du vil motta en e-post n&aring;r det er publisert.');
define('fb_feedback_published_ok',						'Dette innlegget blir n&aring; publisert og den som har skrevet det f&aring;r tilsendt en e-post om at det er publisert.');
define('fb_feedback_published_no_mail',				'Dette innlegget blir n&aring; publisert, men den som har skrevet det f&aring;r ikke tilsendt en e-post om at det er publisert fordi e-postadresse mangler.');

define('fb_mail_subject',											'[Tilbakemelding] %s');
define('fb_mail_body',												"Siden %s\r\n\nble kommentert av %s at %s\r\n\nmed f&oslash;lgende tilbakemelding:\r\n\n%s\r\n\n******************************************************\r\nAUTOMATISK BESKJED FRA TILBAKEMELDINGSMODULEN\r\n******************************************************");
define('fb_mail_body_activate',								"Siden %s\r\n\nble kommentert av %s at %s\r\n\nmed f&oslash;lgende tilbakemelding:\r\n\n%s\r\n\nTilbakemeldingen er forel&oslash;pig ikke publisert, men du kan aktivere innlegget med denne lenken:\r\n\n--> %s\r\n\n******************************************************\r\nAUTOMATISK BESKJED FRA TILBAKEMELDINGSMODULEN\r\n******************************************************");
define('fb_mail_body_published',							"Tilbakemeldingen din p&aring; hjemmesiden %s med f&oslash;lgende innhold:\r\n\n%s\r\n\nble akurat l&aring;st opp av en av moderatorene og publisert p&aring; hjemmesiden:\r\n\n--> %s\r\n\nVi takker for tilbakemeldingen din!\r\n\n******************************************************\r\nAUTOMATISK BESKJED FRA TILBAKEMELDINGSMODULEN\r\n******************************************************");

define('fb_title_email',											'e-postadressen din:');
define('fb_title_header',											'Emne:');
define('fb_title_name',												'Ditt navn:');
define('fb_title_text',												'Din kommentar:');

define('fb_btn_abort',												'Avbryt');
define('fb_btn_activate',											'Aktiver');
define('fb_btn_captcha_reload',								'Bytt grafikk...');
define('fb_btn_comment',											'Kommenter');
define('fb_btn_delete',												'Slett');
define('fb_btn_edit',													'Rediger');
define('fb_btn_help',													'Hjelp');
define('fb_btn_options',                      'Bytt...');
define('fb_btn_save',													'Lagre');
define('fb_btn_submit',												'Send');

/**
 * Noen kostanter for Feedback Modulen, IKKE OVERSETT DETTE !!!
**/
// Anker
define('fb_anchor',														'fb_anchor');
// Sti til designmal
define('templatePath',                        WB_PATH.'/modules/feedback/htt/');
/**
 * Følgende konstanter vil bli benyttet som STANDARD VERDIER ved ny seksjoner
 */
// Vis siste tilbakemlding først 1=sant 0=usant
define('fb_cfg_latest_first',                 1);
// Send e-post til følgende e-postadresse hvis det kommer en ny tilbakemelding
define('fb_cfg_info_email',                   '');
// Tillat redigering av tilbakemeldinger i Admin sidene 1=sant 0=usant
define('fb_cfg_edit_feedbacks',               1);
// Publiser nye tilbakemeldineg med en gang 1=sant 0=usant
define('fb_cfg_publish_immediately',					1);

?>