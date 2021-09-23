<?php
  include("dbconnection.php");
session_start();
  ?>

  <?php 

if (isset($_GET['itemID']))
{
    $itemID = $_GET['itemID'];

    $sql = "SELECT * FROM tbl_menuitem WHERE itemID = $itemID";
    $res = mysqli_query($sqlconnection, $sql);
    $count = mysqli_num_rows($res);

    if($count ==1)
    {
        $row = mysqli_fetch_assoc($res);

        $name = $row['menuItemName'];
        $price = $row['price'];
        $image = $row['img'];
    }
    else
    {
        header('location:food.php');
    }

}
else
{
    header('location:food.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>
    <link rel="stylesheet" href="cssm/style.css">
    <link href="cssm/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <style>
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
                        <a href="../index.php" style="font-family:'Brush Script MT', cursive;font-size: 30px; margin-left: 8%; color: DarkRed">Tania'S Dine <i class="fas fa-utensils"></i></a>
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
      <a href="cus_history.php" style=" margin-left: 1%;color:green;">Order history</a>
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
           
            $status = $row['status'];
           
            

        ?>
    <p class="b">Your order are <?php echo $status; ?>!</p>
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
   
  
    <section class="food-search"  style="background-image:linear-gradient(rgba(0,0,0,0.9),rgba(1,1,1,0.5)),url(images/f.jpg);">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend class="text-white">Selected Food</legend>

                    <div class="food-menu-img">
                        <img src="images/<?php echo $image; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                    </div>
    
                    <div class="food-menu-desc text-white">
                        <h3><?php echo $name;?> </h3>
                        <input type="hidden" name="food" value="<?php echo $name;?>">
                        <p class="food-price"><?php echo $price;?> Tk</p>
                        <input type="hidden" name="price" value="<?php echo $price;?>">
                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset class="text-white">
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="cus_name" placeholder="Enter your name" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="+88........." class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="Enter your e-mail" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="Enter your address" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">

                </fieldset>
                
            </form>
           
        <?php
        if(isset($_POST['submit']))
        {
            $username = $_SESSION['name'];
            $food = $_POST['food'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];

            $total = $price * $qty;
           
            $status = "waiting";
           
            $cus_name = $_POST['cus_name'];
            $mobile = $_POST['contact'];
            $email = $_POST['email'];
            $add = $_POST['address'];

        $sql2 = "INSERT INTO `tbl_online_order`( `username`,`food`, `price`, `qty`, `total`, `date`, `time`, `status`, `cus_name`, `phone`, `email`, `address`) 
        VALUES ('$username','$food','$price','$qty','$total',CURDATE(),CURTIME(),'$status','$cus_name','$mobile','$email','$add')";


        $res2 = mysqli_query($sqlconnection, $sql2);

        if($res2==true)
        {
            echo "<script>alert('Order placed sucsesfully')</script>";

           
        }

        else
        {
            echo "<script>alert('Order not placed')</script>";
            
        }
        }

        ?>
         <button style="height: 35px;width: 7%;margin-left:47%;background-color: pink;border-radius: 5px;border: none">
            <a href="food.php" style="color:black" ><i class="fas fa-angle-double-left"></i><b>&nbsp;BACK</b></a>
        </button>

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