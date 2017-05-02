<?php
/**
 * Display current patients NewCrop account status.
 *
 * Copyright (C) 2011 ZMG LLC <sam@zhservices.com>
 *
 * LICENSE: This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by the Free
 * Software Foundation; either version 3 of the License, or (at your option) any
 * later version.  This program is distributed in the hope that it will be
 * useful, but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General
 * Public License for more details.  You should have received a copy of the GNU
 * General Public License along with this program.
 * If not, see <http://opensource.org/licenses/gpl-license.php>.
 *
 * @package    OpenEMR
 * @subpackage NewCrop
 * @author     Eldho Chacko <eldho@zhservices.com>
 * @author     Vinish K <vinish@zhservices.com>
 * @author     Sam Likins <sam.likins@wsi-services.com>
 * @author Robert Down <robertdown@live.com>
 * @link       http://www.open-emr.org
 */

$sanitize_all_escapes = true;		// SANITIZE ALL ESCAPES

$fake_register_globals = false;		// STOP FAKE REGISTER GLOBALS

require_once(__DIR__.'/../globals.php');
require_once($GLOBALS['fileroot'].'/interface/eRxGlobals.php');
require_once($GLOBALS['fileroot'].'/interface/eRxStore.php');
require_once($GLOBALS['srcdir'].'/xmltoarray_parser_htmlfix.php');
require_once($GLOBALS['srcdir'].'/lists.inc');
require_once($GLOBALS['srcdir'].'/amc.php');
require_once($GLOBALS['fileroot'].'/interface/eRxSOAP.php');
require_once($GLOBALS['fileroot'].'/interface/eRx_xml.php');

set_time_limit(0);

$eRxSOAP = new eRxSOAP;
$eRxSOAP->setGlobals(new eRxGlobals($GLOBALS))
	->setStore(new eRxStore)
	->setAuthUserId($_SESSION['authUserID']);

if(array_key_exists('patient', $_REQUEST)) {
	$eRxSOAP->setPatientId($_REQUEST['patient']);
} elseif(array_key_exists('pid', $GLOBALS)) {
	$eRxSOAP->setPatientId($GLOBALS['pid']);
}

$accountStatus = $eRxSOAP->getAccountStatus()
	->GetAccountStatusResult->accountStatusDetail;

?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title"><?php echo xl("eRx Account Status");?></h4>
</div>
<div class="modal-body">
    <table class='table table-responsive'>
        <tr>
            <td><?php echo xlt('Pending Rx Count'); ?></td>
            <td><?php echo $accountStatus->PendingRxCount;?></td>
        </tr>
        <tr>
            <td><?php echo xlt('Alert Count'); ?></td>
            <td><?php echo $accountStatus->AlertCount;?></td>
        </tr>
        <tr>
            <td><?php echo xlt('Fax Count'); ?></td>
            <td><?php echo $accountStatus->FaxCount;?></td>
        </tr>
        <tr>
            <td><?php echo xlt('Pharm Com Count'); ?></td>
            <td><?php echo $accountStatus->PharmComCount;?></td>
        </tr>
    </table>
</div>
