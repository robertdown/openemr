<?php
/**
 * Installation script.
 *
 * Copyright (C) 2016 Roberto Vasquez <robertogagliotta@gmail.com>
 * Copyright (C) 2017 Robert Down <robertdown@live.com>
 *
 * LICENSE: This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * This program is distributed in the hope that it will be usefull,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY OF FITNESS FOR A PARTICULAR PURPOSE, See the
 * GNU General Public License for more details.
 * You should have received a copy of the CNU General Public License
 * along with this program. If not, see <http://opensource.org/Licenses/gpl-license.php>;.
 *
 * @package OpenEMR
 * @subpackage Installation
 * @author Robert Down <robertdown@live.com>
 * @author Roberto Vasquez <robertogagliotta@gmail.com>
 * @author Scott Wakefield <scott@npclinics.com.au>
 * @link http://www.open-emr.org
 *
 **/

$COMMAND_LINE = php_sapi_name() == 'cli';
require_once 'vendor/autoload.php';
require_once dirname(__FILE__) . '/library/authentication/password_hashing.php';
require_once dirname(__FILE__) . '/library/classes/Installer.class.php';

error_reporting(E_ALL);
ini_set('display_errors', 'on');

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Forms;
use Symfony\Component\Form\Extension\HttpFoundation\HttpFoundationExtension;
use Symfony\Component\Translation\Translator;
use Symfony\Bridge\Twig\Extension\FormExtension;
use Symfony\Bridge\Twig\Form\TwigRenderer;
use Symfony\Bridge\Twig\Form\TwigRendererEngine;
use Symfony\Bridge\Twig\Extension\TranslationExtension;
use OpenEMR\Setup\Form\DatabaseSetupType;
use OpenEMR\Setup\Entity\DatabaseSetup;
use OpenEMR\Setup\Installer;

$request = Request::createFromGlobals();
$formFactory = Forms::createFormFactoryBuilder()
    ->addExtension(new HttpFoundationExtension())
    ->getFormFactory();

// the Twig file that holds all the default markup for rendering forms
// this file comes with TwigBridge
$defaultFormTheme = 'bootstrap_3_horizontal_layout.html.twig';

$vendorDir = realpath('./vendor');
// the path to TwigBridge library so Twig can locate the
// form_div_layout.html.twig file
$appVariableReflection = new \ReflectionClass('\Symfony\Bridge\Twig\AppVariable');
$vendorTwigBridgeDir = dirname($appVariableReflection->getFileName());
// the path to your other templates
$viewsDir = realpath('./setup/views');

$loader = new Twig_Loader_Filesystem(array($viewsDir, $vendorTwigBridgeDir . '/Resources/views/Form'));
$twig = new Twig_Environment($loader, array('debug' => true));
$formEngine = new TwigRendererEngine(array($defaultFormTheme), $twig);

$twig->addRuntimeLoader(new \Twig_FactoryRuntimeLoader(array(
    TwigRenderer::class => function () use ($formEngine) {
        return new TwigRenderer($formEngine);
    },
)));

$twig->addExtension(new FormExtension());
$twig->addExtension(new TranslationExtension(new Translator('en')));
$twig->addExtension(new Twig_Extension_Debug());

//turn off PHP compatibility warnings
ini_set("session.bug_compat_warn", "off");

$state = isset($_POST["state"]) ? ($_POST["state"]) : '';

// Make this true for IPPF.
$ippf_specific = false;

// If this script was invoked with no site ID, then ask for one.
if (!$COMMAND_LINE && $request->get('site') == NULL) {
    echo $twig->render('site_id.html');
    exit();
} else {
    $site_id = trim($request->get('site', 'default'));
}

// Die if site ID is empty or has invalid characters.
if (empty($site_id) || preg_match('/[^A-Za-z0-9\\-.]/', $site_id)) {
    // @todo Add in template view to handle this
    die("Site ID '" . htmlspecialchars($site_id, ENT_NOQUOTES) . "' contains invalid characters.");
}

//If having problems with file and directory permission
// checking, then can be manually disabled here.
$checkPermissions = true;

