<?php

include 'db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	header('Content-type: Application/json');

	$response = array();
	$response["code"] = 404;
	$response["error"] = "Somthing went wrong in the server";

	$query = $db->query("SELECT * FROM users WHERE username = '".$_POST['username']."' AND password = '".$_POST['password']."'");

	if ($query->rowCount() >= 1) {
		$row = $query->fetch(PDO::FETCH_ASSOC);

		$response["data"] = array(
			"id" => $row["id_user"],
			"fname" => $row["first_name"],
			"lname" => $row["last_name"],
			"email" => $row["email"]
		);

		$response["code"] = 200;
	}else{
		$response["code"] = 300;
		$response["error"] = "Username/password incorrect";
	}

	echo json_encode($response);

}

?>