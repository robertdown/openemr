<?php

error_reporting(E_ALL);
ini_set('error_reporting', 'on');

require_once "./interface/globals.php";

error_reporting(E_ALL);
ini_set('error_reporting', '1');

use OpenEMR\Services\ListNewService;

$ls = new ListNewService();

var_dump($ls->getLists());
