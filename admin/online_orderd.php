<?php
  include("../functions.php");

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

    <title>Sales - FOS Admin</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="css/sb-admin.css" rel="stylesheet">

     <style>
      .a{
       width: 16%;
       background-color: Lightgray;
       padding: 2%;margin: 1%;
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
            <li class="breadcrumb-item active">Online Order-detailes</li>
          </ol>

         
          <h1>Online Order-Detailes Management</h1>
          <hr>
         <div class="container-fluid">

             <?php $sql1 ="SELECT * FROM tbl_online_order WHERE status='Waiting'";
              $res1 = mysqli_query($sqlconnection, $sql1);
             $count1 = mysqli_num_rows($res1);

             
                ?>
                   <label style="background-color: pink;" class="a"><b><?php echo $count1; ?></b><br>Current-Order</label>
              <?php $sql ="SELECT * FROM tbl_online_order WHERE status='Preparing'";
              $res = mysqli_query($sqlconnection, $sql);
             $count = mysqli_num_rows($res);

             
                ?>

                    <label style="background-color: #e3eaa7;" class="a"><b><?php echo $count; ?></b><br>Preparing-Order</label>
              <?php $sql ="SELECT * FROM tbl_online_order WHERE status='finish'";
              $res = mysqli_query($sqlconnection, $sql);
             $count = mysqli_num_rows($res);

             
                ?>

                    <label style="background-color:Lemon;" class="a"><b><?php echo $count; ?></b><br>Ready-Order</label>
                    

             <?php $sql2 ="SELECT * FROM tbl_online_order WHERE status='Delivered'";
              $res2 = mysqli_query($sqlconnection, $sql2);
             $count2 = mysqli_num_rows($res2);

             
                ?>
                    <label style="background-color: #bdcebe;" class="a"><b><?php echo $count2; ?></b><br>Delivered-Order</label>

             <?php $sql3 ="SELECT * FROM tbl_online_order WHERE status='cancelled'";
              $res3 = mysqli_query($sqlconnection, $sql3);
             $count3 = mysqli_num_rows($res3);

             
                ?>

                    <label style="background-color: #dac292;" class="a"><b><?php echo $count3; ?></b><br>Cancelled-Order</label>
                  </div>

          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-chart-area"></i>
              Order Sales List</div>
            <div class="card-body">
              <table id="tblCurrentOrder" class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                      <th># No</th>
                      <th>Custpmer-name</th>
                      <th>Address</th>
                      <th>Menu</th>
                      <th>Price</th>
                      <th class='text-center'>Quantity</th>
                      <th class='text-center'>Total (Tk)</th>
                      <th class='text-center'>Status</th>
                      <th class='text-center'>Date</th>
                      <th class='text-center'>Time</th>
                    </thead>
                    
                    <tbody id="tblBodyCurrentOrder">
                      <?php 
                      $displayOrderQuery =  "
                        SELECT *
                        FROM tbl_online_order
                        ";

                      if ($orderResult = $sqlconnection->query($displayOrderQuery)) {
                          
                        $currentspan = 0;
                        $total = 0;

                        if ($orderResult->num_rows == 0) {

                          echo "<tr><td class='text-center' colspan='7' >There are currently no order right now. </td></tr>";
                        }

                        else {
                          while($orderRow = $orderResult->fetch_array(MYSQLI_ASSOC)) {

                            $rowspan = getCountID($orderRow["orderID"],"orderID","tbl_online_order"); 

                            if ($currentspan == 0) {
                              $currentspan = $rowspan;
                              $total = 0;
                            }

                            
                            $total += ($orderRow['price']*$orderRow['qty']);

                            echo "<tr>";

                            if ($currentspan == $rowspan) {
                              echo "<td rowspan=".$rowspan."># ".$orderRow['orderID']."</td>";
                              echo "<td rowspan=".$rowspan."> ".$orderRow['username']."</td>";
                              echo "<td rowspan=".$rowspan."> ".$orderRow['address']."</td>";
                            }

                            echo "
                              <td>".$orderRow['food']."</td>
                              <td>".$orderRow['price']."</td>
                              <td class='text-center'>".$orderRow['qty']."</td>
                            ";

                            if ($currentspan == $rowspan) {

                              $color = "badge";

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

                                case 'cancelled':
                                  $color = "badge badge-danger";
                                  break;

                                case 'finish':
                                  $color = "badge badge-success";
                                  break;

                                case 'Delivered':
                                  $color = "badge badge-success";
                                  break;
                              }

                              echo "<td class='text-center' rowspan=".$rowspan.">".$orderRow['total']."</span></td>";


                              echo "<td class='text-center' rowspan=".$rowspan."><span class='{$color}'>".$orderRow['status']."</span></td>";
                               
                              

                              echo "<td rowspan=".$rowspan." class='text-center'>".$orderRow['date']."</td>";
                               echo "<td rowspan=".$rowspan." class='text-center'>".$orderRow['time']."</td>";

                            
                              echo "</td>";

                            }

                            echo "</tr>";

                            $currentspan--;
                          }
                        }
                        } 
                      ?>
                    </tbody>
              </table>
            </div>
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