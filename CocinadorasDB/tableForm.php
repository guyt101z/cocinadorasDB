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
	    		$itemTypes = $mysqli->query("SELECT * FROM ITEM_TYPE ORDER BY ID");
		 
    		/* fetch value */
    			$userID = $_POST["USERID"];
    			
    			//echo($userID);
    			$tableNum = $_POST["TABLENUM"];
    			echo("<div id = 'main'>");
    			echo("<div id = 'table'>Table: ".$tableNum."</div>");
    			
	    		$sqlString = "select * from ORDERS join TABLE_ORDERS on TABLE_ORDERS.ORDER_ID = ORDERS.ID ";
			$sqlString .= "join MENU_ITEMS on TABLE_ORDERS.MENU_ITEM_ID = MENU_ITEMS.ID join ITEM_TYPE ";
			$sqlString .= " on MENU_ITEMS.ITEM_TYPE_ID = ITEM_TYPE.ID where TABLE_NUM_ID in (select ID from TABLE_NUMS where NUM = ";
			$sqlString .= $tableNum.") order by ITEM_TYPE.ID";
    				//echo($sqlString);
    				
    			$menu = $mysqli->query($sqlString);
    			while ($menuRow = $menu->fetch_assoc()){
    				echo("<div class = 'row'>");
    				echo("<div class = 'name'>".$menuRow['NAME']."</div>");
    				echo("<div class = 'price'>".$menuRow['PRICE']."</div>");
    				echo("</div>");
    			}
    			echo("</div>");
    			
    			$totalSQL = "select ORDER_TOTAL((select ORDERS.ID from ORDERS INNER JOIN TABLE_NUMS ON ORDERS.TABLE_NUM_ID = TABLE_NUMS.ID where TABLE_NUMS.NUM = ".$tableNum.")) as TOTAL";
    			$total = $mysqli->query($totalSQL);
    			$totalRow = $total->fetch_assoc();
    			echo("<span>Total amount: $".$totalRow['TOTAL']."</span>");
    				
    			echo("<form action='tables.php'>");
    			echo("<div class = 'BackButton'><input type='submit' value='Back'/>");
			echo("<input type='hidden' name='USERID' value= '".$userID."'/>");
			echo("<input type='hidden' name='TABLENUM' value= '".$tableNum."'/></div></form>");
			echo("<form action='changeOrder.php' method = 'post'>");
    			echo("<div class = 'DeleteButton'><input type='submit' value='Edit'/>");
			echo("<input type='hidden' name='USERID' value= '".$userID."'/>");
			echo("<input type='hidden' name='TABLENUM' value= '".$tableNum."'/></div></form>");
		?>	
			<form action='servers.php'>
			<div class = 'SOButton'><input type='submit' value='Sign Out'/></div>
			</form>
	</body>
</html>