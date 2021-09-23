	<?php
	include("../functions.php");

  
 

	

	if (isset($_POST['status']) && isset($_POST['orderID'])) {
	

		$status = "cancelled";
		$orderID = $sqlconnection->real_escape_string($_POST['orderID']);

		$addOrderQuery = "UPDATE tbl_online_order SET status = '{$status}',time = CURTIME() WHERE orderID = {$orderID};";

		if ($sqlconnection->query($addOrderQuery) === TRUE) {
				echo "inserted.";
			} 

		else {
				
				echo "someting wong";
				echo $sqlconnection->error;

		}

	}

	

