<?php

include 'db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	header('Content-type: Application/json');

	$response = array();
	$response["code"] = 404;
	$response["error"] = "Somthing went wrong in the server";

	$qr = "SELECT * FROM health WHERE health.id_user = ".$_POST['id_user'] ;

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