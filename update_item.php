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
			<h1>Advertisement Event System - Update an Item</h1></a>
			<br/><hr/>
		</div>
  </head>
  
<body>
	<center>
<?php
require ('db_connect.inc');
connect();
//Update item in the database
updateItem();

function updateItem() {
	$itemNumber = $_POST['itemNumber'];
	$itemNum = $_POST['itemNum'];
	$description = $_POST['itemDescription'];
	$category = $_POST['category'];
	$deptName = $_POST['departmentName'];
	$purchaseCost = $_POST['purchaseCost'];
	$retailPrice = $_POST['fullRetailPrice'];
	
	$updateStatement = "Update Item SET ItemNumber = '".$itemNum."', ItemDescription = '".$description."', Category = '".$category."', DepartmentName = '".$deptName."', PurchaseCost = '".$purchaseCost."', FullRetailPrice = '".$retailPrice."' WHERE ItemNumber = '".$itemNumber."'";
	// Execute the query--it will return either true or false
	$result = mysql_query($updateStatement);
	$message = "";
	if(!$result) {
		$message = "Error in updating Item: $itemNum, $description";
	} else {
		$message = "Data for Item: $itemNum updated successfully";
	}
	recalculateSalePrice($itemNum);
	showItemUpdateResult($message, $itemNum, $description, $category, $deptName, $purchaseCost, $retailPrice);
}
function recalculateSalePrice($itemNum) {
	$selectStatement = "Select * from PromotionItem Where ItemNumber = '".$itemNum."'";
	$myResult = mysql_query($selectStatement);
	while ($row = mysql_fetch_assoc($myResult)){
		$promoCode = $row['PromoCode'];
		$selectItemSql = "Select * from Item Where ItemNumber = '".$itemNum."'";
		$selectPromotionSql = "Select * from Promotion Where PromoCode = '".$promoCode."'";
		$itemResult = mysql_query($selectItemSql);
		$promotionResult = mysql_query($selectPromotionSql);
		$item = mysql_fetch_assoc($itemResult);
		$promotion = mysql_fetch_assoc($promotionResult);
		$itemPrice = $item['FullRetailPrice'];
		$amountOff = $promotion['AmountOff'];
		$discountType = $promotion['PromoType'];
		if($discountType = "Dollar"){
			$discountPrice = $itemPrice - $amountOff;
		}
		else{
			$discountPrice = $itemPrice*(1-$amountOff);
		}
		$updateSql = "Update PromotionItem SET SalePrice = '".$discountPrice."' Where PromoCode = '".$promoCode."' AND ItemNumber = '".$itemNum."'";
		$result1 = mysql_query($updateSql);
	}
	return;
}
function showItemUpdateResult($message, $itemNum, $description, $category, $deptName, $purchaseCost, $retailPrice) {

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
	<a href="index.html"><button name="menu" accesskey="R" class="button">Return to Main Menu</button></a>
	<a href="update_item_search_view.html"><button name="update"  accesskey="S" class="button">Update another item</button></a>
</p>
</center>
</body>
</html>
