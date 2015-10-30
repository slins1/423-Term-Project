<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="jquery-ui.css">
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script src="_script.js"></script>
	<link rel="stylesheet" type="text/css" href="_main.css">
	<link rel="logo_favicon.jpg" href="/favicon.ico"/>        
	<title>Aptaris - Advertisement Event System</title>
	
	<div class="header"><a href="index.html">
		<img src="logo_100.jpg" alt="logo" />
		<h1>Advertisement Event System - Assign Promotion to an Item</h1></a><br/><hr/>
	</div>
</head>

<body>
<center>
<form action='insert_PromotionItem.php' method='post'>
<h2>Please Click submit to confirm the addition of all items to the promotion</h2>
<table>

<?php
require('db_connect.inc');

// Connect to db
connect(DB_SERVER, DB_UN, DB_PWD, DB_NAME);

$category = $_POST['category'];

//Construct SQL statements
$itemSearchStatement = "SELECT ItemNumber, ItemDescription, Category, DepartmentName, PurchaseCost, FullRetailPrice FROM Item WHERE Category = '$category'";

//Execute the queries
$itemResult = mysql_query($itemSearchStatement);

//Test whether the queries were successful
if (!$itemResult) {
 $message = "The retrieval of items was unsuccessful";
}

$numRows = mysql_num_rows($itemResult);

// Check if results turned out empty

$message = "";
if ($numRows == 0) {
	$message = "No items found in database";
}

//Display the results
displayItemsPromotions($message, $itemResult);

//Free the result sets
mysql_free_result($itemResult);

function displayItemsPromotions($itemMessage, $itemResult) {

	$row = mysql_fetch_assoc($itemResult);
	
	$itemNumber = $row['ItemNumber'];
	$itemDescription = $row['ItemDescription'];
	$category = $row['Category'];
	$departmentName = $row['DepartmentName'];
	$purchaseCost = $row['PurchaseCost'];
	$fullRetailPrice = $row['FullRetailPrice'];
	
	echo "<p>$itemMessage</p>";

	
	while ($row = mysql_fetch_assoc($itemResult)) {
	
	  echo <<<EOD
	  	<tr>
				<td><input type='checkbox' name='items[]' value=$itemNumber></td>
				<td>Item Description: $itemDescription</td>
				<td>Category: $category</td>
				<td>Department Name: $departmentName</td>
				<td>Purchase Cost: $purchaseCost</td>
				<td>Full Retail Price: $fullRetailPrice</td>
			</tr>
EOD;
	}
}
?>
</table>
	<p>			
		<button type="reset" name="reset" accesskey="R" class="button">Reset</button>
		<button type="submit" name="submit" value="Submit" accesskey="S" class="button">Submit</button>
	</p>
	</form>
	</center>
</body>
</html>