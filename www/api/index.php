<?php

// content type
header ('Content-Type: application/json');

// CORS
header("Access-Control-Allow-Origin: *");
 
error_reporting(E_ALL);
ini_set('display_errors', 'On');


if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}



require_once 'vendor/autoload.php';
require_once 'config.php';
require_once 'ocr/OcrHandler.php';
require_once 'ocr/TextParser.php';
require_once 'Middleware/AuthMiddleware.php';
require_once 'common/common.php';
require_once 'common/DrillHandler.php';
require_once 'common/ApiHandler.php';

$handler = new DrillHandler();
$handler-> logger -> addInfo("server:".print_r($_SERVER,true));


// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
	$handler-> logger -> addInfo("options 1");

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])) {
		$handler-> logger -> addInfo("options 2");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); 
    }
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])) {
		$handler-> logger -> addInfo("options 2");
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    }
}


setlocale(LC_ALL, $apiConfig['language']);

use Propel\Runtime\Propel;

use Slim\Log;

//test();

$app = new \Slim\App(array());
$app->add(new AuthMiddleware());
//$app -> config("debug", true);

//$app->error(function (\Exception $e) use ($app) {
//    $app->render('error.php');
//});



// Product

$app->get('/trainingsessions', '\ApiHandler:getTrainingSessions');
$app->get('/sessiondrills', '\ApiHandler:getSessionDrills');
$app->get('/sessiongroups', '\ApiHandler:getSessionGroups');
$app->get('/assets/{id}', '\ApiHandler:getAsset');


$app -> run();

