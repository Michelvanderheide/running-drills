<?php

use Propel\Runtime\ActiveQuery\Criteria;


/*


		$this -> drills[1] = array(	
			id => 1,
			title => "Beenzwaai op plaats, met hang naar voren",
			description => "Zwaaibeweging been op de plaats. Evenwicht houden. Daarna stilhangen lichaam naar voren 1 been achter",
			tags => array( "warming up", "core stability" ),
			locations => array( "circle"),
			musclegroups=> array( "rug", "quadricepts") ) ;

		$this -> drills[2] = array(	
			id => 2,
			title => 'Lage Skipping',
			description => "Lage Kniehef, landen op voorvoet, hoge frequentie, armen meebewegen. Lopen alsof je op hete kolen loopt.",
			tags => array( "warming up" ),
			locations => array( "square"),
			musclegroups=> array( ) ) ;

		$this -> drills[3] = array(	
			id => 3,
			title => 'Tripplings op de plaats',
			description => "Tripplings op de plaats.",
			tags => array( "warming up", "loopscholing" ),
			locations => array( "circle"),
			musclegroups=> array( ) ) ;

		$this -> drills[4] = array(	
			id => 4,
			title => 'Tripplings met kniehef(vasthouden)',
			description => "Tripplings op de plaats met kniehef, kniehef paar sec. vasthouden.",
			tags => array( "warming up", "loopscholing" ),
			locations => array( "circle"),
			musclegroups=> array( ) ) ;

		$this -> trainingSessions['20160914']['description'] = "Veel kort werk vanavond. Extra aandacht voor core stability";
		$this -> trainingSessions['20160914']['date'] = "2016-09-14";
		$this -> trainingSessions['20160914']['groups'][0]["warming up"] = array (1);
		$this -> trainingSessions['20160914']['groups'][1]["circle"] = array (2, 3);		

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

$sessionId = 'TS-2016-09-14';



use Monolog\Logger;
use Monolog\Handler\StreamHandler;


/**
 * This API classes
 */
class DrillHandler {
	var $errorMessage;
	var $token;
	var $authenticated = false;
	var $drills, $trainingSessions;

	/**
	 * Constructor
	 */
	public function __construct() {	
		global $apiConfig;

		$this -> errorMessage = "";
		$this -> logger = new Logger('DrillHandler');
		$this -> logger -> pushHandler(new StreamHandler( $apiConfig['logpath'].'/RunningDrills.log', Logger::INFO));
		$this -> logger -> addInfo("Starting DrillHandler...");

		$this -> readCsvData();
		$this -> readCsvSessionData();

	}



	public function setErrorMessage($prefix=false, $message) {
		$this -> errorMessage = $message;
		if ($prefix) {
			$this -> errorMessage = $prefix . ': ' . $message;
		}

		// todo log
		$this -> logger -> addError($this -> errorMessage);
	}

	public function getErrorMessage() {
		return $this -> errorMessage;
	}

	/**
	 * get a list of products in a dossier
	 * @param filter: array the dossierFK
	 * @param includestore boolean with or whithou the store name (??)
	 
	 * @return array
	 */
	public function getTrainingSessions() {
		global  $apiConfig;
		$result = array();
		$this -> logger -> addInfo("getTrainingSessions:".print_r($this -> trainingSessions,true));
		return $this -> trainingSessions;
	}

	/**
	 * get a list of products in a dossier
	 * @param filter: array the dossierFK
	 * @param includestore boolean with or whithou the store name (??)
	 
	 * @return array
	 */
	public function getSessionGroups($sessionId) {
		global  $apiConfig;
		$result = array();

		return $result;
	}

	/**
	 * get a list of products in a dossier
	 * @param filter: array the dossierFK
	 * @param includestore boolean with or whithou the store name (??)
	 
	 * @return array
	 */
	public function getSessionDrills($sessionId) {
		global  $apiConfig;
		$result = array();

		return $result;
	}