$installer = new Installer($_REQUEST);
global $OE_SITE_DIR; // The Installer sets this
global $OE_SITES_BASE;

$docsDirectory = "$OE_SITE_DIR/documents";
$billingDirectory = "$OE_SITE_DIR/edi";
$billingDirectory2 = "$OE_SITE_DIR/era";
$lettersDirectory = "$OE_SITE_DIR/letter_templates";
$gaclWritableDirectory = dirname(__FILE__) . "/gacl/admin/templates_c";
$requiredDirectory1 = dirname(__FILE__) . "/interface/main/calendar/modules/PostCalendar/pntemplates/compiled";
$requiredDirectory2 = dirname(__FILE__) . "/interface/main/calendar/modules/PostCalendar/pntemplates/cache";

$zendModuleConfigFile = dirname(__FILE__) . "/interface/modules/zend_modules/config/application.config.php";

//These are files and dir checked before install for
// correct permissions.
if (is_dir($OE_SITE_DIR)) {
    $writableFileList = array($installer->conffile, $zendModuleConfigFile);
    $writableDirList = array($docsDirectory, $billingDirectory, $billingDirectory2, $lettersDirectory,
        $gaclWritableDirectory, $requiredDirectory1, $requiredDirectory2);
} else {
    $writableFileList = array();
    $writableDirList = array($OE_SITES_BASE, $gaclWritableDirectory, $requiredDirectory1, $requiredDirectory2);
}

// Include the sqlconf file if it exists yet.
$config = 0;
if (file_exists($OE_SITE_DIR)) {
    include_once($installer->conffile);
} else if ($state > 3) {
    // State 3 should have created the site directory if it is missing.
    // @todo Create view
    die("Internal error, site directory is missing.");
}

$preInstallVars = array();

// Create all the template keys
$errorKeys = array('globals', 'xml', 'mysql');

// Ensure the error key gets initiated to false
$errors = array();

if (ini_get('register_globals') == true) {
    $errors['globals'] = true;
}

if (!extension_loaded("xml")) {
    $errors['xml'] = true;
}

if (!(extension_loaded("mysql") || extension_loaded("mysqlnd") || extension_loaded("mysqli"))) {
    $errors['mysql'] = true;
}

if (!(extension_loaded("mbstring"))) {
    $errors['mbstring'] = true;
}

$preInstallVars['errors'] = $errors;

if (count($preInstallVars['errors']) > 0) {
    echo $twig->render('pre_install_check.html', $preInstallVars);
    exit();
}

if ($state == 7):
    // @todo Display finish.html
    die("Finished");
endif;

$inst = isset($_POST["inst"]) ? ($_POST["inst"]) : '';


