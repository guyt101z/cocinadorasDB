<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Promotion</title>
	</head>
	<body>
		<div id = 'main'>
		<?php
		$mysqli = new mysqli('localhost', 'lynnujwm_dbuser', 'orange.Y1', 'lynnujwm_RESTAURANT');

		/* check connection */
		if (mysqli_connect_errno()) {
   			 printf("Connect failed: %s\n", mysqli_connect_error());
    			exit();
    		}
    		$empID = $_REQUEST["EMP_ID"];
    		$promoteSQL = "call PROMOTE_EMPLOYEE_ID(".$empID.");";
    		$mysqli -> query($promoteSQL);
    		echo "Employee ID ".$empID." has been promoted! Congratulations!"	
	?>
	</div>
	</body>
</html>