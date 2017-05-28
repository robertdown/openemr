<?php
/**
* Maintenance for the list of procedure providers.
*
* Copyright (C) 2012 Rod Roark <rod@sunsetsystems.com>
*
* LICENSE: This program is free software; you can redistribute it and/or
* modify it under the terms of the GNU General Public License
* as published by the Free Software Foundation; either version 2
* of the License, or (at your option) any later version.
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
* You should have received a copy of the GNU General Public License
* along with this program.  If not, see <http://opensource.org/licenses/gpl-license.php>.
*
* @package OpenEMR
* @subpackage Procedure
* @author  Rod Roark <rod@sunsetsystems.com>
*/

require_once("../globals.php");
require_once("$srcdir/acl.inc");
require_once("$srcdir/options.inc.php");

$popup = empty($_GET['popup']) ? 0 : 1;

//$form_name = trim($_POST['form_name']);

$sql = "SELECT pp.* FROM procedure_providers AS pp ORDER BY pp.name";
$result = sqlStatement($sql);
$providers = [];
while ($row = sqlFetchArray($result)) {
    $providers[] = $row;
}

$viewArgs = [
    'providers' => $providers,
];

echo $GLOBALS['twig']->render('procedure/provider/list.html.twig', $viewArgs);
