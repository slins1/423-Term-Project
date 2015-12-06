<!DOCTYPE html>
<html>
  <head>
      <link rel="stylesheet" href="jquery-ui.css">
			<script src="//code.jquery.com/jquery-1.10.2.js"></script>
			<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
      <script src="_script.js"></script>
      <link rel="stylesheet" type="text/css" href="_main.css">
      <link rel="images/logo_favicon.jpg" href="/favicon.ico"/>        
      <title>Aptaris - Advertisement Event System</title>
      
      <div class="header"><a href="index.html">
			<img src="images/logo_100.jpg" alt="logo" />
			<h1>Advertisement Event System - Insert an Item</h1></a>
			<br/><hr/>
		</div>
  </head>
  
<body>
	<center>
<?php
require ('db_connect.inc');
connect();
//Insert item into the database
insertItem();

function insertItem() {
	$itemNum = $_POST['itemNum'];
	$description = $_POST['itemDescription'];
	$category = $_POST['category'];
	$deptName = $_POST['deptName'];
	$purchaseCost = $_POST['purchaseCost'];
	$retailPrice = $_POST['retailPrice'];

	$insertStatement = "INSERT INTO Item (ItemNumber, ItemDescription, Category, DepartmentName, PurchaseCost, FullRetailPrice) values ( '$itemNum', '$description', '$category', '$deptName', '$purchaseCost', '$retailPrice')";
	
	// Execute the query--it will return either true or false
	$result = mysql_query($insertStatement);
	$message = "";
	if (!$result) {
		$message = "Error in inserting Item: $itemNum, $description";
	} else {
		$message = "Data for Item number $itemNum inserted successfully";
	}

	showItemInsertResult($message, $itemNum, $description, $category, $deptName, $purchaseCost, $retailPrice);
}

function showItemInsertResult($message, $itemNum, $description, $category, $deptName, $purchaseCost, $retailPrice) {

  // If the message is non-null and not an empty string print it
  // message contains the lastname and firstname
 if ($message) {
    if ($message != "") {
      echo <<<EOD
      		
			<h2 class='text-center'>$message</h2>
			<table>
					<tr>
						<td>Item Number:</td>
						<td>$itemNum</td>
					</tr>
					<tr>
						<td>Department Name:</td>
						<td>$deptName</td>
					</tr>
					<tr>
						<td>Category:</td>
						<td>$category</td>
					</tr>
					<tr>
						<td>Purchase Cost:</td>
						<td>$purchaseCost</td>
					</tr>
					<tr>
						<td>Retail Price:</td>
						<td>$retailPrice</td>
					</tr>
					<tr>
						<td>Description:</td>
						<td>$description</td>
					</tr>
			</table>
EOD;
    } else {
			echo "<p>Error</p>";
		}
  }
}
?>
<p>
	<a href="index.html"><button name="menu" class="button">Return to Main Menu</button></a>
	<a href="insert_item_view.html"><button name="insert"  accesskey="S" class="button">Insert another item</button></a>
</p>
</center>
</body>
</html>