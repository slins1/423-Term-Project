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
		<h1>Advertisement Event System - Update Item</h1></a><br/><hr/>
	</div>
</head>

<body>
<center>
<form action='update_item_view.php' method='post'>
<h2>Please check the item you would like to update</h2>
<table>


<?php
require('db_connect.inc');
connect();

searchItemsByCategory();

function searchItemsByCategory() {

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
		$cond2 = "ItemDescription LIKE '%".$itemDescription."%'";
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
  displayItemsPromotions($item_search_message, $itemResult);
  //Free the result sets
	mysql_free_result($itemResult);
}

function displayItemsPromotions($item_search_message, $itemResult) {
	    
	  echo <<<EOD
	<p>$item_search_message</p>
  <tr>
  	<td></td>
  	<td><b>ITEM NUMBER</b></td>
  	<td><b>ITEM DESCRIPTION</b></td>
  	<td><b>CATEGORY</b></td>
  	<td><b>DEPARTMENT NAME</b></td>
  	<td><b>PURCHASE COST</b></td>
  	<td><b>FULL RETAIL PRICE</b></td>
  </tr>
EOD;
		
		while ($row = mysql_fetch_assoc($itemResult)) {
		
		$itemNumber = $row['ItemNumber'];
		$itemDescription = $row['ItemDescription'];
		$category = $row['Category'];
		$departmentName = $row['DepartmentName'];
		$purchaseCost = $row['PurchaseCost'];
		$fullRetailPrice = $row['FullRetailPrice'];
	
	  echo '<tr>';
				echo "<td><input type='radio' name='row[]' value='". implode(',', $row) ."'></td>";
				echo "<td>$itemNumber</td>";
				echo "<td>$itemDescription</td>";
				echo "<td>$category</td>";
				echo "<td>$departmentName</td>";
				echo "<td>$purchaseCost</td>";
				echo "<td>$fullRetailPrice</td>";
			echo '</tr>';

	}

}
?>
</table>
	<p>			
		<button class="button" onclick="goBack()">Back</button>
		<button type="submit" name="submit" value="Submit" accesskey="S" class="button">Submit</button>
</p></form>
	<p><br/><a href="index.html"><button name="menu" class="button">Return to Main Menu</button></a></p>
	</center>
</body>
</html>
