<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Data Delete</title>
	</head>
	<body>
		<?php
			
			$mysqli = new mysqli('localhost', 'lynnujwm_dbuser', 'orange.Y1', 'lynnujwm_RESTAURANT');
	
			/* check connection */
			if (mysqli_connect_errno()) {
	   			 printf("Connect failed: %s\n", mysqli_connect_error());
	    			exit();
	    		}
			$userID = $_POST['USERID'];
			$tableID = $_POST["TABLENUM"];
  			
        		echo("<input type='hidden' name='USERID' value= '".$userID."'/>");
			if ($_POST) { 
        			foreach($_POST['MULT'] as $selected) {
            				$sqlString = "DELETE FROM TABLE_ORDERS WHERE ID = ".$selected;
            				$ordered = $mysqli->query($sqlString);
            				
        			}
    			}
    			echo ("<script>window.location = 'tables.php?USERID=".$userID."'</script>");

?>
<script>window.location = "tables.php?"</script>
</body>
</html>