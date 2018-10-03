<?php
//

require_once("../../globals.php");
require_once("$srcdir/api.inc");
require_once("$srcdir/forms.inc");

foreach ($_POST as $k => $var) {
    $_POST[$k] = add_escape_custom($var);
    echo "$var\n";
}

if ($encounter == "") {
    $encounter = date("Ymd");
}

if ($_GET["mode"] == "new") {
    $newid = formSubmit("form_ped_fever", $_POST, add_escape_custom($_GET["id"]), $userauthorized);
    addForm($encounter, "Pediatric Fever Evaluation", $newid, "ped_fever", $pid, $userauthorized);
} elseif ($_GET["mode"] == "update") {
    sqlInsert("update form_ped_fever set pid = ?,
	groupname = ?,
	user = ?
	authorized =,
	activity =1, 
	date = NOW(), 

	measured = ?,
	duration = ?,
	taking_medication = ?,
	responds_to_tylenol = ?,
	responds_to_moltrin = ?,
	pain = ?,
	lethargy = ?,
	vomiting = ?,
	oral_hydration_capable = ?,
	urine_output_last_6_hours = ?,
	pain_with_urination = ?,
	cough_or_breathing_difficulty = ?,
	able_to_sleep = ?,
	nasal_discharge = ?
	previous_hospitalization = ?,
	siblings_affected = ?,
	immunization_up_to_date = ?,
	notes = ?,
	WHERE id = ?", array($_SESSION["pid"], $_SESSION["authProvider"], $_SESSION["authUser"], $userauthorized, $_POST["measured"], $_POST["duration"], $_POST["severity"], $_POST["responds_to_tylenol"],
	$_POST["responds_to_moltrin"], $_POST["pain"], $_POST["lethargy"], $_POST["vomiting"], $_POST["oral_hydration_capable"], $_POST["urine_output_last_6_hours"], 
	$_POST["pain_with_urination"], $_POST["cough_or_breathing_difficulty"], $_POST["able_to_sleep"], $_POST["nasal_discharge"], $_POST["previous_hospitalization"], 
	$_POST["siblings_affected"], $_POST["immunization_up_to_date"], $_POST["notes"], $id ));
}

$_SESSION["encounter"] = $encounter;

formHeader("Redirecting....");
formJump();
formFooter();
