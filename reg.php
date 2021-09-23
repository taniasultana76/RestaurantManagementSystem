<?php
$con = mysqli_connect("localhost", "root", "", "fosdb");

if(isset($_POST['submit']))
{
    $name = $_POST['username'];
    $email = $_POST['email'];
    $add = $_POST['add'];
    $password = $_POST['password'];
    $cat = $_POST['cat'];
    $image=$_FILES['img']['name'];
    $image_tmp=$_FILES['img']['tmp_name'];
    move_uploaded_file($image_tmp,"image/$image");
   
    $errors = array();


    $u = "SELECT username FROM tbl_log_od WHERE username='$name'";
    $uu = mysqli_query($con, $u);

    $e = "SELECT email FROM tbl_log_od WHERE email='$email'";
    $ee = mysqli_query($con, $e);

    


    if(empty($name)){
        $errors['u'] = "Username Requires";
    }
    else if(mysqli_num_rows($uu) > 0) {

        $errors['u'] = " This username already exits";

    }

    if(empty($email)){
        $errors['e'] = "E-mail Requires";
    }
    else if(mysqli_num_rows($ee) > 0) {

        $errors['e'] = " This e-mail already exits";

    }

    if(empty($password)){
        $errors['p'] = "Password Requires";
    }

    if(count($errors)==0){
        $query = "INSERT INTO tbl_log_od (username, email,address, password, gen, img) VALUES('$name', '$email','$add',
        '$password','$cat', '$image')";

        $result = mysqli_query($con, $query);
        if($result){
            echo "<script>alert('Sucsesfully singed up')</script>";
        }
        else
        {
            echo "<script>alert('Failed to singed up')</script>";
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
        <title>FOS-registration</title>


        <style>
        .container{
             background-color: rgba(44, 62, 80,0.4);
            box-shadow: 2px 2px 2px 1px white;
            padding: 20px 8px 20px 38px;
            width: 35%;
            height: auto;
            margin-left: 32%;
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
            style="background-image:linear-gradient(rgba(0,0,0,0.9),rgba(1,1,1,0.5)),url(cssi/img/f.jpg);
            height:auto;
            background-size:cover;
            background-position:center;">

        <a href="#" class="scrolltop" id="scroll-top">
            <i class='bx bx-chevron-up scrolltop__icon'></i>
        </a>

      
        <header class="l-header" id="header" style="background-color: #B7FFBF">
            <nav class="nav bd-container">
                <a href="index.php" class="nav__logo" style="font-family:'Brush Script MT', cursive;font-size: 30px;color: DarkRed"><b>Tania'S Dine<i class="fas fa-utensils"></i></b></a>

                <div class="nav__menu" id="nav-menu">
                    <ul class="nav__list">
                        <li class="nav__item"><a href="index.php" class="button" style="background-color: DarkRed"><i class="fas fa-angle-double-left"></i> Back</a>
                        </li>
                       
                        
                        
                    </ul>
                </div>

                
            </nav>
        </header></br></br></br>&nbsp;

        
           

            <div class="container">

            <form action="" method="post" style="bottom: 10%" enctype="multipart/form-data">
<h1 style="font-family: copper;
            font-size: 50px; color:  orange;margin-left: 75px;">
              Sing-up here
            </h1>

                    <label>Username:</label><br>
                    <input style="height: 1px" type="text"   class="txt" name="username" placeholder="Enter Your username" required="" autocomplete="" />
                    <br>
                    <span style="color: red;"><b><?php if(isset($errors['u'])) echo $errors['u']; ?></b></span></br>
                    
                    <label  >E-mail:</label><br>
                    <input style="height: 1px" type="email" class="txt"  name="email"  placeholder="Enter Your e-mail" required=""  autocomplete=""  /><br>
                    <span style="color: red;"><b><?php if(isset($errors['e'])) echo $errors['e']; ?></b></span></br>
                    
                    <label  >Address:</label><br>
                    <input style="height: 1px" type="text" class="txt"  name="add"  placeholder="Enter Your address" required="" autocomplete=""/><br><br>


                    <label  >Password:</label><br>
                    <input style="height: 1px" type="password" class="txt"  name="password"  placeholder="Enter Your password" required="" autocomplete="off"/><br><br>

                    

                    <label  >Profile picture:</label><br>
                    <input   type="file" required="required"  name="img" ><br><br>

                    
                    
                
                    <label>Gender:</label><br>
                    
                        <input type="radio" name="cat" value="Female" >Female
                        <input type="radio" name="cat" value="Male" >Male
                        <br><br>

                       
                
                
                
                <input type="submit" name="submit" class="a" value="sing-up">
                <a href="menu/login_food.php" style="float: right;color: pink;">Log-in</a><br>
                <br>
          
            </form>

            

            
        </div>
            
            

       
        
            <p class="footer__copy">&#169;Copyright©FoodOrderingSystembyTaniaSultana</p>
        </footer>

        
    </body>
</html>