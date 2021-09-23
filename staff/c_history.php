<?php 
  include("../functions.php");

  if((!isset($_SESSION['uid']) && !isset($_SESSION['username'])  
    && isset($_SESSION['user_level'])) ) 
    header("Location: login.php");

  if($_SESSION['user_level'] != "staff")
    header("Location: login.php");

  

  function getStatus () {
      global $sqlconnection;
      $checkOnlineQuery = "SELECT status FROM tbl_staff WHERE staffID = {$_SESSION['uid']}";

      if ($result = $sqlconnection->query($checkOnlineQuery)) {
          
        if ($row = $result->fetch_array(MYSQLI_ASSOC)) {
          return $row['status'];
        }
      }

      else {
          echo "Something wrong the query!";
          echo $sqlconnection->error;
      }
  }

   function chefSaleGrandTotal($time) {
    global $sqlconnection;
    $total = 0;

    if ($time == "ALLTIME") {
      $query = "
          SELECT SUM(total) as grandtotal
          FROM tbl_order WHERE status ='Completed' AND chef='{$_SESSION['username']}'
          ";
    }

    else if ($time == ("DAY" || "MONTH" || "WEEK")) {

      $query = "
          SELECT SUM(total) as grandtotal
          FROM tbl_order WHERE status ='Completed' AND chef='{$_SESSION['username']}' AND order_date > DATE_SUB(NOW(), INTERVAL 1 ".$time.")
          ";
    }

    else 
      return null;

    if ($result = $sqlconnection->query($query)) {
    
      while ($res = $result->fetch_array(MYSQLI_ASSOC)) {
        $total+=$res['grandtotal'];
      }

      return $total;
    }

    else {

      echo $sqlconnection->error;
      return null;

    }
  }



?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Staff-Food ordering system</title>

    
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    
    <link href="css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="css1/style.css">

 <style>
      .a{
       width: 20%;
       background-color: Lightgray;
       padding: 2%;margin: 2%;
       text-align: center;
       margin-right: 10px;
       border-radius: 10px;
        box-shadow: 2px 2px 2px 1px gray;
      }
    </style>
  
  
</head>
<body id="page-top"style="background-color: white;">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

      <font class="" style="font-family:'Brush Script MT',cursive;font-size: 30px;color: white;text-decoration-line: none"><b>Tania'S Dine <i class="fas fa-utensils"></i></b></font>

      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i>
      </button>

     
      <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle text-white" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 100">
         
            <b><?php echo $_SESSION['username'] ?></b>
           <img class='img-circle profile_img'style="border-radius:55%" height="40" width="40" src="images/<?php echo $_SESSION['img']; ?>">
             
          </a>
        </li>
      </ul>

       <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle text-white" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-left: 600px">
         
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
          <a class="nav-link" href="menu.php"  >
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
            <li class="breadcrumb-item active">History</li>
          </ol>

          
          <h1>Staff Panel</h1>
          <hr>
          
          <p>Observe your all activities.</p>

   
   <section class="food-search"  style="background-image:linear-gradient(rgba(0,0,0,0.9),rgba(1,1,1,0.3)),url(images/Picture3.jpg);
            height:auto;
            background-size:cover;
            background-position:center;">
        <div class="container" >
            
           

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend class="text-white">---------------Profile---------------</legend>
                     <?php
           
          $stmt=$sqlconnection->prepare("SELECT * FROM tbl_staff WHERE username='{$_SESSION['username']}'");
          $stmt->execute();
          $result=$stmt->get_result();
        ?>

                    <div class="food-menu-img">
                      <?php while ($row=$result->fetch_assoc()){ ?>
                       <img class="img-responsive img-curve" src="images/<?= $row["img"]; ?>" style="width: 110%;height: 90px;border:1px solid gray">
                    </div>
                   
    
                    <div class="food-menu-desc text-white">
                        <p class="food-price">Name: <b><?= $row['username']; ?></b></p>
                        <p class="food-price">Role:   <b><?= $row['role']; ?></b></p>
                        <p class="food-price">Email: <b><?= $row['email']; ?></b></p>
                       
                        
                         <?php } ?>

                        
                    </div>

                </fieldset>
                
                
                
            </form>
            
                </div>
              </section>
              <section class="food-menu">
        <div class="container">

<h2 class="text-center text-dark">Here observe your all activities</h2>

              <br/>
              <?php  $sql=" SELECT status FROM tbl_order  WHERE chef='{$_SESSION['username']}' AND status ='Completed'";
              $res = mysqli_query($sqlconnection, $sql);
              $count = mysqli_num_rows($res);
              ?>
         <label style="background-color: pink;margin-left: 15%" class="a"><b><?php echo $count; ?></b><br>Delivered Order</label>

          <?php  $sql=" SELECT status FROM tbl_order  WHERE chef='{$_SESSION['username']}' AND status ='cancelled'";
              $res = mysqli_query($sqlconnection, $sql);
              $count = mysqli_num_rows($res);
              ?>
         <label style="background-color: #dac292;" class="a"><b><?php echo $count; ?></b><br>Cancelled Order</label>

              
       
             
         <label style="background-color: #bdcebe;" class="a">

          <?php
             $q = 
        "SELECT order_date FROM tbl_order WHERE status= 'Completed' AND chef='{$_SESSION['username']}'  GROUP BY order_date HAVING COUNT(status) >2 ";
        
          $run=mysqli_query($sqlconnection,$q);
            while($row=mysqli_fetch_array($run))
            {
           $username=$row['order_date'];
           if ($username< 0){
            echo 'no';
           }
          ?>

          <b><?php echo $username?></b><br>
            <?php } ?>

          Most selling date</label><br>

           <label style="background-color: #e3eaa7;" class="a"><b><?php echo chefSaleGrandTotal("DAY"); ?>.00 Tk</b><br> Today's Sale</label>

           <label style="background-color: lightgreen;" class="a"><b><?php echo chefSaleGrandTotal("WEEK"); ?>.00 Tk</b><br>Sales Per-Week</label>

           <label style="background-color: lightyellow;" class="a"><b><?php echo chefSaleGrandTotal("MONTH"); ?>.00 Tk</b><br>Sales Per-Month</label>

           <label style="background-color: skyblue;" class="a"><b><?php echo chefSaleGrandTotal("ALLTIME"); ?>.00 Tk</b><br>Sales In-Total</label>
            <hr>
             
          </div>

          <table id="tblCurrentOrder" class="table bg-dark text-white table-bordered text-center" width="100%" cellspacing="0">
          <thead class="bg-white text-dark">
            
         
            <th># No</th>
            <th>Name</th>
            <th>Status</th>
            <th>Category</th>
            <th>Menu Name</th>
            <th class='text-center'>Quantity</th>
            <th class='text-center'>Price</th>
            <th>total</th>
            <th>date</th>
           
          </thead>
          
          <tbody id="tblBodyCurrentOrder">
            
          </tbody>
          
            </table>
          </section>
          
    
  </div><br>
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
         $( "#tblBodyCurrentOrder" ).load( "c_displayorder.php?cmd=currentorder" );
            }

      function editStatus (objBtn,orderID) {
      var status = objBtn.value;

      $.ajax({
        url : "status_on.php",
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