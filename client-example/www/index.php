<?php
error_reporting(E_ALL);
// This client root
define('ROOT_DIR', realpath(__DIR__ . '/..'));

// The framework root
define('FRAMEWORK_ROOT', ROOT_DIR . '../../akaPHP');

// Include the loader
include_once(FRAMEWORK_ROOT . '/org/akaPHP/core/Loader.php');

use app\lib;
use org\akaPHP\core;

// Init the loader
core\Loader::init();

//startup Application
$appFacade = new lib\ApplicationFacade(new cfg\WebConfig());
$appFacade->startup();
?>
