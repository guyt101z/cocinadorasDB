 <!DOCTYPE html>

<html>
	<head>
		<title>order Form</title>
	</head>
	<body>
		<form action="dataHandler.php" method="post">
		<?php
			$userID = $_POST['USERID'];
			//echo $userID;
			
			echo("<input type='hidden' name='USERID' value= '".$userID."'/>");
			
			$mysqli = new mysqli('localhost', 'lynnujwm_dbuser', 'orange.Y1', 'lynnujwm_RESTAURANT');

			/* check connection */
			if (mysqli_connect_errno()) {
   				printf("Connect failed: %s\n", mysqli_connect_error());
    				exit();
    			}
    			$tableSQL = "SELECT num, id FROM TABLE_NUMS";
			$resultsTable = $mysqli->query($tableSQL);
			echo("<div class='select'>TABLE:<select name='TABLENUM'>");
			while($tableRow = $resultsTable -> fetch_assoc()){
				$tableNum = $tableRow['num'];
				$tableID = $tableRow['id'];
				echo("<option value = '".$tableID."'>".$tableNum."</option>");
			}
			echo("</select></br></br></br>");
    			$sql = "select name, id from MENU_ITEMS";
    			$results = $mysqli->query($sql);
   
    			echo "<select multiple name = 'MULT[]'>";
			while($row = $results->fetch_assoc()){
				echo ("<option value = '".$row['id']."'>".$row['name']."</option>");
			}
			echo("</select>");

			
			
		?>
			
			</br></br></br>
			Special Instruct: 
			<input type="text" name="SPECIAL"></br></br></br></br>
			<input type='reset' value='Clear' name = 'button'>
			<input type='submit' value='Save' name = 'button'>	
		</form>
		
</html>