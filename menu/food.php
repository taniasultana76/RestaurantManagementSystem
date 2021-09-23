<?php
  include("dbconnection.php");

  session_start();
  ?>
  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FOS Food menu</title>
    <link href="cssm/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="cssm/style.css">
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
        <div class="container">
            <div class="logo">
                <a href="#" title="Logo">
                  
                </a>
            </div>
            
            <div class="menu" style="background-color: white;height: 35px;">

                <ul>
                    
                    
                    <li>
                        <a href="../index.php" style="font-family:'Brush Script MT', cursive;font-size: 30px;color: DarkRed">Tania'S Dine <i class="fas fa-utensils"></i></a>
                    </li>

                    <font style="color: black;float: right;padding: 15px;">&nbsp;&nbsp;<a href="logout.php"> <i class="fas fa-fw fa-power-off"></i></a></font>

                    <font style="float: right;font-size: 18px;padding: 15px;"><b><?php   echo $_SESSION['name']; ?></b></font>

                    <a href="edit_pro.php">
                      <?php echo "<img style='border-radius:50%;float: right;padding: 6px;' height=50 width=50 src='images/".$_SESSION['pic']."'>"; ?> </a>

                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <div class="a">
      <a href="cus_history.php" style=" margin-left: 5%;color:green;">Order history</a>
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
   
    
    <section class="food-search text-center">
    
        <div class="container">
          
            
            <form action="food-search.php" method="POST">
               
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary" style="background-color: #069C54;">
            </form>

        </div>
    </section>
    
 
    <section class="categories" style="background-image:linear-gradient(rgba(0,0,0,0.9),rgba(1,1,1,0.5)),url(images/f.jpg);">
        <div class="container">
            <h2 class="text-center" style="color: lightgreen">Explore Foods</h2>

            <?php
        $server= 'localhost';
        $user= 'root';
        $password= '';
        $db= 'fosdb';
  
       $con = mysqli_connect($server,$user,$password,$db);
       $query = "SELECT * FROM tbl_menu LIMIT 3";
       $query_run = mysqli_query($con, $query);
       $check = mysqli_num_rows($query_run) > 0;

       if( $check)
       {
        while($row= mysqli_fetch_array($query_run))
        {
            $id = $row['menuID'];
            $name = $row['menuName'];
           
            $img = $row['img'];

        ?>
            <a href="#">
            <div class="box-3 float-container">
                <img src="images/<?php echo $img; ?>"class="img-responsive img-curve">

                
            </div>
            </a>

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

     <section class="food-menu">
        <div class="container">
            <h2 class="text-center" style="color: #069C54">Food menu</h2>
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
            $id = $row['itemID'];
            $name = $row['menuItemName'];
            $price = $row['price'];
            $img = $row['img'];

        ?>

            <div class="food-menu-box" style="height: 90px;">
                <div class="food-menu-img">
                    <img style="height: 90px;" src="images/<?php echo $img; ?>"  class="img-responsive img-curve">
                </div>

                <div class="food-menu-desc">
                    <h4><?php echo $name; ?></h4>
                    <p class="food-price"><b>Price:</b><?php echo $price; ?>Tk</p>
                  
                    <br>

                  <a href="order.php?itemID=<?php  echo $id; ?>" class="btn btn-primary" style="background-color: #069C54;">Order Now</a>
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

