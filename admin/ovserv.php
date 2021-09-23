<?php
	include("../functions.php");
	include("addmenu.php");
	
	include("deletemenu.php");

	if((!isset($_SESSION['uid']) && !isset($_SESSION['username']) && isset($_SESSION['user_level'])) ) 
		header("Location: login.php");

	if($_SESSION['user_level'] != "admin")
		header("Location: login.php");
?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Menu - FOS Admin</title>

   <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	
	<link href="css/sb-admin.css" rel="stylesheet">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css"/>
  <link  rel="stylesheet"href="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"/></script>

	
<style>
* {
  box-sizing: border-box;
}

.row {
  display: flex;
  margin-left:-5px;
  margin-right:-5px;
}

.column {
  flex: 22%;
  padding: 5px;
}

table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 2px solid black;
  border-radius: 2px;
}
th{
	background-color: black;
	color: white;

}
td{
	color: red;
	font-weight: 50px;
}

th, td {
  text-align:center;
  padding: 16px;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}
</style>
  </head>

  <body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

      <a class="navbar-brand mr-1" href="index.php" style="font-family:'Brush Script MT', cursive;font-size: 30px;color: white">Tania's Dain</a>

       
      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>

     
      <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           <font style="color: white;"> <b><?php echo $_SESSION['username']; ?></b></font>
             <img class='img-circle profile_img'style="border-radius:55%" height="40" width="40" src="images/<?php echo $_SESSION['img']; ?>">
          </a>
        </li>
      </ul>

    </nav>

    <div id="wrapper">

       <ul class="sidebar navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
          </a>
        </li>

         <li class="nav-item">
          <a class="nav-link" href="ovserv.php">
           <i class="fas fa-hourglass-half"></i>
            <span>Observation</span>
          </a>
        </li>

         <li class="nav-item">
          <a class="nav-link" href="staff.php">
           <i class="fas fa-fw fa-user-circle"></i>
            <span>Add-Staff</span></a>
        </li>

          <li class="nav-item">
          <a class="nav-link" href="menu.php">
            <i class="fas fa-fw fa-utensils"></i>
            <span>Add-Menu</span></a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="orderd.php">
            <i class="fas fa-chalkboard"></i>
            <span>Order-detailes</span></a>
        </li>

         <li class="nav-item">
          <a class="nav-link" href="online_orderd.php">
            <i class="fas fa-chalkboard-teacher"></i>
            <span>Online Order-detailes</span></a>
        </li>

         <li class="nav-item">
          <a class="nav-link" href="sales.php">
           <i class="fas fa-dollar-sign"></i>
            <span>Sales-detailes</span></a>
        </li>
        
         <li class="nav-item">
          <a class="nav-link" href="online_sale.php">
            <i class="fas fa-hand-holding-usd"></i>
            <span>Online Sales-detailes</span></a>
        </li>

         <li class="nav-item">
          <a class="nav-link" href="bok_list.php">
            <i class="far fa-calendar-alt"></i>
            <span>Booking-list</span></a>
        </li>

         <li class="nav-item">
          <a class="nav-link" href="regi.php">
            <i class="fas fa-user-edit"></i>
            <span>Registration-list</span></a>
        </li>


        <li class="nav-item">
          <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-fw fa-power-off"></i>
            <span>Logout</span>
          </a>
        </li>

      </ul>

      <div id="content-wrapper">

        <div class="container-fluid">

        
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="index.php">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Ovservation</li>
          </ol>

        
         
          <hr>
          

          <div class="card  border-primary">
            <div class="card-header">
              <i class="fas fa-chart-area"></i>
              Inside Ovservation-
             </div>
            
           <div class="card">
            <div class="row">
  				<div class="column">
    				<table>
				      <tr>
				        <th>Most demanding items</th>
				       
				      </tr>
      			<?php

					$con = mysqli_connect("localhost", "root", "", "fosdb");

				$q = 
				"SELECT food FROM tbl_online_order  GROUP BY food HAVING COUNT(price) >1 ";
				
					$run=mysqli_query($con,$q);
          if ($run == true) {
            while($row=mysqli_fetch_array($run))
            {
           $username=$row['food'];
           

           ?>
           <tr>
              <td><?php echo $username?></td>
            </tr>

           <?php
         }
          }
          else
          {
            echo "no";
          }

   					
				 	?>
      			
        </table>
  </div>
  <div class="column">
    <table>
      <tr>
        <th>More sales date</th>
        </tr>

        <?php

					$con = mysqli_connect("localhost", "root", "", "fosdb");

				$q = 
				"SELECT order_date FROM tbl_order WHERE status= 'Completed' GROUP BY order_date HAVING COUNT(status) >1 ";
				
					$run=mysqli_query($con,$q);
   					while($row=mysqli_fetch_array($run))
						{
					 $date=$row['order_date'];
				 	?>

      <tr>
        <td><?php echo $date?></td>
        <?php
        		} ?>
        
      </tr>
     
      
    </table>
  </div>
  

