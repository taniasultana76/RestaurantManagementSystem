<?php
  include("../functions.php");

  if((!isset($_SESSION['uid']) && !isset($_SESSION['username']) && isset($_SESSION['user_level'])) ) 
    header("Location: login.php");

  if($_SESSION['user_level'] != "admin")
    header("Location: login.php");

  if (!empty($_POST['role'])) {
    $role = $sqlconnection->real_escape_string($_POST['role']);
    $staffID = $sqlconnection->real_escape_string($_POST['staffID']);

    $updateRoleQuery = "UPDATE tbl_staff SET role = '{$role}'  WHERE staffID = {$staffID}  ";

      if ($sqlconnection->query($updateRoleQuery) === TRUE) {
        echo "";
      } 

      else {
        
        echo "someting wong";
        echo $sqlconnection->error;
      }
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

    <title>Staff Management - FOS Admin</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="css/sb-admin.css" rel="stylesheet">

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
              <a href="index.html">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Booking-list</li>
          </ol>

          
          <h1>Booking List</h1>
          <hr>
          <p>Who are booked for event or party!</p>

         <div class="from-inline">
          <label for="search" class="font-weight-bold lead text-dark">
            Search:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="text" name="search" id="search_text" class="form-control-lg
            rounded-2 border-primary" placeholder="search.................." style="width: 50%">
          
        </div>
        <hr>
        <?php
           
          $stmt=$sqlconnection->prepare("SELECT * FROM tbl_book");
          $stmt->execute();
          $result=$stmt->get_result();
        ?>
        <table class="table table-hover table-light table-striped" id="table-data">
          <thead class="bg-dark text-white">
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
          <tbody>
            <?php while ($row=$result->fetch_assoc()){ ?>
            <tr>
            <td><?= $row['name']; ?></td>
            <td><?= $row['address']; ?></td>
            <td><?= $row['mobile']; ?></td>
            <td><?= $row['item']; ?></td>
            <td><?= $row['people']; ?></td>
            <td><?= $row['date']; ?></td>
            <td><?= $row['message']; ?></td>
            
            </tr>
            <?php } ?>

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


    <script type="text/javascript">
    $(document).ready(function(){
      $("#search_text").keyup(function(){
        var search = $(this).val();
        $.ajax({
          url: 'action_bok.php',
          method:'post',
          data:{query:search},
          success:function(response){
            $("#table-data").html(response);
          }
        });
      });
    });
  </script>

  </body>

</html>