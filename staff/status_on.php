<?php
	include("../functions.php");

	if((!isset($_SESSION['uid']) && !isset($_SESSION['username']) && isset($_SESSION['user_level'])) ) 
		header("Location: login.php");

	if($_SESSION['user_level'] != "staff")
		header("Location: login.php");

	if (isset($_POST['status']) && isset($_POST['orderID'])) {

		$status = $sqlconnection->real_escape_string($_POST['status']);
		$orderID = $sqlconnection->real_escape_string($_POST['orderID']);

		$addOrderQuery = "UPDATE tbl_online_order SET status = '{$status}' WHERE orderID = {$orderID};";

		if ($sqlconnection->query($addOrderQuery) === TRUE) {
				echo "inserted.";
			} 

		else {
				
				echo "someting wong";
				echo $sqlconnection->error;

		}

	}

	if (isset($_GET['orderID'])) {

		$status = "Delivered";
		$orderID = $sqlconnection->real_escape_string($_GET['orderID']);

		$addOrderQuery = "UPDATE tbl_online_order SET status = '{$status}' WHERE orderID = {$orderID};";

		if ($sqlconnection->query($addOrderQuery) === TRUE) {
				echo "inserted.";
				header("Location: index.php");
			} 

		else {
				
				echo "someting wong";
				echo $sqlconnection->error;

		}

	}



?>