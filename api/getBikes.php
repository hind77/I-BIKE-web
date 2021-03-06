<?php

include 'db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	header('Content-type: Application/json');

	$response = array();
	$response["code"] = 404;
	$response["error"] = "Somthing went wrong in the server";

	$qr = "SELECT id_bike, lat, name, state, lng, station,
	( 6371 * acos( cos( radians(".$_POST['lat'].") ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(".$_POST['lng'].") ) + sin( radians(".$_POST['lat'].") ) * sin( radians( lat ) ) ) ) AS distance 
	FROM bikes 
	HAVING distance < 1 
	ORDER BY distance 
	LIMIT 0 , 20;";

	$query = $db->query($qr);

	if ($query->rowCount() >= 1) {
		$row = $query->fetchAll(PDO::FETCH_ASSOC);

		$response["data"] = $row;

		$response["code"] = 200;
	}else{
		$response["code"] = 300;
		$response["error"] = "Something went wrong in the server";
	}

	echo json_encode($response);

}

?>