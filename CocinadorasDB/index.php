<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Cocinadoras</title>
	
		<link rel="stylesheet" href="stylesheet.css">
  	</head>
  		<body>
  		<div id = "banner"></div>
		<form><input type="button" value="Customize" onClick="window.location='prefForm.php'" />
		</form>
		
		<?php
		$mysqli = new mysqli('localhost', 'lynnujwm_dbuser', 'orange.Y1', 'lynnujwm_RESTAURANT');

		/* check connection */
		if (mysqli_connect_errno()) {
   			 printf("Connect failed: %s\n", mysqli_connect_error());
    			exit();
		}
	
		$itemTypes = $mysqli->query("SELECT * FROM ITEM_TYPE ORDER BY ID");
		 
    		/* fetch value */
    		
    		while ($itemRow = $itemTypes->fetch_assoc()) {
    			$type = strtoupper($itemRow['TYPE']);
    			$id = $itemRow['ID'];
    			echo("<div class = 'category'>".$type);
    			$menu = $mysqli->query("SELECT * FROM MENUVIEW where ITEM_TYPE_ID = ".$id);
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