<?php
error_reporting(E_ALL);
// This client root
define('ROOT_DIR', realpath(__DIR__ . '/..'));

// Include the loader
include_once(ROOT_DIR . '/../akaPHP/org/akaPHP/core/Loader.php');

use app\lib;
use org\akaPHP\core;

// Init the loader
$loader = core\Loader::init();

$loader->addRoute(ROOT_DIR);
$loader->addRoute(ROOT_DIR . '/../akaPHP');

//startup Application
$appFacade = new lib\ApplicationFacade(new cfg\WebConfig());
$appFacade->startup();
?>
