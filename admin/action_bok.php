<?php

include("../functions.php");

$output='';

if(isset($_POST['query'])){
	$search=$_POST['query'];
	$stmt=$sqlconnection->prepare("SELECT * FROM tbl_book WHERE  name LIKE CONCAT('%',?,'%') OR address LIKE CONCAT('%',?,'%') OR mobile LIKE CONCAT('%',?,'%') OR item LIKE CONCAT('%',?,'%') OR people LIKE CONCAT('%',?,'%') OR date LIKE CONCAT('%',?,'%') OR message LIKE CONCAT('%',?,'%')");
	$stmt->bind_param("sssssss",$search,$search,$search,$search,$search,$search,$search);
}
else{
	$stmt=$sqlconnection->prepare("SELECT * FROM tbl_book ");
}

	$stmt->execute();
	$result=$stmt->get_result();

	if($result->num_rows>0){
		$output = "<thead class='bg-dark text-white' >
						<tr>
						
						<th>Customer Name</th>
			            <th>Address</th>
			            <th>Mobile-No</th>
			            <th>Items</th>
			            <th>People</th>
			            <th>Date</th>
			            <th>Message</th>
            
            
						
					
						</tr>
					</thead>
					<tbody>";
				while($row=$result->fetch_assoc()){
					$output .="
					<tr>
						
						<td>".$row['name']."</td>
						<td>". $row['address']."</td>
						<td>". $row['mobile']."</td>
						<td>". $row['item']."</td>
						<td>".$row['people']."</td>
						<td>". $row['date']."</td>
						<td>". $row['message']."</td>
						
						
					</tr>
					";
				}

				$output .="</tbody>";
				echo $output;

				}
				else{
					echo "<h3>No People Fonds!</h3>";
				}
?>