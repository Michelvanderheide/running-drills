<?php


define('COL_ID', 'ID');
define('COL_TITLE', 'Korte omschrijving');
define('COL_OMSCHRIJVING', 'Extra info');
define('COL_KRING', 'Kring');
define('COL_BAAN', '400m Baan');
define('COL_WARMING_UP', 'Warming up');
define('COL_CORE_STABILITY', 'Core stability');
define('COL_LOOPSCHOLING', 'Loopscholing');
define('COL_TUSSENPROGRAMMA', 'Tussenprogramma');
define('COL_HOOFDPROGRAMMA', 'Hoofdprogramma');
define('COL_YOUTUBE_ID', 'Youtube Id');
define('COL_ALT_DESCRIPTION', 'Alt. Omschrijving');

$apiConfig = array();
$apiConfig['titles']['IL'] = 'Inleiding';
$apiConfig['titles']['AL'] = 'Algemeen';
$apiConfig['titles']['WU'] = 'Warming Up';
$apiConfig['titles']['CS'] = 'Core Stability';
$apiConfig['titles']['KR'] = 'Kring';
$apiConfig['titles']['VK'] = 'Vierkant';
$apiConfig['titles']['OV'] = 'Overig';
$apiConfig['titles']['4B'] = '400m Baan';
$apiConfig['titles']['SB'] = 'Sprint Baan';
$apiConfig['titles']['LS'] = 'Loopscholing';
$apiConfig['titles']['HP'] = 'Hoofdprogramma';
$apiConfig['titles']['TP'] = 'Tussenprogramma';


//$apiConfig['env'] = getenv('appenv') ? getenv('appenv') : 'prod';

$apiConfig['env'] = strstr($_SERVER['HTTP_HOST'], 'runningdrills.local') ? 'dev' : 'prod';

// api directory
$apiConfig['basedir'] = str_replace('www\api','', str_replace ('www/api','', __DIR__) );

// URL
if ($apiConfig['env'] == "dev") {
	$apiConfig['baseUrl'] = "http://www.avgoor.nl";
	//$apiConfig['baseUrl'] = "http://garantieapp.local";
	$apiConfig['imagedir'] = $apiConfig['basedir'] . 'www/images/';
	$apiConfig['imageUrl'] = $apiConfig['baseUrl'] . '/wp-content/images/drills/images/';
} else {
	$apiConfig['baseUrl'] = "http://www.avgoor.nl";
	$apiConfig['imagedir'] = $apiConfig['basedir'] . 'www/wp-content/images/drills/images/';
	$apiConfig['imageUrl'] = $apiConfig['baseUrl'] . '/wp-content/images/drills/images/';
}

// basedir
$apiConfig['logpath'] = $apiConfig['basedir']  . '/logs/';
$apiConfig['assetsPath'] = $apiConfig['basedir'] .'/assets/';


$apiConfig['csvfile'] = $apiConfig['assetsPath'].'trainingsvormen.csv';


$apiConfig['demoToken'] = '1234';

//print_r($apiConfig);