<div class="column">
    <table>
      <tr>
        <th>Waiters are more take order</th>
        
      </tr>
      <?php

					$con = mysqli_connect("localhost", "root", "", "fosdb");

				$q = 
				"SELECT username FROM tbl_orderdetail GROUP BY username HAVING COUNT(orderID) >3 ";
				
					$run=mysqli_query($con,$q);
   					while($row=mysqli_fetch_array($run))
						{
					 $name=$row['username'];
				 	?>
      <tr>
        <td><?php echo $name?></td>
        <?php
        		} ?>
        
      </tr>
      
    </table>
</div>
</div>
<div class="row">
<div class="column">
    <table>
      <tr>
        <th>Chefs are more Prepare order</th>
        
      </tr>
      <?php

          $con = mysqli_connect("localhost", "root", "", "fosdb");

        $q = 
        "SELECT chef FROM tbl_order GROUP BY chef HAVING COUNT(status) >3 ";
        
          $run=mysqli_query($con,$q);
            while($row=mysqli_fetch_array($run))
            {
           $name=$row['chef'];
          ?>
      <tr>
        <td><?php echo $name?></td>
        <?php
            } ?>
        
      </tr>
      
    </table>
</div>

          <div class="column">
            <table>
              <tr>
                <th>Most online sales date</th>
               
              </tr>
            <?php

          $con = mysqli_connect("localhost", "root", "", "fosdb");

        $q = 
        "SELECT date FROM tbl_online_order  GROUP BY date HAVING COUNT(status) >2";
        
          $run=mysqli_query($con,$q);
          if ($run == true) {

            while($row=mysqli_fetch_array($run))
            {
           $username=$row['date'];
           

           ?>
           <tr>
              <td><?php echo $username?></td>
            </tr>

           <?php
         }
          }
          else
          {
            
          }

            
          ?>
            
        </table>
  </div>
  
  <div class="column">
            <table>
              <tr>
                <th>Which customer placed more order</th>
               
              </tr>
            <?php

          $con = mysqli_connect("localhost", "root", "", "fosdb");

        $q = 
        "SELECT username FROM tbl_online_order  GROUP BY username HAVING COUNT(status) >1 ";
        
          $run=mysqli_query($con,$q);
          if ($run == true) {
            while($row=mysqli_fetch_array($run))
            {
           $username=$row['username'];
           

           ?>
           <tr>
              <td><?php echo $username?></td>
            </tr>

           <?php
         }
          }
          else
          {
            echo "no";
          }

            
          ?>
            
        </table>
  </div>
  


</div>
  </div>
    </div>
      </div>
			</div>

		




      <br />
      <br />
      <br />
      
    </div>
  </div>

        
        
        <footer class="sticky-footer">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
             <span>Copyright©FoodOrderingSystembyTaniaSultana</span>
            </div>
          </div>
        </footer>

      </div>
      
    </div>
   
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="logout.php">Logout</a>
          </div>
        </div>
      </div>
    </div>


	
<script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin.min.js"></script>

   
	
  </body>

</html>