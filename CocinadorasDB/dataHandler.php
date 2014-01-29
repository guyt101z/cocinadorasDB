<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Server Form</title>
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
        		$special = $_POST['SPECIAL'];
        		echo "TID".$tableID."</br>";
  			
        		echo("<input type='hidden' name='USERID' value= '".$userID."'/>");
        		
        		$tableSQL = "select ORDERS.ID from ORDERS join TABLE_NUMS on TABLE_NUMS.ID = ORDERS.TABLE_NUM_ID where ORDERS.TABLE_NUM_ID =".$tableID;
      			$results = $mysqli->query($tableSQL);
      			while ($orderRow = $results -> fetch_assoc()){
      				$orderID = $orderRow['ID'];
      				
      			}
 
      			if ($orderID == NULL){
      				$tableQ = "INSERT INTO ORDERS(ID, TABLE_NUM_ID, EMPLOYEE_ID, PAID) VALUES ('',".$tableID.",".$userID.",'')";
      				$resultOrder = $mysqli->query($tableQ);
      				$orderID = $mysqli->insert_id;
      			}
      			echo $orderID;
      			
      			
			if ($_POST) { 
        			foreach($_POST['MULT'] as $selected) {
            				$sqlString = "INSERT INTO TABLE_ORDERS(ID,ORDER_ID,MENU_ITEM_ID,SPECIAL_INSTRUCT) ";
            				$sqlString.= "VALUES ('',".$orderID.",".$selected.",'".$special."') ";
            				echo ($sqlString);
            				$ordered = $mysqli->query($sqlString);
            				
        			}
    			}

?>
<script>window.location = "servers.php"</script>
</body>
</html>