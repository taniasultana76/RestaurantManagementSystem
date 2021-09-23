<?php

include("../functions.php");

$output='';

if(isset($_POST['query'])){
	$search=$_POST['query'];
	$stmt=$sqlconnection->prepare("SELECT * FROM tbl_log_od WHERE  username LIKE CONCAT('%',?,'%') OR email LIKE 
		CONCAT('%',?,'%') OR gen LIKE 
		CONCAT('%',?,'%') ");
	$stmt->bind_param("sss",$search,$search,$search);
}
else{
	$stmt=$sqlconnection->prepare("SELECT * FROM tbl_log_od ");
}

	$stmt->execute();
	$result=$stmt->get_result();

	if($result->num_rows>0){
		$output = "<thead class='bg-dark text-white' >
						<tr>
						
						<th>Name</th>
						<th>Email</th>
						<th>Address</th>
						<th>Gender</th>
						<th>Image</th>
						<th>Action</th>
						
					
						</tr>
					</thead>
					<tbody>";
				while($row=$result->fetch_assoc()){
					$output .="
					<tr>
						
						<td>".$row['username']."</td>
						<td>". $row['email']."</td>
						<td>". $row['address']."</td>
						
						<td>".$row['gen']."</td>
						<td><img src='images/". $row['img']."'style='width: 40px;height: 50px';></td>
						<td><a href='deletereg.php?id=".$row['id'].";?>'
						class='badge badge-danger'>Delete</a></td>
						
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