<?php

include 'db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	header('Content-type: Application/json');

	$response = array();
	$response["code"] = 404;
	$response["error"] = "Somthing went wrong in the server";

	$qr = "SELECT reserve.id as id_reserve, bikes.id_bike as id, bikes.name as name, reserve.duration as duration, reserve.booking_time as timestamp
			FROM bikes, users, reserve
			WHERE bikes.id_bike = reserve.id_bike AND users.id_user = reserve.id_user
			AND users.id_user = ".$_POST['id_user'];

	$query = $db->query($qr);

	if ($query->rowCount() >= 1) {
		$row = $query->fetchAll(PDO::FETCH_ASSOC);

		$response["data"] = $row;

		$response["code"] = 200;
	}else{
		$response["code"] = 300;
		$response["error"] = "Username/password incorrect";
	}

	echo json_encode($response);

}

?>