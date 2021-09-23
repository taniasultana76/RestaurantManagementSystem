<?php 
	include("../functions.php");

    if((isset($_SESSION['uid']) && isset($_SESSION['username']) && isset($_SESSION['user_level'])) )  {
        if($_SESSION['user_level'] == "admin") {
          header("Location: index.php");
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

    <title>FOS Admin - Login</title>

    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <link href="css/sb-admin.css" rel="stylesheet">

  </head>




  <body style="background-image:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)),url(../image/Picture7.jpg);height:100vh;
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
    height: 400px;
    text-align: center;
    margin: 0 auto;
    background-color: rgba(44, 62, 80,0.4);
    box-shadow: 2px 2px 2px 1px grey;
    margin-top: 160px;"><br/><br/>
        <div class="card text-uppercase">
          <h1 class="text-uppercase" style="font-family:'copper';text-align: center"><b>Admin Log-in</b></h1>
        </div>
        <div class="card-body" style="font-family:'Alex Brush'">
          <form id="loginform">
            <div class="input-group my-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="input-text">
                  <i class="fas fa-user"></i>
                </span>
               </div>
               <input type="text" id="inputUsername" name="username"  class="form-control form-control-lg"
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

            

            <button type="submit"  class="btn btn-block btn-lg text-uppercase contact-btn" style="margin-top:5px;color:black"><i class="fas fa-sign-in-alt mr-2"></i>Log-in</button>
             
            <a href="../index.php" class=" btn btn-block btn-lg text-uppercase contact-btn"  style="margin-top:5px;color:black;background-color: #ececec"><i class="fas fa-angle-double-left"></i>&nbsp;&nbsp;BACK</a>
          </form>
          <br>

                <div>
                <div id="warningbox">
                </div>
        </div>
      </div>
      
    </div>
  </div>



    
    </div>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script type="text/javascript">
        $('#loginform').submit(function() {
            $.ajax({
                type: "POST",
                url: 'process.php',
                data: {
                    username: $("#inputUsername").val(),
                    password: $("#inputPassword").val()
                },
                success: function(data)
                {
                    if (data === 'correct') {
                        window.location.replace('index.php');
                    }
                    else {
                        $("#warningbox").html("<div class='alert alert-danger' role='alert'>"+data+"!</div>");
                    }
                }
            });
            return false;
        });
    </script>

  </body>

</html>
