<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Tables</title>
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
	    		$countSQL = " SELECT COUNT(*) as COUNT FROM ACCOUNTS";
	    		$resultsCount = $mysqli -> query($countSQL);
	    		while($rowCount = $resultsCount->fetch_assoc()){
				$arrSize = $rowCount['COUNT'];
			}
	    		$userID = $_REQUEST["USERID"];
	    	
			$sqlUser = "SELECT USER_ID FROM ACCOUNTS";
			$resultsUser = $mysqli->query($sqlUser);
			$userIDList = array();
			while($rowUser = $resultsUser->fetch_assoc()){
				array_push($userIDList, $rowUser['USER_ID']);
			}
			//var_dump($userIDList);
			/*for($i = 0; $i< $arrSize; $i ++){
				echo($userIDList[$i]);
			}*/
			
			$var = in_array($userID, $userIDList);
			
			//var_dump(in_array($userID, $userIDList));
			if ($var == TRUE){
				
		
			$userID = ($_REQUEST["USERID"]);
			$sqlString = "SELECT * FROM EMPLOYEE JOIN ACCOUNTS ON ACCOUNTS.EMPLOYEE_ID =";
			$sqlString .= "EMPLOYEE.EMPLOYEE_ID WHERE ACCOUNTS.USER_ID = ".$userID;
			$results = $mysqli->query($sqlString);
			
			while($row = $results->fetch_assoc()){
				$firstName = $row['FIRST_NAME'];
	
			}
			
			$sqlString2 = "SELECT * FROM EMPLOYEE JOIN ACCOUNTS ON ACCOUNTS.EMPLOYEE_ID =";
			$sqlString2 .= "EMPLOYEE.EMPLOYEE_ID WHERE ACCOUNTS.USER_ID = ".$userID;
			$results = $mysqli->query($sqlString2);
			
			while($row = $results->fetch_assoc()){
				$firstName = $row['FIRST_NAME'];
	
			}
			echo("<div id = 'name'>Welcome, ".$firstName."</div>");
			$tableForm = "'tableForm.php'";
			
			$tableSQL = "SELECT * FROM TABLE_NUMS JOIN ORDERS ON ORDERS.TABLE_NUM_ID = TABLE_NUMS.ID order by TABLE_NUMS.NUM";
			$resultsTable = $mysqli->query($tableSQL);
			echo("<div><form action='tableForm.php' method='post'>");
			echo("<input type='hidden' name='USERID' value= '".$userID."'/>");
			while($tableRow = $resultsTable -> fetch_assoc()){
				$tableNum = $tableRow['NUM'];
				echo("</br><div class = 'tablebutton'><input type='submit' name = 'TABLENUM' value='".$tableNum."'/></table>");
			}
			
			echo("</form>");
		
			echo("<form action='orderForm.php' method='post'>");
			echo("<input type='hidden' name='USERID' value= '".$userID."'/>");
			echo("<div id = 'newbutton'><input type='submit' name = 'NEWTABLE' value='New Order'/><div>");
			echo("</form></div>");
		}
		
		else{
			echo("You do not have access.");
		}
	?>
	</div>
	</body>
</html>