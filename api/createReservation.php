<?php

include 'db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	header('Content-type: Application/json');

	$response = array();

	$query = $db->query("INSERT INTO `reserve`(`id`, `id_user`, `id_bike`, `duration`) 
		VALUES (NULL,".$_POST['id_user'].",".$_POST['id_bike'].",".$_POST['duration'].")");

	if ($query) {
		$response["code"] = 200;
	}else{
		$response["code"] = 300;
		$response["error"] = "Something went wrong";
	}

	echo json_encode($response);
	//test

}

?>
