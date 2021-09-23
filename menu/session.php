<?php
	session_start() ;
	if(isset($_SESSION['name']) || ($_SESSION['pic']) ){


	
	}
	else{
		header("location:login_food.php");
	}


	?>