	private function readCsvSessionData() {
		global $apiConfig;

		$delimiter = ',';
		//exit($filename);

		$data = array();
		foreach($apiConfig['userGroups'] as $groupFolderName => $userGroupName) {
			$filename = $apiConfig['assetsPath'].$groupFolderName.'/sessies.csv';
			//	exit($filename);
			if(!file_exists($filename) || !is_readable($filename))
				continue;

			$header = NULL;
			if (($handle = fopen($filename, 'r')) !== FALSE) {
				while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE) {
					if(!$header)
						$header = $row;
					else
						$groupData[$groupFolderName][] = array_combine($header, $row);
				}
				fclose($handle);
			}
		}
		//$this -> logger -> addInfo("readCsvSessionData:".print_r($data,true));
		//$this -> logger -> addInfo("readCsvSessionData csv:".print_r(array_keys($data[0]),true));

//print_r($groupData);exit;
		//$this -> trainingSessions  = array();
		foreach ($groupData as $userGroupName => $data) {

			foreach($data as $drillIdx => $row) {
				foreach($row as $k => $v) {
					if (strstr($k, 'TS1-')) {
						$k = str_replace('TS1-', '', $k);

//print_r("\n--->K:".$k);						
						if ($v) {
		
							if (!isset($groupIdx[$k])) {
								$groupIdx[$k] =  -1;
								//print_r($groupIdx);
							}
							$this -> trainingSessions[$k]['id'] = $k;
							$this -> trainingSessions[$k]['description'] = $k;
							$this -> trainingSessions[$k]['descriptionHtml'] = $this -> toHTML($k);
							$this -> trainingSessions[$k]['userGroupName'] = $userGroupName;


							if (strlen($v) <= 5) {
								if (isset($this -> drills[$v])) {
									$drillId = $v;

									if (is_array($this -> trainingSessions[$k]['groups'][$groupIdx[$k]]['drills'])) {
										$groupDrillIdx = count($this -> trainingSessions[$k]['groups'][$groupIdx[$k]]['drills']);
									} else {
										$groupDrillIdx = 0;
									}
									
									$this -> trainingSessions[$k]['groups'][$groupIdx[$k]]['drills'][$groupDrillIdx] = $this -> drills[$v];
									$this -> trainingSessions[$k]['drills'][] = $this -> drills[$v];
									$this -> trainingSessions[$k]['groups'][$groupIdx[$k]]['drills'][$groupDrillIdx]['drillIdx'] = count($this -> trainingSessions[$k]['drills']);

									if (isset($this -> drills[$v]['intervals'])) {
										//exit("hier");	
										$this -> trainingSessions[$k]['intervals']  = $this -> drills[$v]['intervals'];	
									}									
								}
							} else {
//print("k:".$k);								
								$groupIdx[$k]++;
								$this -> trainingSessions[$k]['groups'][$groupIdx[$k]]['groupName'] = $v;
								
							
							}
						}

		//				$trainingSession['groups'][$idx]['groupName'] = $drill['group'];
		//				$trainingSession['groups'][$idx]['drills'][] = $drill;				
					} else if (strstr($k, 'TS2-')) {

						$k = str_replace('TS2-', '', $k);
						if ($v) {
							$this -> trainingSessions[$k]['groups'][$groupIdx[$k]]['drills'][$groupDrillIdx]['description'] = $v;
							$this -> trainingSessions[$k]['groups'][$groupIdx[$k]]['drills'][$groupDrillIdx]['descriptionHtml'] = $this -> toHTML($v);

							$tmpDrillIdx = $this -> trainingSessions[$k]['groups'][$groupIdx[$k]]['drills'][$groupDrillIdx]['drillIdx']-1;
							$this -> trainingSessions[$k]['drills'][$tmpDrillIdx]['description'] = $v;
							$this -> trainingSessions[$k]['drills'][$tmpDrillIdx]['descriptionHtml'] = $this -> toHTML($v);
							$this -> trainingSessions[$k]['groups'][$groupIdx[$k]]['drills'][$groupDrillIdx]['isAltDescription'] = true;
						}
					}

				}
				//$this -> drills[$drillId]
				//$this -> trainingSessions[$k]
			}
		}
		//print_r($this -> trainingSessions);exit;
	}	

	private function readCsvData() {
		global $apiConfig;

		$delimiter = ',';
		$filename = $apiConfig['csvfile'];

		if(!file_exists($filename) || !is_readable($filename))
			return FALSE;

		$header = NULL;
		$data = array();
		if (($handle = fopen($filename, 'r')) !== FALSE) {
			while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE) {
				if(!$header)
					$header = $row;
				else
					$data[] = array_combine($header, $row);
			}
			fclose($handle);
		}
		$this -> logger -> addInfo("readCsvData:".print_r($data,true));
		$this -> logger -> addInfo("readCsvData csv:".print_r(array_keys($data[0]),true));

		$keys = array_keys($data[0]);
		foreach($keys as $key) {
			if (preg_match('/^TS-/', $key)) {
				$trKeys[] = $key;
			}
		}
