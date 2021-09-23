<?php
  include("dbconnection.php");
session_start();
  ?>

  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FOS Customer activity</title>
    <link rel="stylesheet" href="cssm/style.css">
    <link href="cssm/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
   <style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;

  

}
th{
  color: skyblue;
}

td, th {
  border: 1px solid yellow;
  border-radius: 5px;
  
  text-align: center;
  padding: 8px;
 
   
}
td {
   height: 40px;
   color:white;

 }


.a{
        background-color: pink;
        height: 40px;
        padding-top: 15px;
        
        font-weight: bold;
       }
         
      .b{
        float: right;
        margin-right: 5%;
        color:DarkRed;
        font-weight: bold;
      }

</style>
</head>

<body>
    
    <section class="navbar">
        
            <div class="menu" style="margin-right: 10%;">
               
                <ul>
                    
                    
                    <li>
                        <a href="../index.php" style="font-family:'Brush Script MT', cursive;font-size: 30px;margin-left: 8%;color: DarkRed">Tania'S Dine <i class="fas fa-utensils"></i></a>
                    </li>

                    <font style="color: black;float: right;">&nbsp;&nbsp;<a href="logout.php"> <i class="fas fa-fw fa-power-off"></i></a></font>

                    <font style="float: right;font-size: 18px;"><b><?php   echo $_SESSION['name']; ?></b></font>

                    <a href="edit_pro.php">
                      <?php echo "<img style='border-radius:50%;float: right;padding: 6px;' height=50 width=50 src='images/".$_SESSION['pic']."'>"; ?> </a>

                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>

    <div class="a">
      <a href="food.php" style=" margin-left: 5%;color:green;">Menu</a>
      <a href="order.php" style=" margin-left: 1%;color:green;">Order-Food</a>
      <?php
        $server= 'localhost';
        $user= 'root';
        $password= '';
        $db= 'fosdb';
  
       $con = mysqli_connect($server,$user,$password,$db);
       $query = "SELECT * FROM tbl_online_order WHERE status 
          IN ( 'waiting','preparing','ready','on the way') AND username ='{$_SESSION['name']}'";
       $query_run = mysqli_query($con, $query);
       $check = mysqli_num_rows($query_run) > 0;

       if( $check)
       {
        while($row= mysqli_fetch_array($query_run))
        {
           
            $name = $row['status'];
           
            

        ?>
    <p class="b">Your order are <?php echo $name; ?>!</p>
        <?php
       }
       }
       else
       {
        ?>
       <p class="b">You have no current order! Please explore our menu.</p>
        <?php
       }
       ?>
    </div>
  
    <section class="food-search"  style="background-image:linear-gradient(rgba(0,0,0,0.9),rgba(1,1,1,0.9)),url(images/j.jpg);">
        <div class="container">
            
            
            <form action="" method="POST" class="order">

               <fieldset>
                    <legend class="text-white" style="font-size: 40px"><b>Profile</b></legend>
                        <?php
           
                          $stmt=$sqlconnection->prepare("SELECT * FROM tbl_log_od WHERE username='{$_SESSION['name']}'");
                          $stmt->execute();
                          $result=$stmt->get_result();
                        ?>
                    <div class="food-menu-img">
                      <?php while ($row=$result->fetch_assoc()){ ?>

                       <img class="img-responsive img-curve" src="images/<?= $row["img"]; ?>" style="width: 110%;height: 90px;border:1px solid gray">
                    </div>
    
                    <div class="food-menu-desc text-white">

                       <p class="food-price">Name: <b><?= $row['username']; ?></b></p>
                        <p class="food-price">Address:   <b><?= $row['address']; ?></b></p>
                        <p class="food-price">Email: <b><?= $row['email']; ?></b></p>
                       
                        
                         <?php } ?>
                        
                    </div>

                </fieldset>
               
                <h2 class="text-center text-white">Your all order detailes are here</h2>

                <table>
                    <tr>    
                      <th>Item</th>
                      <th>Qty</th>
                      <th>Price</th>
                      <th>Total</th>
                      <th>Date</th>
                      <th>Time</th>
                      <th>Status</th>
                      

        </tr>
        <?php
           
          $stmt=$sqlconnection->prepare("SELECT * FROM tbl_online_order WHERE username='{$_SESSION['name']}'");
          $stmt->execute();
          $result=$stmt->get_result();
        ?>
        <tr>
<?php while ($row=$result->fetch_assoc()){ ?>
           <td><?= $row['food']; ?></td>
           <td><?= $row['qty']; ?></td>
           <td><?= $row['price']; ?></td>
           <td><?= $row['total']; ?></td>
           <td><?= $row['date']; ?></td>
           <td><?= $row['time']; ?></td>
           <td><?= $row['status']; ?></td>
           
       </tr>
       <?php } ?>
                </table>
                
            </form>

        </div>
        
    </section>
   
    <section class="social">
        <div class="container text-center">
            <ul>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/50/000000/facebook-new.png"/></a>
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/48/000000/instagram-new.png"/></a>
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/48/000000/twitter.png"/></a>
                </li>
            </ul>
        </div>
    </section>
   
    <section class="footer">
        <div class="container text-center">
            <p>Copyright©FoodOrderingSystembyTaniaSultana</p>
        </div>
    </section>





    

</body>
</html>