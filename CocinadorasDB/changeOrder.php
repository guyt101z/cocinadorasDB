 <!DOCTYPE html>

<html>
	<head>
		<title>Change Order</title>
	</head>
	<body>
		<form action="dataDelete.php" method="post">
		<?php
			$userID = $_POST['USERID'];
			//echo $userID;
			$tableNum = $_POST['TABLENUM'];
			echo("<input type='hidden' name='USERID' value= '".$userID."'/>");
			
			$mysqli = new mysqli('localhost', 'lynnujwm_dbuser', 'orange.Y1', 'lynnujwm_RESTAURANT');

			/* check connection */
			if (mysqli_connect_errno()) {
   				printf("Connect failed: %s\n", mysqli_connect_error());
    				exit();
    			}
    			echo("<div id = 'table'>Table: ".$tableNum."</div>");
    			$sqlString = "select TABLE_ORDERS.ID, MENU_ITEMS.NAME from ORDERS join TABLE_ORDERS on TABLE_ORDERS.ORDER_ID = ORDERS.ID ";
			$sqlString .= "join MENU_ITEMS on TABLE_ORDERS.MENU_ITEM_ID = MENU_ITEMS.ID join ITEM_TYPE ";
			$sqlString .= " on MENU_ITEMS.ITEM_TYPE_ID = ITEM_TYPE.ID where TABLE_NUM_ID in (select ID from TABLE_NUMS where NUM = ";
			$sqlString .= $tableNum.") order by ITEM_TYPE.ID";
			//echo($sqlString);
    			$results = $mysqli->query($sqlString);
   
    			echo "<select multiple name = 'MULT[]'>";
			while($row = $results->fetch_assoc()){
				echo ("<option value = '".$row['ID']."'>".$row['NAME']."</option>");
			}
			echo("</select>");
			echo("<input type='hidden' name='USERID' value= '".$userID."'/>");
			echo("<input type='hidden' name='TABLENUM' value= '".$tableNum."'/>");

			
			
		?>
			
			<input type='submit' value='Remove' name = 'button'>
		</form>
		
</html>