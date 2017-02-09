<?php

class ApiHandler {

	//  http://garantieapp.local/api/assets/EB6BC0CB-6972-4F17-8F6F-EAD790E66E4B.FB6C749B-CCDA-40B0-8345-143048161B35.7.r
	public static function getAsset($request, $response, $args)   {
		global $apiConfig;
		$params = $request -> getParsedBody();
		$handler = new DrillHandler();
		//print_r($args);exit;
		$handler -> logger -> addInfo("getAsset - start:".print_r($params,true));

		if (isset($args['id'])) {
			$assetPath = $apiConfig['assetsPath'].'/'.$args['id'].'.jpg';
			if ($assetPath) {
				$type = 'image/png';
				header('Content-Type:'.$type);
				header('Content-Length: ' . filesize($assetPath));
				readfile($assetPath);
				exit;
			} 
		}

		echo "Failed";
	}

	public static function getTrainingSessions($request, $response, $args) {
		global $handler,  $apiConfig;

		$handler -> logger -> addInfo("getTrainingSessions - start");
		
		$params = $request -> getParsedBody();

		if (($trainingsSessions = $handler -> getTrainingSessions()) == false) {
			$result['data'] = array();
			$result ["status"] = false;
			$result ["message"] = $handler -> getErrorMessage();
		} else {
			$result['data'] = array_values($trainingsSessions);
			$result['status'] = true;
			$result ["message"] = '';
		}

		$handler -> logger -> addInfo("getTrainingSessions - done");
		echo json_encode($result);
	}

	public static function getSessionGroups($request, $response, $args) {
		global $handler,  $apiConfig;

		$handler -> logger -> addInfo("getSessionGroups - start");
		
		$params = $request -> getParsedBody();

		if (!isset($params['sessionId']) && ($trainingsSessions = $handler -> getSessionGroups($params['sessionId']) == false)) {
			$result['data'] = array();
			$result ["status"] = false;
			$result ["message"] = $handler -> getErrorMessage();
		} else {
			$result['data'] = $trainingsSessions;
			$result['status'] = true;
			$result ["message"] = '';
		}

		$handler -> logger -> addInfo("getSessionGroups - done");
		echo json_encode($result);
	}

	public static function getSessionDrills($request, $response, $args) {
		global $handler,  $apiConfig;

		$handler -> logger -> addInfo("getSessionDrills - start");
		
		$params = $request -> getParsedBody();
		try {

			if (($trainingsSessions = $handler -> getSessionDrills()) == false) {
				$result['data'] = array();
				$result ["status"] = false;
				$result ["message"] = $handler -> getErrorMessage();
			} else {
				$result['data'] = $trainingsSessions;
				$result['status'] = true;
				$result ["message"] = '';
			}
		} catch (Exception $e) {
			print_r($e);exit;
		}

		$handler -> logger -> addInfo("getSessionDrills - done");
		echo json_encode($result);
	}

	public static function getDrillsForCategory($request, $response, $args)   {
		global $apiConfig, $handler;
		$handler -> logger -> addInfo("getSessionDrills - start");
		
		$params = $request -> getParsedBody();
		$categoryPk = 0;
		if (@isset($args['id'])) {
			$categoryPk = $args['id'];
		}
		try {

			if (($drillsForSession = $handler -> getDrillsForSessionDrills(1, $categoryPk)) == false) {
				$result['data'] = array();
				$result ["status"] = false;
				$result ["message"] = $handler -> getErrorMessage();
			} else {
				$result['data'] = $drillsForSession;
				$result['status'] = true;
				$result ["message"] = '';
			}
		} catch (Exception $e) {
			print_r($e);exit;
		}

		$handler -> logger -> addInfo("getSessionDrills - done");
		echo json_encode($result);
	}


	public static function importSessionDrills() {
		global $handler;
		$handler -> importSessionDrills();
	}

}