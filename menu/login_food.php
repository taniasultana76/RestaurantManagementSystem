

<?php
  include("dbconnection.php");

session_start();

?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>FOS Home_order - Login</title>

    <link href="cssm/bootstrap.min.css" rel="stylesheet">
`   <link href="cssm/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

   

  </head>




  <body style="background-image:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)),url(images/d3.jpg);height:100vh;
  background-size:cover;
  background-position:center;

   ">




<br/>
<center>
<h1  style="font-family:'Brush Script MT', cursive;color:white;font-size: 500%;">Tania'S Dine&nbsp;
<i class="fas fa-utensils"></i></h1>
</center>
<br/>
<div class="col-md-6 my-3" style="width: 500px;
    height: 420px;
    text-align: center;
    margin: 0 auto;
    background-color: rgba(44, 62, 80,0.4);
    box-shadow: 2px 2px 2px 1px grey;
    margin-top: 160px;"><br/><br/>
        <div class="card ">
          <h1  style="font-family:'copper';text-align: center"><b>Log-in For Order</b></h1>
        </div>
        <div class="card-body" style="font-family:copper;">
          <form  action="" method="post">
            <div class="input-group my-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="input-text">
                  <i class="fas fa-user"></i>
                </span>
               </div>
               <input type="text" id="inputUsername" name="name"  class="form-control form-control-lg"
               placeholder="Enter your name" >
            </div>

            <div class="input-group my-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="input-text">
                  <i class="fas fa-key"></i>
                </span>
               </div>

               
               <input type="password"  id="inputPassword" name="password"  class="form-control form-control-lg"
               placeholder="Enter your password" >
            </div>

            

            <button type="submit" name="submit" class="btn btn-block btn-lg text-uppercase contact-btn" style="margin-top:5px;color:black"><i class="fas fa-sign-in-alt mr-2"></i>Log-in</button>
             
            <a href="../index.php" class=" btn btn-block btn-lg text-uppercase contact-btn"  style="margin-top:5px;color:black;background-color: #ececec"><i class="fas fa-angle-double-left"></i>&nbsp;&nbsp;BACK</a><br>
             <div style="float: right;margin-right: 30%;color: red">New to this website?<a href="../reg.php" style="color:red">Sing Up</a></div>

          </form>
          <br>

                <div>
               
        </div>
      </div>
      
    </div>
  </div>



    
    </div>

   

  </body>

</html>
<?php


    

      if(isset($_POST['submit']))
      {
      
      $count= 0;
      $res=mysqli_query($sqlconnection,"SELECT * FROM tbl_log_od WHERE username='$_POST[name]' && password='$_POST[password]';");
      
     
      $row = mysqli_fetch_assoc($res);
      
      $count=mysqli_num_rows($res);
      if($count==0)
      {
        ?>
        <div class="alert alert-danger" style="width: 40%;margin-left: 30%;text-align: center;"><strong>Wrong username or password.</strong></div>
        <?php
      }
      else{

       $_SESSION['name']= $_POST['name'];
       $_SESSION['pic']= $row['img'];
       
       
       
        ?>
        <script type="text/javascript">
          window.location="food.php"
        </script>


        <?php
      }
     
        
      }
    ?>
    














