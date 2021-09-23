
<?php
	include("../functions.php");

	if((!isset($_SESSION['uid']) && !isset($_SESSION['username']) && isset($_SESSION['user_level'])) ) 
		header("Location: login.php");

	if($_SESSION['user_level'] != "staff")
		header("Location: login.php");

	if(empty($_GET['cmd'])) 
		die(); 

	
	if ($_GET['cmd'] == 'currentorder1')	{
		
		$displayOrderQuery =  "SELECT * FROM tbl_online_order
					WHERE status 
					IN ( 'waiting','preparing','ready')
				";

			if ($orderResult = $sqlconnection->query($displayOrderQuery)) {
					
				$currentspan = 0;

				
				if ($orderResult->num_rows == 0) {

					echo "<tr><td class='text-center' colspan='12' >No order for now :) </td></tr>";
				}

				else {
					while($orderRow = $orderResult->fetch_array(MYSQLI_ASSOC)) {

						$rowspan = getCountID($orderRow["orderID"],
							"orderID","tbl_online_order"); 

						if ($currentspan == 0)
							$currentspan = $rowspan;

						echo "<tr>";

						if ($currentspan == $rowspan) {
							echo "<td rowspan=".$rowspan."># ".$orderRow['orderID']."</td>";
							echo "<td rowspan=".$rowspan."> ".$orderRow['cus_name']."</td>";
						}



						echo "
							<td>".$orderRow['phone']."</td>
							
							<td>".$orderRow['food']."</td>
							<td>".$orderRow['qty']."</td>
							<td class='text-center'>".$orderRow['price']."</td>
							<td class='text-center'>".$orderRow['qty'] * $orderRow['price'] ."</td>
							<td>".$orderRow['date']."</td>
						";

						if ($currentspan == $rowspan) {

							$color = "badge badge-warning";
							switch ($orderRow['status']) {
								case 'waiting':
									$color = "badge badge-warning";
									break;
								
								case 'preparing':
									$color = "badge badge-primary";
									break;

								case 'ready':
									$color = "badge badge-success";
									break;
							}

							echo "<td class='text-center' rowspan=".$rowspan."><span class='{$color}'>".$orderRow['status']."</span></td>";
							
							echo "<td class='text-center' rowspan=".$rowspan.">";

							
							switch ($orderRow['status']) {
								case 'waiting':
									
									echo "<button onclick='editStatus(this,".$orderRow['orderID'].")' class='btn btn-outline-primary' value = 'preparing'>Preparing</button>";
									echo "<button onclick='editStatus(this,".$orderRow['orderID'].")' class='btn btn-outline-success' value = 'ready'>Ready</button>";

									break;
								
								case 'preparing':
									
									echo "<button onclick='editStatus(this,".$orderRow['orderID'].")' class='btn btn-outline-success' value = 'ready'>Ready</button>";

									break;

								case 'ready':
									
									echo "<button onclick='editStatus(this,".$orderRow['orderID'].")' class='btn btn-outline-warning' value = 'on the way'>Send</button>";

									break;
							}

							echo "<button onclick='editStatus(this,".$orderRow['orderID'].")' class='btn btn-outline-danger' value = 'cancelled'>Cancel</button></td>";


							echo "</td>";

							
						}

						echo "</tr>";

						$currentspan--;
					}
				}	
			}
	}

	
	if ($_GET['cmd'] == 'currentready1') {

		$latestReadyQuery = "SELECT * FROM tbl_online_order WHERE status IN ( 'on the way ','ready')  ";

		if ($result = $sqlconnection->query($latestReadyQuery)) {

			if ($result->num_rows == 0) {
				echo "<tr><td class='text-center'>No order ready to serve. </td></tr>";
			}

            while($latestOrder = $result->fetch_array(MYSQLI_ASSOC)) {
            	echo "<tr><td> Order-ID: <b>".$latestOrder['orderID']."</b><br>Date/Time: <b>".$latestOrder['date']."</b><br>Customer name: <b>".$latestOrder['cus_name']."</b><br>Contact No: <b>".$latestOrder['phone']."</b><br>Address: <b>".$latestOrder['address']."</b><br>Food Name: <b>".$latestOrder['food']."</b><br>Quantity: <b>".$latestOrder['qty']."</b><br>Total: <b>".$latestOrder['total']." tk</b><br><center>This order are ready in kitchen receive and Deliver.</center><a href='status_on.php?orderID=".$latestOrder['orderID']."'><i class='fas fa-check float-right'></i></a></td></tr>";

            }
        }
	}

?>