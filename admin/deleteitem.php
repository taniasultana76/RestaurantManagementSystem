<?php

	include("../functions.php");

	if((!isset($_SESSION['uid']) && !isset($_SESSION['username']) && isset($_SESSION['user_level'])) ) 
		header("Location: login.php");

	if($_SESSION['user_level'] != "admin")
		header("Location: login.php");

	
	if (isset($_GET['menuID']) && isset($_GET['itemID'])) {
		
		$del_menuID = $sqlconnection->real_escape_string($_GET['menuID']);
		$del_itemID = $sqlconnection->real_escape_string($_GET['itemID']);

		$deleteItemQuery = "DELETE FROM tbl_menuitem WHERE menuID = {$del_menuID} AND itemID = {$del_itemID}";

		if ($sqlconnection->query($deleteItemQuery) === TRUE) {
				echo "deleted.";
				header("Location: menu.php"); 
				exit();
			} 

		else {
				
				echo "someting wong";
				echo $sqlconnection->error;

		}
		
	}
?>