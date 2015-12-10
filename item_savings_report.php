
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
		<h1>Advertisement Event System - Item Savings Report</h1></a><br/><hr/>
	</div>
</head>

  <center>
  <form action='index.html' method='post'>
  <table cellpadding="5px">
	
<?php
require('db_connect.inc');
connect();

findSavings();

function findSavings(){
	$row = $_POST['row'];
	$implode = implode(',',$row);
	$explode = explode(',', $implode);
	$itemNumber = $explode[0];
	$retail = $explode[5];
	$selectPromotionsForItemStatement = "Select * From PromotionItem WHERE ItemNumber = '".$itemNumber."'";
	$promotionItemResult = mysql_query($selectPromotionsForItemStatement);
	//Test whether the queries were successful
	if (!$promotionItemResult) {
     		$promotionItemMessage = "The retrieval of promotion items was unsuccessful: ";
  	}
	
	$numberPromotionItemRows = mysql_num_rows($promotionItemResult);
	// Check if results turned out empty
	$promotionItemMessage = "";
	if ($numberPromotionItemRows == 0) {
	  $promotionItemMessage = "No items found in database";
	}
	$bestPromo = $retail;
	$bestPrice = "none";
	$adEvent = "none";
	while ($row = mysql_fetch_assoc($promotionItemResult)) {
		$promoCode = $row['PromoCode'];
		$salePrice = $row['SalePrice'];
		if($salePrice < $bestPrice){
			$selectAdEventsForPromotionStatement = "Select * From AdEventPromotion WHERE PromoCode = '".$promoCode."'";
			$adEventPromotionResult = mysql_query($selectAdEventsForPromotionStatement);
			//Test whether the queries were successful
			if (!$adEventPromotionResult) {
     				$adEventPromotionMessage = "The retrieval of promotion items was unsuccessful: ";
  			}
			$numberAdEventPromotionRows = mysql_num_rows($adEventPromotionResult);
			// Check if results turned out empty
			$adEventPromotionMessage = "";
			if ($numberAdEventPromotionRows == 0) {
				$adEventPromotionMessage = "No items found in database";
			}
			else {
				$result = mysql_fetch_assoc($adEventPromotionResult);
				$eventCode = $result['EventCode'];
				$bestPrice = $salePrice;
				$bestPromo = $promoCode;
				$adEvent = $eventCode;
			}
		}
	}
	displayResults($itemNumber, $retail, $bestPrice,  $bestPromo, $adEvent);	
}
function displayResults($itemNum, $retail, $bestPrice,  $bestPromotion, $eventCode){
	$difference = $retail - $bestPrice;
	$difference = number_format ($difference, 2, ".", ",");
	$retail = number_format ($retail, 2, ".", ",");
	$retail = number_format ($retail, 2, ".", ",");
	echo <<<EOD
		<tr><td>Item Number</td><td>$itemNum</td></tr>
		<tr><td>Retail Price</td><td>$$retail</td></tr>
		<tr><td>Best Sale Price</td><td>$$bestPrice</td></tr>
		<tr><td>Difference</td><td>$$difference</td></tr>
		<tr><td>Best Promotion</td><td>$bestPromotion</td></tr>
		<tr><td>Best Ad Event</td><td>$eventCode</td></tr>
EOD;
}
?>
</table>
	<br/>
	<button type="submit" name="submit" value="Submit" accesskey="S" class="button">Back To Main Menu</button>
	</form>
	<br/>
		<a href="report_promotion_view.html"><button name="insert" class="button">Run Another Report</button></a>

		</center>
  </body>
</html>
