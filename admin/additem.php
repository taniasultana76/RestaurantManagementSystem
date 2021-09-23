<?php

	
	if (isset($_POST['addItem'])) {
		$image = $_POST['img'];

		if (!empty($_POST['itemName']) && !empty($_POST['itemPrice'])  && !empty($_POST['menuID'])) {
			$itemName = $sqlconnection->real_escape_string($_POST['itemName']);
			$itemPrice = $sqlconnection->real_escape_string($_POST['itemPrice']);
			$menuID = $sqlconnection->real_escape_string($_POST['menuID']);
			$image=($_FILES['img']['name']);
			$image_tmp=($_FILES['img']['tmp_name']);
			move_uploaded_file($image_tmp,"images/$image");

			$addItemQuery = "INSERT INTO tbl_menuitem (menuID ,menuItemName ,price ,img) VALUES ({$menuID} ,'{$itemName}' ,{$itemPrice} ,'{$image}')";

			if ($sqlconnection->query($addItemQuery) === TRUE) {
				header("Location: menu.php"); 
				exit();

			} 

			else {
				
				echo "someting wong";
				echo $sqlconnection->error;
			}
		}

		
		else {
			echo "Jangan bia kosong bang";
		}

	}

	
?>