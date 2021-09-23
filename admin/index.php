<?php 
  include("../functions.php");

  if((!isset($_SESSION['uid']) && !isset($_SESSION['username']) && !isset($_SESSION['img']) && isset($_SESSION['user_level'])) ) 
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

    <title>Dashboard - FOS Admin</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    
    <link href="css/sb-admin.css" rel="stylesheet">
    <style>
      .a{
       width: 20%;
       background-color: Lightgray;
       padding: 2%;margin: 2%;
       text-align: center;
       margin-right: 25px;
       border-radius: 10px;
        box-shadow: 2px 2px 2px 1px gray;
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
           <font style="color: white;"> Hello , <b><?php echo $_SESSION['username']; ?></b></font>
             <img class='img-circle profile_img'style="border-radius:55%" height="40" width="40" src="images/<?php echo $_SESSION['img']; ?>">
          </a>
        </li>

        <li style="margin-left: 450px;">

           <?php $sql ="SELECT * FROM tbl_order WHERE status='waiting'";
              $res = mysqli_query($sqlconnection, $sql);
              $count = mysqli_num_rows($res);
            ?>

           <li><a href="#" style=" text-decoration-line: none; float: right;margin-left:;margin-top:10px;color: white;" data-toggle="modal" data-target="#res">Restaurant-order <i class="fas fa-concierge-bell fa-2x"></i>&nbsp;<font style="color: red;font-size: 30px;"><b><?php echo $count; ?></b></font></a></li>&nbsp;&nbsp;&nbsp;&nbsp;

            <?php $sql1 ="SELECT * FROM tbl_online_order WHERE status='waiting'";
              $res1 = mysqli_query($sqlconnection, $sql1);
              $count1 = mysqli_num_rows($res1);
            ?>

           <li><a href="#" style=" text-decoration-line: none; float: right;margin-left:;margin-top:10px;color: white;" data-toggle="modal" data-target="#online">Online-order<i class="fas fa-fw fa-utensils fa-2x"></i><font style="color: red;font-size: 30px;"><b><?php echo $count1 ;?></b></font></a></li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

          <?php $sql3 ="SELECT * FROM tbl_staff WHERE status='Online'";
              $res3 = mysqli_query($sqlconnection, $sql3);
              $count3 = mysqli_num_rows($res3);
            ?>
          <a href="#" style=" text-decoration-line: none; float: right;margin-left:00px;margin-top:10px;color: white;" data-toggle="modal" data-target="#staff">Staff <i class="fas fa-user-tie fa-2x"></i>
            <font style="color:red;font-size: 30px;"><b><?php echo $count3; ?></b></font></li>
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
            <li class="breadcrumb-item active">Overview</li>
          </ol>

          
          <h1>Administrator Panel</h1>
          
            <div class="card-header">
                 
                Overview of the restaurant</div>

             <div class="container-fluid">
              <br/>
              <?php  $sql=" SELECT * FROM tbl_staff WHERE role = 'waiter'";
              $res = mysqli_query($sqlconnection, $sql);
              $count = mysqli_num_rows($res);
              ?>
         <label style="background-color: pink;" class="a"><b><?php echo $count; ?></b><br>Totall-Waiter</label>

          <?php  $sql=" SELECT * FROM tbl_staff WHERE role = 'chef'";
              $res = mysqli_query($sqlconnection, $sql);
              $count = mysqli_num_rows($res);
              ?>
         <label style="background-color: #dac292;" class="a"><b><?php echo $count; ?></b><br>Totall-Chef</label>

              <?php  $sql=" SELECT * FROM tbl_menu";
              $res = mysqli_query($sqlconnection, $sql);
              $count = mysqli_num_rows($res);
              ?>
         <label style="background-color: #e3eaa7;" class="a"><b><?php echo $count; ?></b><br>Food-Category</label>

              <?php  $sql=" SELECT * FROM tbl_menuItem";
              $res = mysqli_query($sqlconnection, $sql);
              $count = mysqli_num_rows($res);
              ?>
         <label style="background-color: #bdcebe;" class="a"><b><?php echo $count; ?></b><br>Food-item</label><hr>

         <?php $sql ="SELECT * FROM tbl_order WHERE status='preparing'";
              $res = mysqli_query($sqlconnection, $sql);
             $count = mysqli_num_rows($res);?>

          <label style="background-color: #f18973;" class="a"><b><?php echo $count; ?></b><br>Preparing-Order</label>

          <?php $sql ="SELECT * FROM tbl_order WHERE status='finish'";
              $res = mysqli_query($sqlconnection, $sql);
             $count = mysqli_num_rows($res);

             
                ?>

          <label style="background-color: #8d9db6;" class="a"><b><?php echo $count; ?>
        </b><br>Completed-Order</label>

              <?php $sql ="SELECT * FROM tbl_order WHERE status='Completed'";
              $res = mysqli_query($sqlconnection, $sql);
             $count = mysqli_num_rows($res);

             
                ?>
         <label style="background-color: #dac292;" class="a"><b><?php echo $count; ?></b><br>Delivered-Order</label>
         
         

          <?php $sql2 ="SELECT * FROM tbl_order WHERE status='cancelled'";
              $res2 = mysqli_query($sqlconnection, $sql2);
             $count2 = mysqli_num_rows($res2);

             
                ?>
         <label style="background-color: #f18973;" class="a"><b><?php echo $count2; ?></b><br>Cancelled-Order</label><hr>

         <?php $sql3 ="SELECT * FROM tbl_online_order WHERE status='preparing'";
              $res3 = mysqli_query($sqlconnection, $sql3);
             $count3 = mysqli_num_rows($res3);

             
                ?>

          <label style="background-color: #e3eaa7;" class="a"><b><?php echo $count3;?></b><br>Online-Preparing-Order</label>

           <?php $sql4 ="SELECT * FROM tbl_online_order WHERE status='finish'";
              $res4 = mysqli_query($sqlconnection, $sql4);
             $count4 = mysqli_num_rows($res4);
             ?>

          <label style="background-color: #ffcc5c;" class="a"><b><?php echo $count4; ?></b><br>Online-Complete-Order</label>

           <?php $sql5 ="SELECT * FROM tbl_online_order WHERE status='Completed'";
              $res5 = mysqli_query($sqlconnection, $sql5);
             $count5 = mysqli_num_rows($res5);
             ?>

          <label style="background-color: #e3eaa7;" class="a"><b><?php echo $count5; ?></b><br>Online-Delivered-Order</label>

           <?php $sql6 ="SELECT * FROM tbl_online_order WHERE status='cancelled'";
              $res6 = mysqli_query($sqlconnection, $sql6);
             $count6 = mysqli_num_rows($res6);
             ?>
 

         <label style="background-color: pink;" class="a"><b><?php echo $count6; ?></b><br>Online-Cancelled-Order</label><hr>

         <label style="background-color: #8d9db6;" class="a"><b> <?php echo getSalesGrandTotal("DAY"); ?> Tk</b><br>Today-sale</label>

          <label style="background-color: #bdcebe;" class="a"><b><?php echo getOnlineSalesGrandTotal("DAY"); ?> Tk</b><br>Today-online-sale</label>

           
          
         <label style="background-color: #5b9aa0;" class="a"><b><?php echo getSalesGrandTotal("ALLTIME"); ?>
       Tk</b><br>Totall-Revenue</label>

          
          <label style="background-color: #8d9db6;" class="a"><b><?php echo getOnlineSalesGrandTotal("ALLTIME"); ?>.00 Tk
          </b><br>Totall-online-revenue</label>

       
        
  
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



      <div class="modal fade" id="res" tabindex="-1" role="dialog" aria-labelledby="addMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addMenuModalLabel">Restaurant</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      
               <div class="card-header">
                  <i class=" fas fa-concierge-bell"></i>
                  Current Order List </div>
                <div class="card-body">
                  <table id="tblCurrentOrder" table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                      <th>Order #</th>
                      <th>Menu</th>
                      <th>Item Name</th>
                      <th class='text-center'>Quantity</th>
                      <th class='text-center'>Status</th>
                    </thead>
                    
                    <tbody id="tblBodyCurrentOrder">
                      
                    </tbody>
                  </table>
                </div>
                <div class="card-footer small text-muted"><i>Here the Order for serve the customers</i></div>
            
            
        
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          
        </div>
      </div>
    </div>
  </div>



    <div class="modal fade" id="online" tabindex="-1" role="dialog" aria-labelledby="addMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addMenuModalLabel">Online</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      
               <div class="card-header">
                  <i class=" fas fa-concierge-bell"></i>
                  Current Order List </div>
                <div class="card-body">
                  <table id="tblCurrentOrder" table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                      <th>Customer-name</th>
                      <th>Item</th>
                      <th class='text-center'>Quantity</th>
                      <th>Address</th>
                     
                    </thead>
                    <?php
                    $con = mysqli_connect("localhost", "root", "", "fosdb");


        $q = "select * from tbl_online_order where status = 'waiting'";
        $run=mysqli_query($con,$q);
        while($row=mysqli_fetch_array($run))
        {
          
         $username=$row['cus_name'];
         $item=$row['food'];
         $qty = $row['qty'];
         $add = $row['address'];
       
         
        ?>         <tbody id="tblBodyCurrentOrder">
                      <td ><?php echo $username; ?></td>
                       <td ><?php echo $item; ?></td>
                        <td ><?php echo $qty; ?></td>
                         <td ><?php echo $add; ?></td>
                        

                    </tbody>

          <?php

      }


  ?>
                  </table>
                </div>
                <div class="card-footer small text-muted"><i>Here the Order for serve the customers</i></div>
            
            
        
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          
        </div>
      </div>
    </div>
  </div>




    <div class="modal fade" id="staff" tabindex="-1" role="dialog" aria-labelledby="addMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addMenuModalLabel">Staff who is in online</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      
                <div class="card-header">
                  <i class="fas fa-chart-bar"></i>
                    <?php $sql2 ="SELECT * FROM tbl_staff WHERE status='Online'";
              $res2 = mysqli_query($sqlconnection, $sql2);
             $count2 = mysqli_num_rows($res2);

             
                ?>
                  Staff Availability<font style="float: right;color: red" ><b><?php echo $count2; ?></b></font><i style=" float: right;margin-top: 6px;"class="fas fa-user-tie"></i></div>
                <div class="card-body">
                  <table table class="table table-bordered text-center" width="100%" height="150px" cellspacing="0">
                    <tr>
                      <td><b>Staff</b></td>
                      <td><b>Role</b></td>
                      <td><b>Status</b></td>
                    </tr>

                    <?php 
                      $displayStaffQuery = "SELECT username,status,role FROM tbl_staff WHERE status = 'Online'";

                          if ($result = $sqlconnection->query($displayStaffQuery)) {
                            while($staff = $result->fetch_array(MYSQLI_ASSOC)) {
                              echo "<tr>";
                              echo "<td>{$staff['username']}</td>";
                               echo "<td>{$staff['role']}</td>";

                              if ($staff['status'] == "Online") {
                                echo "<td><span class=\"badge badge-success\">Online</span></td>";
                              }

                              if ($staff['status'] == "Offline") {
                                echo "<td><span class=\"badge badge-secondary\">Offline</span></td>";
                              }

                              echo "</tr>";
                            }
                          }
                    ?>
                  </table>


                </div>
             
        
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          
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
      $( "#tblBodyCurrentOrder" ).load( "displayorder.php?cmd=display" );
    }

   
    setInterval(function(){ refreshTableOrder(); }, 3000);

  </script>


  </body>

</html>