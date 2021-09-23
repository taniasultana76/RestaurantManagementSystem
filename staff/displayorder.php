
<?php
	include("../functions.php");

	if((!isset($_SESSION['uid']) && !isset($_SESSION['username']) && isset($_SESSION['user_level'])) ) 
		header("Location: login.php");

	if($_SESSION['user_level'] != "staff")
		header("Location: login.php");

	
	if(empty($_GET['cmd'])) 
		die(); 

	
	if ($_GET['cmd'] == 'currentorder')	{
		
		$displayOrderQuery =  "
					SELECT  o.orderID,OD.username, m.menuName, OD.itemID,MI.menuItemName,OD.quantity,O.status
					FROM  tbl_order O
					LEFT JOIN tbl_orderdetail OD
					ON O.orderID = OD.orderID
					LEFT JOIN tbl_menuitem MI
					ON OD.itemID = MI.itemID
					LEFT JOIN tbl_menu M
					ON MI.menuID = M.menuID
					WHERE O.status 
					IN ( 'waiting','preparing','ready')
				";

			if ($orderResult = $sqlconnection->query($displayOrderQuery)) {
					
				$currentspan = 0;

				
				if ($orderResult->num_rows == 0) {

					echo "<tr><td class='text-center' colspan='7' >No order for now :) </td></tr>";
				}

				else {
					while($orderRow = $orderResult->fetch_array(MYSQLI_ASSOC)) {

						$rowspan = getCountID($orderRow["orderID"],
							"orderID","tbl_orderdetail"); 

						if ($currentspan == 0)
							$currentspan = $rowspan;
						echo "<tr>";

						if ($currentspan == $rowspan) {
							echo "<td rowspan=".$rowspan."># ".$orderRow['orderID']."</td>";
							echo "<td rowspan=".$rowspan."> ".$orderRow['username']."</td>";
						}



						echo "
							
							<td>".$orderRow['menuName']."</td>
							<td>".$orderRow['menuItemName']."</td>
							<td class='text-center'>".$orderRow['quantity']."</td>
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
									
									echo "<button onclick='editStatus(this,".$orderRow['orderID'].")' class='btn btn-outline-warning' value = 'finish'>Send</button>";

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

	
	if ($_GET['cmd'] == 'currentready') {

		$latestReadyQuery = "SELECT * FROM tbl_order WHERE status IN ( 'finish','ready') AND username = '{$_SESSION['username']}' ";

		if ($result = $sqlconnection->query($latestReadyQuery)) {

			if ($result->num_rows == 0) {
				echo "<tr><td class='text-center'>No order ready to serve. </td></tr>";
			}

            while($latestOrder = $result->fetch_array(MYSQLI_ASSOC))
             {
             	
             		echo "<tr><td><i class='fas fa-bullhorn' style='color:green;'></i><b> Order #".$latestOrder['orderID']."</b>
            	<br>price: <b>".$latestOrder['total']." tk</b></br>
            	Time: <b>".$latestOrder['time']."</b></br><b>This order are ready in kitchen please receive and serve.</b><a href='editstatus.php?orderID=".$latestOrder['orderID']."'><i class='fas fa-check float-right'></i></a></td></tr>";
             		
             	
            }
        }
	}

?>