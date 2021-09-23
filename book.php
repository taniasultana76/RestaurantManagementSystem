<?php
$con = mysqli_connect("localhost", "root", "", "fosdb");

if(isset($_POST['submit']))
{
    $name = $_POST['name'];
    $add = $_POST['address'];
    $people = $_POST['people'];
    $time = $_POST['time'];
    
    $date = $_POST['date'];
    $mobile = $_POST['mobile'];
    $item = $_POST['item'];
    $msg = $_POST['msg'];

   $errors = array();

   if($people >100)
   {
    $errors['t'] = "Sorry! we have not enough space upto 100 people ";
   }
   else{
    echo "no";
   }

    $u = "SELECT date FROM tbl_book WHERE date='$date'";
    $uu = mysqli_query($con, $u);

    if(mysqli_num_rows($uu) > 0) {

        $errors['u'] = " Sorry! An event are already booked in this date";

    }


    

    $chk = " ";
    
    foreach($item as $chk1){

        $chk .= $chk1. ",";
        }

    if(count($errors)==0){
        $query = "insert into tbl_book (name, address,people, time, date, mobile, item, message) value ('$name', '$add','$people','$time',
        '$date','$mobile','$chk', '$msg')";

        $result = mysqli_query($con, $query);
        if($result){
            header('location:index.php');
        } 
        else
        {
            echo "<script>alert('Something went wrong')</script>";
        }
    }
}
                ?>






<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="cssi/css/styles.css">
        <title>FOS-Booking table</title>


        <style>
        .container{
             background-color: rgba(44, 62, 80,0.4);
            box-shadow: 2px 2px 2px 1px white;
            padding: 20px 8px 20px 38px;
            width: 55%;
            height: auto;
            margin-left: 22%;
            border-radius: 8px;
            font-family: copper;
            font-size: 17px;
            color: white;
            bottom: 20px;
           
          

        }
        .txt{
            width: 90%;
            color: black;
            border:1px solid brown;
            border-radius: 05px;
            padding: 20px 15px 20px 15px;
            margin:10px 0px 15px 0px;
            font-family: Alex Brush;
            font-size: 17px

            }       
        .a{
            border:1px solid black;
            padding:8px 20px;
            color:white;
            text-decoration:none;
            transition:0.6s ease;
            border-radius: 5px;
            background-color:  #069C54;


        }
        .a:hover{
          color:black;
          background-color: pink;
          transition: all 1s ease;
}

    </style>
    </head>
    <body 
            style="background-image:linear-gradient(rgba(0,0,0,0.9),rgba(1,1,1,0.5)),url(cssi/img/din.jpg);
            height:auto;
            background-size:cover;
            background-position:center;">

        <a href="#" class="scrolltop" id="scroll-top">
            <i class='bx bx-chevron-up scrolltop__icon'></i>
        </a>

      
        <header class="l-header" id="header" style="background-color: #B7FFBF">
            <nav class="nav bd-container">
                <a href="#" class="nav__logo" style="font-family:'Brush Script MT', cursive;font-size: 30px;color: DarkRed"><b>Tania'S Dine<i class="fas fa-utensils"></i></b></a>

            <div class="nav__menu" id="nav-menu">
                    <ul class="nav__list">
                        <li class="nav__item"><a href="index.php" class="button" style="background-color: DarkRed">Home</a>
                        </li>
                       
                        
                        
                    </ul>
                </div>

            </nav>
        </header></br></br></br>&nbsp;

        
           

            <div class="container">

            <form action="" method="post" >
<h1 style="font-family: copper;
            font-size: 50px; color:  lightgreen;margin-left: 15%;">
              Booking for any event
            </h1>
           
                <label>Name</label><br>
                <input style="height: 1px" type="text"   class="txt" name="name" placeholder="enter Your username" required="" autocomplete="off"><br>
               

               
                <label>Address</label><br>
                <input style="height: 1px" type="text"   class="txt" name="address" placeholder="enter Your address" required="" autocomplete="off"><br>
                
                
                
                <label>Adequate People</label>
                <input style="height: 1px" type="number" placeholder="how much people will join?"   class="txt" name="people"  required="" autocomplete="off"><br>
              
                <span style="color:yellow;"><b><?php if(isset($errors['t'])) echo $errors['t']; ?></b></span></br>
                
               
              

                
                <label>Date</label><br>
                <input style="height: 1px" type="date"   class="txt" name="date"  required="" autocomplete="off"><br>
                
                 <span style="color: yellow;"><b><?php if(isset($errors['u'])) echo $errors['u']; ?></b></span></br>

                <label>Mobile-no</label>
                <input style="height: 1px" type="text"   class="txt" name="mobile" placeholder="+880............" required="" autocomplete="off"><br>
            
                
                
                
                
                    <label>Select Item</label><br>
                    
                   
                    <input  type="checkbox" value="Appetizer" name="item[]">
                    <label>Appetizer</label>
                  
                    
                    
                    <input  type="checkbox" value="Fastfood"   name="item[]" >
                    <label  >Fastfood</label>
                    
                    
                    
                    <input  type="checkbox" value="Cake-item"  name="item[]" >
                    <label >Cake-item</label>
                  
                  
                    <input  type="checkbox"  value="Drinks"   name="item[]" >
                    <label >Drinks</label><br><br>
                  
                
                
                
                <label >Any-message</label><br>
                <textarea  style="width: 90%;" name="msg"></textarea><br>
            
                
                
                <input type="submit" name="submit" class="a" value="Confirm">



               
            
            </form>

            

            
        </div>
            
            

       
        

            <p  class="footer__copy">&#169;Copyright©FoodOrderingSystembyTaniaSultana</p>
       

        
    </body>
</html>