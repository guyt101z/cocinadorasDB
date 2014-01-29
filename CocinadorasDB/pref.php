<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Special Menu</title>
	
		<link rel="stylesheet" href="stylesheet.css">
  	</head>
  		<body>
  		<div id = "banner"></div>
		<?php
		$mysqli = new mysqli('localhost', 'lynnujwm_dbuser', 'orange.Y1', 'lynnujwm_RESTAURANT');

		/* check connection */
		if (mysqli_connect_errno()) {
   			 printf("Connect failed: %s\n", mysqli_connect_error());
    			exit();
		}
		$customPref = $_POST['PREFERENCE'];
		$prefSQL = "SELECT * FROM PREFERENCES where PREFERENCE = '".$customPref."'";
		//echo($prefSQL);
		$prefResults = $mysqli->query($prefSQL);
		
		while($prefRow = $prefResults->fetch_assoc()){
			$prefID = $prefRow['ID'];
		}
		//echo ($prefID);
		$itemTypes = $mysqli->query("SELECT * FROM ITEM_TYPE ORDER BY ID");
		 
    		/* fetch value */
    		
    		while ($itemRow = $itemTypes->fetch_assoc()) {
    			$type = strtoupper($itemRow['TYPE']);
    			$id = $itemRow['ID'];
    			echo("<div class = 'category'>".$type);
    			$sqlString = "select * from MENU_ITEMS where not exists(";
    			$sqlString.= "select MENU_INGREDIENTS.ID from MENU_INGREDIENTS join PREFERENCE_INGREDIENTS on ";
    			$sqlString.= "MENU_INGREDIENTS.INGREDIENT_ID = PREFERENCE_INGREDIENTS.INGREDIENT_ID ";
    			$sqlString.= "where MENU_INGREDIENTS.MENU_ITEM_ID = MENU_ITEMS.ID AND PREFERENCE_INGREDIENTS.PREFERENCE_ID = ".$prefID;
    			$sqlString.= ") and MENU_ITEMS.ITEM_TYPE_ID = ".$id;
    			//echo($sqlString);
    			$menu = $mysqli->query($sqlString);
    			while ($menuRow = $menu->fetch_assoc()){
    				echo("<div class = 'row'>");
    				echo("<div class = 'name'>".$menuRow['NAME']."</div>");
    				echo("<div class = 'description'>".$menuRow['DESCRIPTION']."</div>");
    				echo("<div class = 'price'>".$menuRow['PRICE']."</div>");
    				echo("</div>");
    			}
    			echo("</div>");
    		}


		/* close connection */
		$mysqli->close();
		?>
	</body>
</html>