/*
define(COL_ID, 'ID');
define(COL_TITLE, 'Korte omschrijving');
define(COL_KRING, 'Kring');
define(COL_BAAN, '400m Baan');
define(COL_WARMING_UP, 'Warming up');
define(COL_CORE_STABILITY, 'Core stability');
define(COL_LOOPSCHOLING, 'Loopscholing');
define(COL_TUSSENPROGRAMMA, 'Tussenprogramma');
define(COL_HOOFDPROGRAMMA,

  id: string;
  title: string;
  description: string;
  locations: string;
  tags: string;
  orderBy: number;
*/
		foreach($data as $drillIdx => $row) {
			$drillId = $row[COL_ID];
			$drill['id'] = $drillId;
			
			$drill['title'] = $row[COL_TITLE];
			$drill['description'] = $row[COL_OMSCHRIJVING];
			$drill['descriptionHtml'] = $this -> toHTML($row[COL_OMSCHRIJVING]);
			if (strstr($row[COL_INTERVALS], ',')) {
				$drill['intervals'] = $row[COL_INTERVALS];
			}
			$drill['isKring'] = strtolower($row[COL_KRING]) === 'x';
			$drill['isBaan'] = strtolower($row[COL_BAAN]) === 'x';
			$drill['isWarmingUp'] = strtolower($row[COL_WARMING_UP]) === 'x';
			$drill['isCoreStability'] = strtolower($row[COL_CORE_STABILITY]) === 'x';
			$drill['isLoopschroling'] = strtolower($row[COL_LOOPSCHOLING]) === 'x';
			$drill['isTussenprogramma'] = strtolower($row[COL_TUSSENPROGRAMMA]) === 'x';
			$drill['isHoofdprogramma'] = strtolower($row[COL_HOOFDPROGRAMMA]) === 'x';
			$drill['isCoolingDown'] = strtolower($row[COL_COOLING_DOWN]) === 'x';
			$drill['isAltDescription'] = false;
			$drill['hasVideo'] = false;


			foreach($row as $k => $v) {

$this -> logger -> addInfo("readCsvData row:".print_r($row,true));
//$this -> logger -> addInfo("SERVER:".print_r($_SERVER,true));

				if (strstr($k, 'TS-')) {

					$k = str_replace('TS-', '', $k);
					// is a training session column
					if ($v) {

						$arr = explode(".", $v);
						if (count($arr) >= 3) {

							$this -> logger -> addInfo("readCsvData arr:".print_r($arr,true));
							$this -> logger -> addInfo("readCsvData apiConfig-:".print_r($apiConfig,true));
							$idx = $arr[2];
							$drill['group'] = $apiConfig['titles'][$arr[0]] .' - '. $apiConfig['titles'][$arr[1]];
							$drill['imgUrl'] = '';
							$filename = strtolower($drillId.'.png');

							$this -> logger -> addInfo("imageUrl-path:".$apiConfig['imageUrl'] . $filename);
							$i = 1;
							$filename = strtolower($drillId.'-'.$i.'.png');
							$drill['imgUrls'] = array();
							$this -> logger -> addInfo("Check if File exists:".$apiConfig['imagedir'].$filename);
							$drill['imgUrl'] = ""; //$apiConfig['imageUrl'].'kettinglopers.png';
							while (file_exists($apiConfig['imagedir'].$filename)) {
								$this -> logger -> addInfo("File exists!");
								$drill['imgUrls'][] = $drill['imgUrl'] = $apiConfig['imageUrl'].$filename;
								$i++;
								$filename = strtolower($drillId.'-'.$i.'.png');
								}

							$drill['videoUrl'] = false;
							if ($row[COL_YOUTUBE_ID]) {
								$drill['videoUrl'] = 'https://www.youtube.com/embed/'.$row[COL_YOUTUBE_ID].'&rel=0&autoplay=1';
							}
							if ($row[COL_VIDEO]) {
								$drill['hasVideo'] = true;
							}
							//$drill['videoUrl'] = 'https://www.youtube.com/embed/jnS8UT6_Uws?rel=0'; //'http://www.youtube.com/embed/shGhZzJ7o-g?rel=0'

							if (strtolower($row[COL_ALT_DESCRIPTION]) === 'x' && count($arr)>3) {
								$drill['description'] = implode(".", array_slice($arr, 3));
								$drill['isAltDescription'] = true;
							}

							$trainingSessions[$k]['id'] = $k;
							$trainingSessions[$k]['description'] = $k;
							$trainingSessions[$k]['descriptionHtml'] = $this -> toHTML($k);
							$trainingSessions[$k]['userGroupName'] = 'alle';
							$trainingSessions[$k]['drills'][$idx] = $drill;
							$trainingSessions[$k]['drills'][$idx]['drillIdx'] = count($trainingSessions[$k]['drills']);
						}

					}
				}

			}
			$this -> drills[$drillId] = $drill;

		}

