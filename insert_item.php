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
	$description = $_POST['description'];
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
		$message = "Data for Item: $itemNum inserted successfully";
	}

	showItemInsertResult($message, $itemNum, $description, $category, $deptName, $purchaseCost, $retailPrice);
}

function showItemInsertResult($message, $itemNum, $description, $category, $deptName, $purchaseCost, $retailPrice) {

  // If the message is non-null and not an empty string print it
  // message contains the lastname and firstname
  if ($message) {
    if ($message != "") {
      echo "<h2>$message</h2><br />";
    } else {
			echo "<p>Error</p>";
		}
  }
}
?>
<p>
	<button class="button" onclick="goBack()">Back</button>
	<a href="index.html"><button name="menu" accesskey="R" class="button">Return to Main Menu</button></a>
	<a href="insert_item_view.html"><button name="insert"  accesskey="S" class="button">Insert another item</button></a>
</p>
</center>
</body>
</html>
