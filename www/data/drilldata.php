<?php

/*
drill
{
	id: 1,
	title: "Beenzwaai op plaats, met hang naar voren",
	description: "Zwaaibeweging been op de plaats. Evenwicht houden. Daarna stilhangen lichaam naar voren 1 been achter",
	tags: [ "warming up", "core" ],
	locations: [ "circle" ],
	media: [ 'beenzwaai-1.jpg', 'picture1.jpg'],
	musclegroups: [ "rug", "quadricepts"],
}


training
{
	id: 1,
	title: "Woensdagavond training - loopgroep",
	description: "Veel kort werk vanavond. Extra aandacht voor core stability",
	date: "2016-09-26",
	drills: [ 1, 2 ]
}

media:

/media/drill/1/xxx.jpg
/media/drill/1/xxx.media

*/

error_reporting(E_ERROR | E_WARNING | E_PARSE);

$sessionId = '20160914';

$drills[1] = array(	
	id => 1,
	title => "Beenzwaai op plaats, met hang naar voren",
	description => "Zwaaibeweging been op de plaats. Evenwicht houden. Daarna stilhangen lichaam naar voren 1 been achter",
	tags => array( "warming up", "core stability" ),
	locations => array( "circle"),
	musclegroups=> array( "rug", "quadricepts") ) ;

$drills[2] = array(	
	id => 2,
	title => 'Lage Skipping',
	description => "Lage Kniehef, landen op voorvoet, hoge frequentie, armen meebewegen. Lopen alsof je op hete kolen loopt.",
	tags => array( "warming up" ),
	locations => array( "square"),
	musclegroups=> array( ) ) ;

$drills[3] = array(	
	id => 3,
	title => 'Tripplings op de plaats',
	description => "Tripplings op de plaats.",
	tags => array( "warming up", "loopscholing" ),
	locations => array( "circle"),
	musclegroups=> array( ) ) ;

$drills[4] = array(	
	id => 4,
	title => 'Tripplings met kniehef(vasthouden)',
	description => "Tripplings op de plaats met kniehef, kniehef paar sec. vasthouden.",
	tags => array( "warming up", "loopscholing" ),
	locations => array( "circle"),
	musclegroups=> array( ) ) ;


$trainings['20160914']['description'] = "Veel kort werk vanavond. Extra aandacht voor core stability";
$trainings['20160914']['date'] = "2016-09-14";
$trainings['20160914']['groups'][0]["warming up"] = array (1);
$trainings['20160914']['groups'][1]["circle"] = array (2, 3);

$result = $trainings;
foreach($trainings as $date => $training) {
	foreach($training['groups'] as $fase => $drills) {
		foreach($drills as $drill) {
			$result[$date]['groups'][$fase] = $drill;
		}
	}
}
echo json_encode($result['20160914']);