//print_r($trainingSessions);exit;
		foreach($trainingSessions as $k => $trainingSession) {
			$drills = $trainingSession['drills'];
			ksort($drills);
			$trainingSession['drills'] = array_values($drills);
			$groups = array();
			$groupName = '';
			$idx = -1;
			foreach($trainingSession['drills'] as $drill) {

//print_r($drill);
				$this -> logger -> addInfo("Loop(".$drill['group']."):".$groupName);
				if ($groupName !== $drill['group']) {
					$this -> logger -> addInfo("change groupname(".$drill['group']."):".$groupName);
					$groupName = $drill['group'];
					$idx++;
				}

				$trainingSession['groups'][$idx]['groupName'] = $drill['group'];
				$trainingSession['groups'][$idx]['drills'][] = $drill;
			}
			$this -> logger -> addInfo("trainingSession:".print_r($trainingSession,true));
			$this -> trainingSessions[$k] = $trainingSession;
		}
		//print_r($this -> trainingSessions); exit;
		
		return true;
	}

	private function toHTML($text) {
		$result = nl2br($text);
		return $result;
	}

	private function _readCsvData() {
		global $apiConfig;
		$rows = array_map('str_getcsv', file($apiConfig['csvfile']));

//$this -> logger -> addInfo("readCsvData:".print_r($array,true));

		$header = array_shift($rows);

		foreach ($rows as $row) {
			$this -> logger -> addInfo("row:".print_r($row,true));
			$row = array_combine($header, $row);
		}
		
		//array_shift($array);
		//$arr = array_pop($array);

		
		//array_walk($arr, array($this,'_combineArray'), $header);
		return $arr;
	}

	private function _combineArray(&$row, $key, $header) {
$this -> logger -> addInfo("row:".print_r($row,true));
		$row = array_combine($header, $row);
	}

	/**
	 * get a list of products in a dossier
	 * @param filter: array the dossierFK
	 * @param includestore boolean with or whithou the store name (??)
	 
	 * @return array
	public function getProducts($filter=array(), $includeStore=true) {
		global  $apiConfig;

		extract($filter);

		$productQuery = ProductQuery::create();

		if (isset($DossierPk)) {
			$productQuery->filterByDossierFk($DossierPk);
		}
		
		$products = $productQuery-> orderByCreationDate()->find();

		$arrResult = false;
		$idx = 0;
		while (!$products -> isEmpty()) {
			$product = $products -> pop();
			$this -> logger -> addInfo('getProducts...2'.print_r($product,true));
			$arrResult[$idx] = $product -> toArray();
			$translatemethod = "monthname_" . $apiConfig['language'];

			$arrResult[$idx]['FormattedDueDate'] = '';
			if ($product -> getCreationDate()) {
				$arrResult[$idx]['FormattedCreationDate'] = strftime ("%d %B %Y", $product -> getCreationDate() -> getTimestamp());
			}
			if ($product -> getPurchaseDate()) {
				$arrResult[$idx]['FormattedPurchaseDate'] = strftime ("%d %B %Y", $product -> getPurchaseDate() -> getTimestamp());
			}
			if ($product -> getDueDate()) {
				$arrResult[$idx]['FormattedDueDate'] = strftime ("%d %B %Y", $product -> getDueDate() -> getTimestamp());
			}
			$arrResult[$idx]['ProductImgUrl'] = $this -> getAssetUrl($product, "product");
			$arrResult[$idx]['ReceiptImgUrl'] = $this -> getAssetUrl($product, "receipt");
			$arrResult[$idx]['CommentsCount'] = $product -> getProductComments() -> count();
			
			// money_format will give errors in Windows!!
			if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
				$arrResult[$idx]['DisplayPrice'] =  $product -> getPrice() ;			
			} else {
				$arrResult[$idx]['DisplayPrice'] = str_replace(".",",", money_format("%.2n", $product -> getPrice()));
			}

			if ($includeStore) {
				$arrResult[$idx]['StoreImgUrl'] = $apiConfig['emptyImgUrl'];
				if ($product -> getStoreFk() != null) {
					$store  = $product -> getStore();
				}
				if ($product -> getStoreChainFk() != null) {
					$storeChain  = $product -> getStoreChain();
					$arrResult[$idx]['StoreImgUrl'] = $apiConfig['storeImgUrl'] . $storeChain -> getImgUrl();
				}

			}
			$idx++;
		}
		return $arrResult;
	}
	 */




}