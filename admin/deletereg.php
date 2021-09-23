<?php

	include("../functions.php");

	if((!isset($_SESSION['uid']) && !isset($_SESSION['username']) && isset($_SESSION['user_level'])) ) 
		header("Location: login.php");

	if($_SESSION['user_level'] != "admin")
		header("Location: login.php");

	
	if (isset($_GET['id'])) {
		
		$del_menuID = $sqlconnection->real_escape_string($_GET['id']);
		
		$deleteItemQuery = "DELETE FROM tbl_log_od WHERE id = {$del_menuID}";

		if ($sqlconnection->query($deleteItemQuery) === TRUE) {
				echo "deleted.";
				header("Location: regi.php"); 
				exit();
			} 

		else {
				
				echo "someting wong";
				echo $sqlconnection->error;

		}
		
	}
?>