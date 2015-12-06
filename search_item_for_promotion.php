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
		<h1>Advertisement Event System - Assign Item to a Promotion</h1></a><br/><hr/>
	</div>
</head>
<body>
<center>
<form action='insert_PromotionItem.php' method='post'>
<?php
require('db_connect.inc');
connect();

searchItemsByCategory();

function searchItemsByCategory() {
	$promoCode = $_POST['promoCode'];
	$promoName = $_POST['promoName'];
	$amountOff = $_POST['amountOff'];
	$promoType = $_POST['promoType'];

echo <<<EOD
	<h2>Please check all items you would like to add to the promotion $promoName</h2>
<h2> Click submit to confirm the addition of all items to the promotion</h2>
<table>
EOD;

	$itemNumber = $_POST['itemNumber'];
	$itemDescription = $_POST['itemDescription'];
	$category = $_POST['category'];
	$departmentName = $_POST['departmentName'];
	$purchaseCost = $_POST['purchaseCost'];
	$fullRetailPrice = $_POST['fullRetailPrice'];

	$cond1 = "";
	$cond2 = "";
	$cond3 = "";
	$cond4 = "";
	$cond5 = "";
	$cond6 = "";
	$whereCondition = "";

	if(isset($itemNumber) && ($itemNumber != "")){
		$cond1 = "ItemNumber = '".$itemNumber."'";
	}
	if(isset($itemDescription) && ($itemDescription != "")){
		$cond2 = "ItemDescription = '".$itemDescription."'";
	}
	if(isset($category) && ($category != "---")){
		$cond3 = "Category = '".$category."'";
	}
	if(isset($departmentName) && ($departmentName != "---")){
		$cond4 = "DepartmentName = '".$departmentName."'";
	}
	if(isset($purchaseCost) && ($purchaseCost != "")){
		$cond5 = "PurchaseCost = '".$purchaseCost."'";
	}
	if(isset($fullRetailPrice) && ($fullRetailPrice != "")){
		$cond6 = "FullRetailPrice = '".$fullRetailPrice."'";
	}

	if($cond1 != ""){
		$whereCondition = $whereCondition.$cond1;
	}
	if($cond2 != ""){
		if(strlen($whereCondition) > 1){
			$whereCondition = $whereCondition." AND ".$cond2;
		}
		else{
			$whereCondition = $whereCondition.$cond2;
		}
	}
	if($cond3 != ""){
		if(strlen($whereCondition) > 1){
			$whereCondition = $whereCondition." AND ".$cond3;
		}
		else{
			$whereCondition = $whereCondition.$cond3;
		}
	}
	if($cond4 != ""){
		if(strlen($whereCondition) > 1){
			$whereCondition = $whereCondition." AND ".$cond4;
		}
		else{
			$whereCondition = $whereCondition.$cond4;
		}
	}
	if($cond5 != ""){
		if(strlen($whereCondition) > 1){
			$whereCondition = $whereCondition." AND ".$cond5;
		}
		else{
			$whereCondition = $whereCondition.$cond5;
		}
	}
	if($cond6 != ""){
		if(strlen($whereCondition) > 1){
			$whereCondition = $whereCondition." AND ".$cond6;
		}
		else{
			$whereCondition = $whereCondition.$cond6;
		}
	}

	$item_search_sql = "SELECT ItemNumber, ItemDescription, Category, 
	DepartmentName, PurchaseCost, FullRetailPrice FROM Item 
	WHERE $whereCondition";
	
	//Construct SQL statements

	/*
	if($searchType == "Item Number"){
	$item_search_sql = "SELECT ItemNumber, ItemDescription, Category, 
	DepartmentName, PurchaseCost, FullRetailPrice FROM Item 
	WHERE ItemNumber = '$searchData'";
	}
	else if($searchType == "Item Description"){
	$item_search_sql = "SELECT ItemNumber, ItemDescription, Category, 
	DepartmentName, PurchaseCost, FullRetailPrice FROM Item 
	WHERE ItemDescription = '$searchData'";
	}
	else if($searchType == "Category"){
	$item_search_sql = "SELECT ItemNumber, ItemDescription, Category, 
	DepartmentName, PurchaseCost, FullRetailPrice FROM Item 
	WHERE Category = '$searchData'";
	}
	else if($searchType == "Department Name"){
	$item_search_sql = "SELECT ItemNumber, ItemDescription, Category, 
	DepartmentName, PurchaseCost, FullRetailPrice FROM Item 
	WHERE DepartmentName = '$searchData'";
	}
	else if($searchType == "Purchase Cost"){
	$item_search_sql = "SELECT ItemNumber, ItemDescription, Category, 
	DepartmentName, PurchaseCost, FullRetailPrice FROM Item 
	WHERE PurchaseCost = '$searchData'";
	}
	else if($searchType == "Full Retail Price"){
	$item_search_sql = "SELECT ItemNumber, ItemDescription, Category, 
	DepartmentName, PurchaseCost, FullRetailPrice FROM Item 
	WHERE FullRetailPrice = '$searchData'";
	}
*/
	
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
    $promoName, $amountOff, $promoType);
  //Free the result sets
	mysql_free_result($itemResult);
}

