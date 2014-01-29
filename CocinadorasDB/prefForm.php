<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Cocinadoras</title>
	</head>
	<body>
		<form action="pref.php" method="post">
		<?php
		$mysqli = new mysqli('localhost', 'lynnujwm_dbuser', 'orange.Y1', 'lynnujwm_RESTAURANT');

		/* check connection */
		if (mysqli_connect_errno()) {
   			 printf("Connect failed: %s\n", mysqli_connect_error());
    			exit();
		}
	
		$itemTypes = $mysqli->query("SELECT * FROM PREFERENCES ORDER BY PREFERENCE");
		 
    		/* fetch value */
    		echo("<div class='label'>Preference");
  		echo("<div class='select'><select name='PREFERENCE'>");
    		while ($row = $itemTypes->fetch_assoc()) {
    			$pref = $row['PREFERENCE'];
    			echo("<option value = '".$pref."'>".$pref."</option>");
    		 }
    		 $mysqli->close();
    		 echo("</select>");
    		 ?>
    		 </div>
    		 </div>
    		 <input type="submit">
		
		
	</form>
	</body>
</html>