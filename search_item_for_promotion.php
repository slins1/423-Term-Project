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
<form action='insert_promotionItem.php' method='post'>
<h2>Please Click submit to confirm the addition of all items to the promotion</h2>
<table>

<?php
require('db_connect.inc');
// Connect to db
connect();

function searchItemsByCategory();

function searchItemsByCategory() {
	$promoCode = $_POST['promoCode'];
	$amountOff = $_POST['amountOff'];
	$promoType = $_POST['promoType'];
	$category = $_POST['category'];
	
  //Construct SQL statements
	$item_search_sql = "SELECT ItemNumber, ItemDescription, Category, DepartmentName, PurchaseCost, FullRetailPrice FROM Item WHERE Category = '$category'";

	$itemResult = mysql_query($item_search_sql);
  //Test whether the queries were successful
	if (!$itemResult) {
     $item_search_message = "The retrieval of items was unsuccessful: ";
  }
  
	$number_item_rows = mysql_num_rows($itemResult);
  // Check if results turned out empty
	$item_search_message = "";
	if ($number_item_rows == 0) {
	  $item_search_message = "No items found in database";
	}
  //Display the results
  displayItemsPromotions($item_search_message, $itemResult, $promoCode,
    $amountOff, $promoType);
  //Free the result sets
	mysql_free_result($itemResult);
}

function displayItemsPromotions($item_search_message, $itemResult, $promoCode,
    $amountOff, $promoType) {
	
	echo <<<EOD
	<p>$itemMessage</p>
	<input type="hidden" name="promoCode" value="$promoCode">
  <input type="hidden" name="amountOff" value="$amountOff">
  <input type="hidden" name="promoType" value="$promoType">
EOD;
	
	while ($row = mysql_fetch_assoc($itemResult)) {
		
		$itemNumber = $row['ItemNumber'];
		$itemDescription = $row['ItemDescription'];
		$category = $row['Category'];
		$departmentName = $row['DepartmentName'];
		$purchaseCost = $row['PurchaseCost'];
		$fullRetailPrice = $row['FullRetailPrice'];
	
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