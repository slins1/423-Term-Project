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
			<h1>Advertisement Event System - Update a Promotion</h1></a>
			<br/><hr/>
		</div>
  </head>
  
<body>
	<center>
<?php
require ('db_connect.inc');
connect();
//Update promotion in the database
updatePromotion();

function updatePromotion() {
	$promoCode = $_POST['promoCode'];
	$promoName = $_POST['name'];
	$description = $_POST['description'];
	$amountOff = $_POST['amountOff'];
	$promoType = $_POST['promoType'];


	if(($promoType == 'Percent') && ($amountOff >= 1)){
		$amountOff = $amountOff/100;
		//$amountOff = ltrim($amountOff, "0");
	}
	
	$updateStatement = "Update Promotion SET Name = '".$promoName."', Description = '".$description."', AmountOff = '".$amountOff."', PromoType = '".$promoType."' WHERE PromoCode = '".$promoCode."'";
	// Execute the query--it will return either true or false
	$result = mysql_query($updateStatement);
	$message = "";
	if(!$result) {
		$message = "Error in updating Promotion: $promoCode, $description";
	} else {
		$message = "Data for Promotion: $promoCode updated successfully";
	}
	recalculateSalePrice($promoCode);
	showItemUpdateResult($message, $promoCode, $description, $promoName, $amountOff, $promoType);
}
function recalculateSalePrice($promoCode) {
	$selectStatement = "Select * from PromotionItem Where PromoCode = '".$promoCode."'";
	$myResult = mysql_query($selectStatement);
	while ($row = mysql_fetch_assoc($myResult)){
		$itemNum = $row['ItemNumber'];
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
function showItemUpdateResult($message, $promoCode, $description, $promoName, $amountOff, $promoType) {

  // If the message is non-null and not an empty string print it
  // message contains the lastname and firstname
  if ($message != "") {
		echo <<<EOD
			<h2 class='text-center'>$message</h2>
			<table>
					<tr>
						<td>Description:</td>
						<td>$description</td>
					</tr>
					<tr>
						<td>Amount Off:</td>
						<td>$amountOff</td>
					</tr>
					<tr>
						<td>Promo Type:</td>
						<td>$promoType</td>
					</tr>
			</table>
EOD;
    } else {
			echo "<h2>Error in inserting promotion</h2>";
  }
}
?>
<p>
	<a href="index.html"><button name="menu" accesskey="R" class="button">Return to Main Menu</button></a>
	<a href="update_promotion_search_view.html"><button name="update"  accesskey="S" class="button">Update another promotion</button></a>
</p>
</center>
</body>
</html>
