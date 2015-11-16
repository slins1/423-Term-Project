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

<?php
require('db_connect.inc');
connect();

insert_promotionItem();

function insert_promotionItem() {
	$promoCode = $_POST['promoCode'];
	$amountOff = $_POST['amountOff'];
	$promoType = $_POST['promoType'];

	if (isset($_POST['saleItems'])) {

	  $itemArray = $_POST['saleItems'];
	  $arraySize = count($itemArray);

    for ($k = 0; $k < $arraySize; $k++) {
    	$current_item = $itemArray[$k];
    	$item_search_sql ="SELECT ItemNumber, FullRetailPrice FROM Item WHERE ItemNumber = '$current_item'";
    	$itemResult = mysql_query($item_search_sql);
      if (!$itemResult) {
     		$item_search_message = "The retrieval of items was unsuccessful";
  		}
		
			$number_item_rows = mysql_num_rows($itemResult);
  
			// Check if results turned out empty
			$item_search_message = "";
			if ($number_item_rows == 0) {
				$item_search_message = "No items found in database";
	  	}
        	
			$row = mysql_fetch_assoc($itemResult);
			$itemNumber = $row['ItemNumber'];
			$fullRetailPrice = $row['FullRetailPrice'];
      if ($promoType == "Dollar") {
        $salePrice = $fullRetailPrice - $amountOff;
      } else if ($promoType == "Percent") {
        $salePrice = $fullRetailPrice * $amountOff;
      }
      $insertStatement = "INSERT INTO PromotionItem (PromoCode, ItemNumber, SalePrice) VALUES ('$promoCode','$itemNumber', '$salePrice')";
			
			$result = mysql_query($insertStatement);
			
		}
	} else {
		echo "<h2>No sale items</h2>";
	}
}
if (!$result) {
  			echo "<h2>Error in inserting Promotions</h2>";
			} else {
	  		echo "<h2>The Promotions were inserted successfully</h2>";
			} 
?>
<p>
	<a href="index.html"><button name="menu" accesskey="R" class="button">Return to Main Menu</button></a>
	<a href="assign_promotion_item_view.html"><button name="insert"  accesskey="S" class="button">Assign another promotion</button></a>
</p>
</center>
</body>
</html>