<?php

include 'db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	header('Content-type: Application/json');

	$response = array();

	$query = $db->query("INSERT INTO `users`(`id_user`, `first_name`, `last_name`, `username`, `password`, `email`) 
		VALUES (NULL,'".$_POST['first_name']."','".$_POST['last_name']."','".$_POST['first_name']."','".$_POST['password']."','".$_POST['email']."')");

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
