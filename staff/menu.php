<?php
  include("../functions.php");

  if((!isset($_SESSION['uid']) && !isset($_SESSION['username']) && isset($_SESSION['user_level'])) ) 
    header("Location: login.php");

  if($_SESSION['user_level'] != "staff")
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

    <title> Staff-Food Ordering System</title>

    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
   
    <link href="css/sb-admin.css" rel="stylesheet">
     <link rel="stylesheet" href="css1/style.css">
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
          <a class="nav-link dropdown-toggle text-white" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-left: 700px">
         
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
          <a class="nav-link" href="menu.php" >
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
            <li class="breadcrumb-item active">Menu</li>
          </ol>

          <h1>Explore our menu</h1>
          <hr> 
          <section class="food-search text-center" style="background-image:linear-gradient(rgba(0,0,0,0.9),rgba(1,1,1,0.3)),url(images/Picture2.jpg);
            height:auto;
            background-size:cover;
            background-position:center;">
        <div class="container">
            
           <h2 class="text-center text-white">All The Special & Delicious Food Items<br>--------------------------------------------</h2>
        </div>
    </section>


     <section class="food-menu">
        <div class="container">
           <?php
        $server= 'localhost';
        $user= 'root';
        $password= '';
        $db= 'fosdb';
        
        $con = mysqli_connect($server,$user,$password,$db);
       $query = "SELECT * FROM tbl_menuitem";
       $query_run = mysqli_query($con, $query);
       $check = mysqli_num_rows($query_run) > 0;

       if( $check)
       {
        while($row= mysqli_fetch_array($query_run))
        {

        ?>

            <div class="food-menu-box">
                <div class="food-menu-img">
                    <img style="height: 90px;width: 122%" src="images/<?php echo $row['img']; ?>"  class="img-responsive img-curve">
                </div>

                <div class="food-menu-desc">
                    <h4><?php echo $row['menuItemName']; ?></h4>
                    <p class="food-price"><b>Price:</b><?php echo $row['price']; ?>Tk</p>
                  
                    <br>

                  
                </div>
            </div>

            
<?php
       }
       }
       else
       {
        echo "No data";
       }
       ?>
            <div class="clearfix"></div>

            

        </div>

        
    </section>
    
          
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

    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
     <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/ bootstrap-toggle.min.js"></script>
   <script type="text/javascript">

    $( document ).ready(function() {
        refreshTableOrder();
    });
     function refreshTableOrder() {
      $( "#orderTable" ).load( "displayorder.php?cmd=currentready" );
    }
    setInterval(function(){ refreshTableOrder(); }, 3000);

  </script>

  </body>

</html>