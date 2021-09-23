<?php
	include("../functions.php");

	if((!isset($_SESSION['uid']) && !isset($_SESSION['username']) && isset($_SESSION['user_level'])) ) 
		header("Location: login.php");

	if($_SESSION['user_level'] != "staff")
		header("Location: login.php");

	

	if (isset($_POST['sentorder'])) {

		if (isset($_POST['itemID']) && isset($_POST['itemqty'])) {

			$arrItemID = $_POST['itemID'];
			$arrItemQty = $_POST['itemqty'];			

			
			if (count($arrItemID) == count($arrItemQty)) {				
				$arrlength = count($arrItemID);

				
				$currentOrderID = getLastID("orderID","tbl_order") + 1;

				insertOrderQuery($currentOrderID);

				for ($i=0; $i < $arrlength; $i++) { 
					insertOrderDetailQuery($currentOrderID,$arrItemID[$i] ,$arrItemQty[$i]);
				}

				updateTotal($currentOrderID);

				
				header("Location: index.php");
				exit();
			}

			else {
				echo "false";
			}
		}	
	}

	function insertOrderDetailQuery($orderID,$itemID,$quantity) {
		global $sqlconnection;
		$addOrderQuery = "INSERT INTO tbl_orderdetail (username,orderID ,itemID ,quantity) VALUES ('{$_SESSION['username']}','{$orderID}', '{$itemID}' ,{$quantity})";

		if ($sqlconnection->query($addOrderQuery) === TRUE) {
				echo "inserted.";
			} 

		else {
				
				echo "someting wong";
				echo $sqlconnection->error;

		}
	}

	function insertOrderQuery($orderID) {
		global $sqlconnection;
		$addOrderQuery = "INSERT INTO tbl_order (orderID ,username,status ,order_date,time,chef) VALUES ('{$orderID}' ,'{$_SESSION['username']}','waiting' ,CURDATE(),CURTIME(),'No response' )";

		if ($sqlconnection->query($addOrderQuery) === TRUE) {
				echo "inserted.";
			} 

		else {
				
				echo "someting wong";
				echo $sqlconnection->error;

		}
	}

?>