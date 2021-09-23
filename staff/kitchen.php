<?php
  include("../functions.php");

  if((!isset($_SESSION['uid']) && !isset($_SESSION['username']) && isset($_SESSION['user_level'])) ) 
    header("Location: login.php");

  if($_SESSION['user_level'] != "staff")
    header("Location: login.php");

  if($_SESSION['user_role'] != "chef") {
    echo ("<script>window.alert('Available for chef only!'); window.location.href='index.php';</script>");
    exit();
  }
  
?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Staff-Food Ordering System</title>

    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    
    <link href="css/sb-admin.css" rel="stylesheet">

    <style>
      .a{
       width: 15%;
       height:auto;
       background-color: Lightgray;
       padding: 2%;margin: 2%;
       text-align: center;
       margin-right: 16px;
       border-radius: 10px;
      }
    </style>

  </head>
    <body id="page-top">
      <nav class="navbar navbar-expand navbar-dark bg-dark static-top">
       <a href="#" class="nav__logo" style="font-family:'Brush Script MT', cursive;font-size: 30px;color: white;text-decoration-line: none"><b>Tania'S Dine <i class="fas fa-utensils"></i></b></a>

      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
      </button>

      
    <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle text-white" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         
             <b><?php echo $_SESSION['username'] ?></b>
           <img class='img-circle profile_img'style="border-radius:55%" height="40" width="40" src="images/<?php echo $_SESSION['img']; ?>">
          </a>
        </li>
      </ul>

       <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle text-white" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-left: 750px">
         
             Role : <b><?php echo ucfirst($_SESSION['user_role']) ?></b>


             
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
          <a class="nav-link" href="menu.php">
            <i class="fas fa-cocktail"></i>
            <span>Menu</span>
          </a>
        </li>

        


      
        
       <?php

          if ($_SESSION['user_role'] == "waiter") {
            echo '
            <li class="nav-item">
              <a class="nav-link" href="order.php">
                <i class="fas fa-fw fa-book"></i>
                <span>Take Order</span></a>
            </li>

         <li class="nav-item">
          <a class="nav-link" href="w_history.php">
            <i class="fas fa-edit"></i></i>
            <span>History</span>
          </a>
        </li>
          ';
          }

          if ($_SESSION['user_role'] == "chef") {
            echo '
            <li class="nav-item">
              <a class="nav-link" href="kitchen.php">
                <i class="fas fa-fw fa-utensils"></i>
                <span>Restaurant_Order</span></a>
            </li>

            <li class="nav-item">
          <a class="nav-link" href="online_order.php">
            <i class="fas fa-concierge-bell"></i>
            <span>Online_Order</span>
          </a>
        </li>


         <li class="nav-item">
          <a class="nav-link" href="c_history.php">
            <i class="fas fa-edit"></i></i>
            <span>History</span>
          </a>
        </li>
            ';
          }

        ?>
       


        
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
            <li class="breadcrumb-item active">Restaurant Order</li>&nbsp;&nbsp;&nbsp;&nbsp;
            <?php $sql ="SELECT * FROM tbl_order WHERE status='Waiting'";
              $res = mysqli_query($sqlconnection, $sql);
             $count = mysqli_num_rows($res);

             
                ?>
             <li class=" active"><font style="margin-left: 650px;"><i class="fas fa-concierge-bell"></i>&nbsp;Current-Order:&nbsp;<font style="color:red"><b><?php echo $count; ?></b></font></font></li>
          </ol>
          <h1>Restaurant Order Management</h1>
                   
          <hr>
          <p>Manage order that been sent to here.</p>

           
                   

           



          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-utensils"></i>
              Current Order List</div>
            <div class="card-body">
            	<table id="tblCurrentOrder" class="table table-bordered text-center" width="100%" cellspacing="0">
					<thead>
						<th>Order-No #</th>
            <th>Waiter-name</th>
						<th>Category</th>
						<th>Menu Name</th>
						<th class='text-center'>Quantity</th>
						<th class='text-center'>Status</th>
						<th class='text-center'>Options</th>
					</thead>
					
					<tbody id="tblBodyCurrentOrder">
						
					</tbody>
				</table>
            </div>








          </div>

        </div><br/><br/>
        <footer >
          <div class="container">
            <div class="copyright text-center">
              <span><b>Copyright©FoodOrderingSystembyTaniaSultana</b></span>
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

    <script type="text/javascript">
        $( document ).ready(function() {
	    	refreshTableOrder();
		        });
        function refreshTableOrder() {
			   $( "#tblBodyCurrentOrder" ).load( "displayorder.php?cmd=currentorder" );
		        }

      function editStatus (objBtn,orderID) {
			var status = objBtn.value;

			$.ajax({
				url : "editstatus.php",
					type : 'POST',
					data : {
						orderID : orderID,
						status : status 
					},

					success : function(output) {
						refreshTableOrder();
					}
				});
		}
		setInterval(function(){ refreshTableOrder(); }, 3000);



	</script>



 


  </body>

</html>

