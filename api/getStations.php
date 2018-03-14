<?php

include 'db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	header('Content-type: Application/json');

	$response = array();
	$response["code"] = 404;
	$response["error"] = "Somthing went wrong in the server";

	$qr = "SELECT id_station, lat, name, lng, num_bikes,
	( 6371 * acos( cos( radians(".$_POST['lat'].") ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(".$_POST['lng'].") ) + sin( radians(".$_POST['lat'].") ) * sin( radians( lat ) ) ) ) AS distance 
	FROM stations
	
	ORDER BY distance 
	LIMIT 1;";

	$query = $db->query($qr);

	if($query){
		if ($query->rowCount() >= 1) {
			$row = $query->fetchAll(PDO::FETCH_ASSOC);

			$response["data"] = $row;

			$response["code"] = 200;
		}else{
			$response["error"] = "Sorry there's no nearby station";
		}
	}else{
		$response["code"] = 300;
		$response["error"] = "Something went wrong in the server";
	}

	echo json_encode($response);

}

?>