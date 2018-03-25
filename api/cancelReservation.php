<?php

include 'db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	header('Content-type: Application/json');

	$response = array();

	$query = $db->query("DELETE FROM `reserve` WHERE id=".$_POST['id_reserve']);

	if ($query) {
		
		$query = $db->query("UPDATE `bikes` SET `state`= '0' WHERE id_bike = ".$_POST['id_bike']);
		if($query){
			$response["code"] = 200;
		}else{
			$response["code"] = 300;
			$response["error"] = "Something went wrong";
		}
	}else{
		$response["code"] = 300;
		$response["error"] = "Something went wrong";
	}

	echo json_encode($response);
	//test

}

?>