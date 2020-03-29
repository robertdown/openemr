<?php
/**
 * CDC COVID-19 Person Under Investigation and Case Report Form
 *
 * @package   OpenEMR
 * @subpackage COVID19 Forms
 * @link      http://www.open-emr.org
 * @author    Robert Down
 * @copyright Copyright (c) 2020 Robert Down <rboertdown@live.com>
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

require_once __DIR__ . "/../../globals.php";
require_once "$srcdir/api.inc";
require_once "$srcdir/patient.inc";

use OpenEMR\Common\Csrf\CsrfUtils;

$GLOBALS['twig']->getLoader()->addPath(__DIR__ . "/templates/", "cdccovid");

$patient = getPatientData($pid);


$current_status = [
    '1' => 'PUI testing pending',
    '2' => 'PUI tested negative',
    '3' => 'Presumptive case (positive local test), confirmatory testing pending',
    '4' => 'Presumptive case (positive local test), confirmatory tested negative†',
    '5' => 'Laboratory-confirmed case†',
];

$ethnicity = [
    '0' => 'Non-Hispanic Latino',
    '1' => 'Hispanic / Latino',
    '9' => 'Not Specified',
];

$sex = [
    '1' => 'Male',
    '2' => 'Female',
    '9' => 'Unknown',
    '0' => 'Other',
];

$race = [
    'race_asian' => 'Asian',
    'race_aian' => 'American Indian / Alaskan Native',
    'race_black' => 'Black',
    'race_nhpi' => 'Native Hawaiian / Other Pacific Islander',
    'race_white' => 'White',
    'race_unk' => 'Unknown',
    'race_other' => 'Other',
];


$ageunit = [
    '1' => 'Years',
    '2' => 'Months',
    '3' => 'Days',
];

$yn =  [
    '1' => 'Yes',
    '0' => 'No',
    '9' => 'Unknown',
];

$yn_with_na =  [
    '1' => 'Yes',
    '0' => 'No',
    '9' => 'Unknown',
    '5' => 'N/A',
];

$sympstatus = [
    '1' => 'Symptomatic',
    '0' => 'Asymptomatic',
    '9' => 'Unknown',
];

$symp_res_yn = [
    '1' => 'Still symptomatic',
    '0' => 'Symptoms resolved, unknown date',
    '9' => 'Unknown',
];

$resp = [
    '1' => 'Positive',
    '2' => 'Negative',
    '3' => 'Pending',
    '4' => 'Not Done',
];

$spec = [
    '1' => 'Positive',
    '2' => 'Negative',
    '3' => 'Pending',
    '4' => 'Not Done',
    '5' => 'Indeterminate',
];

$exp = [
    'exp_wuhan' => 'Travel to Wuhan',
    'exp_hubei' => 'Travel to Hubei',
    'exp_china' => 'Travel to mainland China',
    'exp_othcountry' => 'Travel to other non-US country',
    'exp_house' => 'Household contact with another lab-confirmed COVID-19 case-patient',
    'exp_community' => 'Community contact with another lab-confirmed COVID-19 case-patient',
    'exp_health' => 'Any healthcare contact with another lab-confirmed COVID-19 case-patient',
    'exp_health_pt' => 'Healthcare contact with another lab-confirmed COVID-19 case-patient -- patient',
    'exp_health_vis' => 'Healthcare contact with another lab-confirmed COVID-19 case-patient -- visitor',
    'exp_health_hcw' => 'Healthcare contact with another lab-confirmed COVID-19 case-patient -- healthcare worker',
    'exp_animal' => 'Animal exposure',
    'exp_cluster' => 'Exposure to a cluster of patients with severe acute lower respiratory distress of unknown etiology',
    'exp_other' => 'Other',
    'exp_unk' => 'Unknown',
];

$process = [
    'process_pui' => 'Clinical evaluation leading to PUI determination',
    'process_cont' => 'Contact tracing of case patient',
    'process_surv' => 'Routine surveillance',
    'process_unk' => 'Unknown',
    'process_other' => 'Other',
    'process_epix' => 'EpiX notification of travelers',
];

$vars = [
    'current_status' => $current_status,
    'ethnicity' => $ethnicity,
    'sex' => $sex,
    'patient' => $patient,
    'encounter' => $encounter,
    'race' => $race,
    'ageunit' => $ageunit,
    'yn' => $yn,
    'sympstatus' => $sympstatus,
    'symp_res_yn' => $symp_res_yn,
    'resp' => $resp,
    'spec' => $spec,
    'exp'  => $exp,
    'process' => $process,
    'yn_with_na' => $yn_with_na,
];



echo $GLOBALS['twig']->render("@cdccovid/form.html.twig", $vars);
