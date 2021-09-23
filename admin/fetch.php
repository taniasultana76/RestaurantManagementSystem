 <?php
 include("../functions.php");


$connect = new PDO("mysql:host=localhost;dbname=fosdb", "root", "");
$column = array('orderID', 'username', 'status', 'time','order_date','chef', 'total');

$query = "SELECT * FROM tbl_order 
WHERE  orderID LIKE '%".$_POST["search"]["value"]."%'
OR username LIKE'%".$_POST["search"]["value"]."%'
OR status LIKE '%".$_POST["search"]["value"]."%'
OR time LIKE '%".$_POST["search"]["value"]."%'
OR order_date LIKE '%".$_POST["search"]["value"]."%'
OR chef LIKE '%".$_POST["search"]["value"]."%'
OR total LIKE '%".$_POST["search"]["value"]."%'  ";

if(isset($_POST))
{
	$query .='ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']
	['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY id DESC';

}

$query1 = '';

if($_POST["length"] != -1)
{
	$query1 = 'LIMIT '  . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = $connect->prepare($query);

$statement->execute();

$number_filter_row = $statement->rowCount();

$statement = $connect->prepare($query . $query1);

$statement->execute();

$result = $statement->fetchAll();

$data = array();

$total_order = 0;

foreach($result as $row )
{
	$sub_array = array();
	$sub_array[] = $row["orderID"];
	$sub_array[] = $row["username"];
	$sub_array[] = $row["status"];
	$sub_array[] = $row["time"];
	$sub_array[] = $row["order_date"];
	$sub_array[] = $row["chef"];
	$sub_array[] = $row["total"];
	$total_order = $total_order + floatval($row["total"]);
	
	$data[] =  $sub_array;

}

function count_all_data($connect)
{
	$query = "SELECT * FROM tbl_order";
	$statement = $connect->prepare($query);
	$statement->execute();
	return $statement->rowCount();

}

 

$output = array(
	'draw'            => intval($_POST["draw"]),
	'recordsTotal'    => count_all_data($connect),
	'recordsFiltered' => $number_filter_row,
	'data'            => $data,
	'total'           => number_format($total_order, 2)
);

echo json_encode($output);
?>