if (($config == 1) && ($state < 4)) {
    echo "OpenEMR has already been installed.  If you wish to force re-installation,
    then edit $installer->conffile (change the 'config' variable to 0), and re-run this
    script.<br>\n";
} else {
    switch ($state) {

        case 1:
            echo $twig->render(
                "database.html", array(
                    'state' => $state,
                    'site_id' => $site_id
                )
            );
            break;

        case 2:
            // include a "source" site id drop-list and a checkbox to indicate
            // if cloning its database. when checked, do not display initial user
            // and group stuff below.
            $dh = opendir($OE_SITES_BASE);
            if (!$dh) {
                die("cannot read directory '$OE_SITES_BASE'.");
            }
            $dbDetailsViewVars = array('site_id' => $site_id);
            $siteslist = array();
            while (false !== ($sfname = readdir($dh))) {
                if (substr($sfname, 0, 1) == '.') {
                    continue;
                }
                if ($sfname == 'cvs' || $sfname == $site_id) {
                    continue;
                }
                $sitedir = $OE_SITES_BASE . "/" . $sfname;
                if (!is_dir($sitedir)) {
                    continue;
                }
                if (!is_file("$sitedir/sqlconf.php")) {
                    continue;
                }
                $siteslist[$sfname] = $sfname;
                closedir($dh);
                // if this is not the first site...
                if (!empty($siteslist)) {
                    ksort($siteslist);
                    $dbDetailsViewVars['sitesList'] = $siteslist;
                }
            }

            $form = $formFactory->createBuilder(DatabaseSetupType::class, new DatabaseSetup())->getForm();
            $dbDetailsViewVars['form'] = $form->createView();
            echo $twig->render("database_details.html", $dbDetailsViewVars);
            break;

        case 3:

            $defaults = array(
                'host' => 'localhost',
                'port' => '3306',
                'dbname' => 'openemr',
                'login' => 'openemr',
                'pass' => 'openemr',
            );

            $databaseEntity = new DatabaseSetup();
            $form = $formFactory->createBuilder(DatabaseSetupType::class, $databaseEntity)->getForm();

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $data = $form->getData();
                echo "<pre>";
                echo "Is valid";
                var_dump($data);
            } else {
                $errors = $form->getErrors();

                echo "<pre>";
                echo "Is not valid";
                foreach ($errors as $error) {
                    echo $error->getMessage();
                }
            }
            die('here past the data check points');
            // Form Validation
            //   (applicable if not cloning from another database)

            $pass_step2_validation = true;
            $error_step2_message = "ERROR at ";


            if (!$installer->char_is_valid($_REQUEST['server'])) {
                $pass_step2_validation = false;
                $error_step2_message .= "Database Server Host, ";
            }

            if (!$installer->char_is_valid($_REQUEST['port'])) {
                $pass_step2_validation = false;
                $error_step2_message .= "Database Server Port, ";
            }
            if (!$installer->char_is_valid($_REQUEST['dbname'])) {
                $pass_step2_validation = false;
                $error_step2_message .= "Database Name, ";
            }
            if (!$installer->char_is_valid($_REQUEST['login'])) {
                $pass_step2_validation = false;
                $error_step2_message .= "Database Login Name, ";
            }
            if (!$installer->char_is_valid($_REQUEST['pass'])) {
                $pass_step2_validation = false;
                $error_step2_message .= "Database Login Password, ";
            }
            if (!$pass_step2_validation) {
                die($error_step2_message);
            }


            if (empty($installer->clone_database)) {
                if (!$installer->login_is_valid()) {
                    echo "ERROR. Please pick a proper 'Login Name'.<br>\n";
                    echo "Click Back in browser to re-enter.<br>\n";
                    break;
                }
                if (!$installer->iuser_is_valid()) {
                    echo "ERROR. The 'Initial User' field can only contain one word and no spaces.<br>\n";
                    echo "Click Back in browser to re-enter.<br>\n";
                    break;
                }
                if (!$installer->user_password_is_valid()) {
                    echo "ERROR. Please pick a proper 'Initial User Password'.<br>\n";
                    echo "Click Back in browser to re-enter.<br>\n";
                    break;
                }
            }
            if (!$installer->password_is_valid()) {
                echo "ERROR. Please pick a proper 'Password'.<br>\n";
                echo "Click Back in browser to re-enter.<br>\n";
                break;
            }

            echo "<b>Step $state</b><br><br>\n";
            echo "Configuring OpenEMR...<br><br>\n";

            // Skip below if database shell has already been created.
            if ($inst != 2) {

                echo "Connecting to MySQL Server...\n";
                flush();
                if (!$installer->root_database_connection()) {
                    echo "ERROR.  Check your login credentials.\n";
                    echo $installer->error_message;
                    break;
                } else {
                    echo "OK.<br>\n";
                    flush();
                }
            }

            // Only pertinent if cloning another installation database
            if (!empty($installer->clone_database)) {

                echo "Dumping source database...";
                flush();
                if (!$installer->create_dumpfiles()) {
                    echo $installer->error_message;
                    break;
                } else {
                    echo " OK.<br>\n";
                    flush();
                }
            }

            // Only pertinent if mirroring another installation directory
            if (!empty($installer->source_site_id)) {

                echo "Creating site directory...";
                if (!$installer->create_site_directory()) {
                    echo $installer->error_message;
                    break;
                } else {
                    echo "OK.<BR>";
                    flush();
                }
            }

            // Skip below if database shell has already been created.
            if ($inst != 2) {
                echo "Creating database...\n";
                flush();
                if (!$installer->create_database()) {
                    echo "ERROR.  Check your login credentials.\n";
                    echo $installer->error_message;
                    break;
                } else {
                    echo "OK.<br>\n";
                    flush();
                }

                echo "Creating user with permissions for database...\n";
                flush();
                if (!$installer->grant_privileges()) {
                    echo "ERROR when granting privileges to the specified user.\n";
                    echo $installer->error_message;
                    break;
                } else {
                    echo "OK.<br>\n";
                    flush();
                }

                echo "Reconnecting as new user...\n";
                flush();
                $installer->disconnect();
            } else {

                echo "Connecting to MySQL Server...\n";
            }
            if (!$installer->user_database_connection()) {
                echo "ERROR.  Check your login credentials.\n";
                echo $installer->error_message;
                break;
            } else {
                echo "OK.<br>\n";
                flush();
            }

            // Load the database files
            $dump_results = $installer->load_dumpfiles();
            if (!$dump_results) {
                echo $installer->error_message;
                break;
            } else {
                echo $dump_results;
                flush();
            }

            echo "Writing SQL configuration...\n";
            flush();
            if (!$installer->write_configuration_file()) {
                echo $installer->error_message;
                break;
            } else {
                echo "OK.<br>\n";
                flush();
            }

            // Only pertinent if not cloning another installation database
            if (empty($installer->clone_database)) {

                echo "Setting version indicators...\n";
                flush();
                if (!$installer->add_version_info()) {
                    echo "ERROR.\n";
                    echo $installer->error_message;;
                    break;
                } else {
                    echo "OK<br>\n";
                    flush();
                }

                echo "Writing global configuration defaults...\n";
                flush();
                if (!$installer->insert_globals()) {
                    echo "ERROR.\n";
                    echo $installer->error_message;;
                    break;
                } else {
                    echo "OK<br>\n";
                    flush();
                }

                echo "Adding Initial User...\n";
                flush();
                if (!$installer->add_initial_user()) {
                    echo $installer->error_message;
                    break;
                }
                echo "OK<br>\n";
                flush();
            }

            if (!empty($installer->clone_database)) {
                // Database was cloned, skip ACL setup.
                echo "Click 'continue' for further instructions.";
                $next_state = 7;
            } else {
                echo "\n<br>Next step will install and configure access controls (php-GACL).<br>\n";
                $next_state = 4;
            }

            echo "
<FORM METHOD='POST'>\n
<INPUT TYPE='HIDDEN' NAME='state' VALUE='$next_state'>
<INPUT TYPE='HIDDEN' NAME='site' VALUE='$site_id'>\n
<INPUT TYPE='HIDDEN' NAME='iuser' VALUE='$installer->iuser'>
<INPUT TYPE='HIDDEN' NAME='iuserpass' VALUE='$installer->iuserpass'>
<INPUT TYPE='HIDDEN' NAME='iuname' VALUE='$installer->iuname'>
<INPUT TYPE='HIDDEN' NAME='iufname' VALUE='$installer->iufname'>
<INPUT TYPE='HIDDEN' NAME='clone_database' VALUE='$installer->clone_database'>
<br>\n
<INPUT TYPE='SUBMIT' VALUE='Continue'><br></FORM><br>\n";

            break;

        case 4:
            echo "<b>Step $state</b><br><br>\n";
            echo "Installing and Configuring Access Controls (php-GACL)...<br><br>";

            if (!$installer->install_gacl()) {
                echo $installer->error_message;
                break;
            } else {
                // display the status information for gacl setup
                echo $installer->debug_message;
            }

            echo "Gave the '$installer->iuser' user (password is '$installer->iuserpass') administrator access.<br><br>";

            echo "Done installing and configuring access controls (php-GACL).<br>";
            echo "Next step will configure PHP.";

            echo "<br><FORM METHOD='POST'>\n
<INPUT TYPE='HIDDEN' NAME='state' VALUE='5'>\n
<INPUT TYPE='HIDDEN' NAME='site' VALUE='$site_id'>\n
<INPUT TYPE='HIDDEN' NAME='iuser' VALUE='$installer->iuser'>\n
<INPUT TYPE='HIDDEN' NAME='iuserpass' VALUE='$installer->iuserpass'>\n
<br>\n
<INPUT TYPE='SUBMIT' VALUE='Continue'><br></FORM><br>\n";

            break;

        case 5:
            echo "<b>Step $state</b><br><br>\n";
            echo "Configuration of PHP...<br><br>\n";
            echo "We recommend making the following changes to your PHP installation, which can normally be done by editing the php.ini configuration file:\n";
            echo "<ul>";
            $gotFileFlag = 0;
            if (version_compare(PHP_VERSION, '5.2.4', '>=')) {
                $phpINIfile = php_ini_loaded_file();
                if ($phpINIfile) {
                    echo "<li><font color='green'>Your php.ini file can be found at " . $phpINIfile . "</font></li>\n";
                    $gotFileFlag = 1;
                }
            }
            echo "<li>", "To ensure proper functioning of OpenEMR you must make sure that PHP settings include:";
            echo "<table class='phpset'><tr><th>Setting</th><th>Required value</th><th>Current value</th></tr>";
            echo "<tr><td>short_open_tag  </td><td>Off</td><td>", ini_get('short_open_tag') ? 'On' : 'Off', "</td></tr>\n";
            echo "<tr><td>display_errors  </td><td>Off</td><td>", ini_get('display_errors') ? 'On' : 'Off', "</td></tr>\n";
            echo "<tr><td>register_globals   </td><td>Off</td><td>", ini_get('register_globals') ? 'On' : 'Off', "</td></tr>\n";
            echo "<tr><td>max_input_vars     </td><td>at least 3000</td><td>", ini_get('max_input_vars'), "</td></tr>\n";
            echo "<tr><td>max_execution_time </td><td>at least 60</td><td>", ini_get('max_execution_time'), "</td></tr>\n";
            echo "<tr><td>max_input_time     </td><td>at least 90</td><td>", ini_get('max_input_time'), "</td></tr>\n";
            echo "<tr><td>post_max_size      </td><td>at least 30M</td><td>", ini_get('post_max_size'), "</td></tr>\n";
            echo "<tr><td>memory_limit       </td><td>at least 128M</td><td>", ini_get('memory_limit'), "</td></tr>\n";
            echo "</table>";
            echo "</li>";

            echo "<li>In order to take full advantage of the patient documents capability you must make sure that settings in php.ini file include \"file_uploads = On\", that \"upload_max_filesize\" is appropriate for your use and that \"upload_tmp_dir\" is set to a correct value that will work on your system.</li>\n";
            if (!$gotFileFlag) {
                echo "<li>If you are having difficulty finding your php.ini file, then refer to the <a href='Documentation/INSTALL' target='_blank'><span STYLE='text-decoration: underline;'>'INSTALL'</span></a> manual for suggestions.</li>\n";
            }
            echo "</ul>";

            echo "<br>We recommend you print these instructions for future reference.<br><br>";
            echo "Next step will configure Apache web server.";

            echo "<br><FORM METHOD='POST'>\n
<INPUT TYPE='HIDDEN' NAME='state' VALUE='6'>\n
<INPUT TYPE='HIDDEN' NAME='site' VALUE='$site_id'>\n
<INPUT TYPE='HIDDEN' NAME='iuser' VALUE='$installer->iuser'>\n
<INPUT TYPE='HIDDEN' NAME='iuserpass' VALUE='$installer->iuserpass'>\n
<br>\n
<INPUT TYPE='SUBMIT' VALUE='Continue'><br></FORM><br>\n";

            break;

        case 6:
            echo "<b>Step $state</b><br><br>\n";
            echo "Configuration of Apache web server...<br><br>\n";
            echo "The \"" . preg_replace("/${site_id}/", "*", realpath($docsDirectory)) . "\", \"" . preg_replace("/${site_id}/", "*", realpath($billingDirectory)) . "\" and \"" . preg_replace("/${site_id}/", "*", realpath($billingDirectory2)) . "\" directories contain patient information, and
it is important to secure these directories. Additionally, some settings are required for the Zend Framework to work in OpenEMR. This can be done by pasting the below to end of your apache configuration file:<br>
&nbsp;&nbsp;&lt;Directory \"" . realpath(dirname(__FILE__)) . "\"&gt;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;AllowOverride FileInfo<br>
&nbsp;&nbsp;&lt;/Directory&gt;<br>
&nbsp;&nbsp;&lt;Directory \"" . realpath(dirname(__FILE__)) . "/sites\"&gt;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;AllowOverride None<br>
&nbsp;&nbsp;&lt;/Directory&gt;<br>
&nbsp;&nbsp;&lt;Directory \"" . preg_replace("/${site_id}/", "*", realpath($docsDirectory)) . "\"&gt;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;order deny,allow<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Deny from all<br>
&nbsp;&nbsp;&lt;/Directory&gt;<br>
&nbsp;&nbsp;&lt;Directory \"" . preg_replace("/${site_id}/", "*", realpath($billingDirectory)) . "\"&gt;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;order deny,allow<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Deny from all<br>
&nbsp;&nbsp;&lt;/Directory&gt;<br>
&nbsp;&nbsp;&lt;Directory \"" . preg_replace("/${site_id}/", "*", realpath($billingDirectory2)) . "\"&gt;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;order deny,allow<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Deny from all<br>
&nbsp;&nbsp;&lt;/Directory&gt;<br><br>";

            echo "If you are having difficulty finding your apache configuration file, then refer to the <a href='Documentation/INSTALL' target='_blank'><span STYLE='text-decoration: underline;'>'INSTALL'</span></a> manual for suggestions.<br><br>\n";
            echo "<br>We recommend you print these instructions for future reference.<br><br>";
            echo "Click 'continue' for further instructions.";

            echo "<br><FORM METHOD='POST'>\n
<INPUT TYPE='HIDDEN' NAME='state' VALUE='7'>\n
<INPUT TYPE='HIDDEN' NAME='site' VALUE='$site_id'>\n
<INPUT TYPE='HIDDEN' NAME='iuser' VALUE='$installer->iuser'>\n
<INPUT TYPE='HIDDEN' NAME='iuserpass' VALUE='$installer->iuserpass'>\n
<br>\n
<INPUT TYPE='SUBMIT' VALUE='Continue'><br></FORM><br>\n";

            break;

        case 0:
        default:
            $welcomeVars = array('site_id' => $site_id);

            if ($checkPermissions == true) {
                $welcomeVars['checkPermission'] = true;
                $writableError = false;
                $fileList = array();

                foreach ($writableFileList as $tmpFile) {
                    $fileListTmp['path'] = realpath($tmpFile);
                    $fileListTmp['status'] = (is_writable($tmpFile)) ? true : false;
                    array_push($fileList, $fileListTmp);
                    $writableError = ($fileListTmp['status'] == false) ? true : $writableError;
                }

                // @todo Seems to break if a file is not writable
                $welcomeVars['fileErr'] = $writableError;

                if ($writableError) {
                    break;
                }
                $writableError = false;

                $dirList = array();
                foreach ($writableDirList as $tempDir) {
                    $dirListTmp['path'] = realpath($tempDir);
                    $dirListTmp['status'] = (is_writable($tempDir)) ? true : false;
                    array_push($dirList, $dirListTmp);
                    $writableError = ($dirListTmp['status'] == false) ? true : $writableError;
                }

                $welcomeVars['dirErr'] = $writableError;

                $welcomeVars['dirs'] = $dirList;
                $welcomeVars['files'] = $fileList;

                if ($writableError) {
                    echo $twig->render('welcome.html', $welcomeVars);
                    break;
                }

                echo $twig->render('welcome.html', $welcomeVars);
            } else {
                echo "<br>Click to continue installation.<br>\n";
            }
    }
}
?>
