
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
					SELECT  o.orderID,O.chef, m.menuName, OD.itemID,MI.menuItemName,OD.quantity,O.status,O.total,O.order_date,MI.price
					FROM  tbl_order O
					LEFT JOIN tbl_orderdetail OD
					ON O.orderID = OD.orderID
					LEFT JOIN tbl_menuitem MI
					ON OD.itemID = MI.itemID
					LEFT JOIN tbl_menu M
					ON MI.menuID = M.menuID
					WHERE O.chef
					='{$_SESSION['username']}'
				";

			if ($orderResult = $sqlconnection->query($displayOrderQuery)) {
					
				$currentspan = 0;

				
				if ($orderResult->num_rows == 0) {

					echo "<tr><td class='text-center' colspan='7' >No data available :) </td></tr>";
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
							echo "<td rowspan=".$rowspan."> ".$orderRow['chef']."</td>";
							echo "<td rowspan=".$rowspan."> ".$orderRow['status']."</td>";

						}



						echo "
							
							<td>".$orderRow['menuName']."</td>
							<td>".$orderRow['menuItemName']."</td>
							<td class='text-center'>".$orderRow['quantity']."</td>
							<td class='text-center'>".$orderRow['price']."</td>

						";

						if ($currentspan == $rowspan) {
							
							echo "<td rowspan=".$rowspan."> ".$orderRow['total']."</td>";
							echo "<td rowspan=".$rowspan."> ".$orderRow['order_date']."</td>";
						}

						

						echo "</tr>";

						$currentspan--;
					}
				}	
			}
	}

	
	
?>