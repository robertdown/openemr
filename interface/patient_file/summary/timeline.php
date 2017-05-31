<?php
/**
 * OpenEMR (http://open-emr.org).
 *
 * @author Robert Down <robertdown@live.com>
 * @copyright Copyright (c) 2017 Robert Down
 * @package OpenEMR
 * @subpackage Patient
 * @license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

require_once "../../globals.php";
require_once "{$srcdir}/patient.inc";
require_once "{$srcdir}/forms.inc";
require_once "{$srcdir}/acl.inc";
require_once "{$srcdir}/formatting.inc.php";

use OpenEMR\Patient\Timeline;
use Symfony\Component\HttpFoundation\Request;

if (!acl_check('patients', 'med')) {
    die('Not authorized');
}

$request = Request::createFromGlobals();
$action = $request->get('action');


if ($action == 'list') {
    $timeline = new Timeline($pid);
    $forms = $timeline->forms();

    // Convert forms into a multidimensional array distributed by years
    $tmpForms = [];
    foreach ($forms as $form) {
        $date = DateTime::createFromFormat('Y-m-d h:i:s', $form['date']);
        $tmpYear = $date->format('Y');
        if (!array_key_exists($tmpYear, $tmpForms)) {
            $tmpForms["{$tmpYear}"] = [];
        }
        // this isn't formatting the date
        $form['date'] = oeFormatShortDate($form['date']);
        $tmpForms["{$tmpYear}"][] = $form;
    }

    $viewArgs = [
        'forms' => $tmpForms,
        'patientName' => getPatientName($pid),
    ];

    echo $GLOBALS['twig']->render('patient/timeline.html.twig', $viewArgs);
}

if ($action == 'detail') {
    $form = getFormById($request->get('form_id'));
    $formdir = $form['formdir'];
    if (substr($formdir,0,3) == 'LBF') {
        include_once($GLOBALS['incdir'] . "/forms/LBF/report.php");

        call_user_func("lbf_report", $pid, $encounter, 2, $form['form_id'], $formdir, true);
    } else {
        include_once($GLOBALS['incdir'] . "/forms/$formdir/report.php");
        call_user_func($formdir . "_report", $pid, $encounter, 2, $form['form_id']);
    }
}