function displayItemsPromotions($item_search_message, $itemResult, $promoCode,
    $promoName, $amountOff, $promoType) {
	    
	  echo <<<EOD
	<p>$item_search_message</p>
	<input type="hidden" name="promoCode" value="$promoCode">
	<input type="hidden" name="promoName" value="$promoName">
  <input type="hidden" name="amountOff" value="$amountOff">
  <input type="hidden" name="promoType" value="$promoType">
  <tr>
  	<th></th>
  	<th><b>ITEM NUMBER</b></th>
  	<th><b>ITEM DESCRIPTION</b></th>
  	<th><b>CATEGORY</b></th>
  	<th><b>DEPARTMENT NAME</b></th>
  	<th><b>PURCHASE COST</b></th>
  	<th><b>FULL RETAIL PRICE</b></th>
  </tr>
EOD;
		
		while ($row = mysql_fetch_assoc($itemResult)) {
		
		$itemNumber = $row['ItemNumber'];
		$itemDescription = $row['ItemDescription'];
		$category = $row['Category'];
		$departmentName = $row['DepartmentName'];
		$purchaseCost = $row['PurchaseCost'];
		$fullRetailPrice = $row['FullRetailPrice'];
	
	  echo "<tr>";
			if (isDuplicateItem($itemNumber)) {
				echo "<td title='Item is already in the promotion'><input type='checkbox' title='Item is already in the promotion' disabled='true' name='saleItems[]' value=$itemNumber></td>";
			} else {
				echo "<td><input type='checkbox' name='saleItems[]' value=$itemNumber></td>";
			}
	  echo <<<EOD
				<td>$itemNumber</td>
				<td>$itemDescription</td>
				<td>$category</td>
				<td>$departmentName</td>
				<td>$purchaseCost</td>
				<td>$fullRetailPrice</td>
			</tr>
EOD;

	}
}

function isDuplicateItem($itemNumber) {
	$promoCode = $_POST['promoCode'];
	$checkItemStatement = "SELECT ItemNumber FROM PromotionItem WHERE PromoCode = '$promoCode'";
	$itemResult = mysql_query($checkItemStatement);
	while ($row = mysql_fetch_assoc($itemResult)) {
		if ($row['ItemNumber'] == $itemNumber) {
			return true;
		}	
	}
	return false;
}

?>
</table>
	<p>			
		<button type="reset" name="reset" accesskey="R" class="button">Reset</button>
		<button type="submit" name="submit" value="Submit" accesskey="S" class="button">Submit</button>
</p></form>
	<p><br/><a href="index.html"><button name="menu" class="button">Return to Main Menu</button></a></p>
	</center>
</body>
</html>