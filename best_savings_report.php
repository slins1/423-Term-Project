
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
	<tr>
		<th>Number</th>
		<th>Item Number</th>
		<th>Full Retail Price</th>
		<th>Best Sale Price</th>
		<th>Price Difference</th>
		<th>Promotion Code</th>
	</tr>
<?php
require('db_connect.inc');
connect();

findSavings();

function findSavings(){
	$selectItemstatement = "Select * From Item";
	$itemResult = mysql_query($selectItemstatement);
	//Test whether the queries were successful
	if (!$itemResult) {
     		$promotionItemMessage = "The retrieval of items was unsuccessful: ";
  	}
	
	$numberItemRows = mysql_num_rows($itemResult);
	// Check if results turned out empty
	$itemMessage = "";
	if ($numberItemRows == 0) {
	  $itemMessage = "No items found in database";
	}

	while ($row = mysql_fetch_assoc($itemResult)) {
		$itemNumber= $row['ItemNumber'];
		$retail =$row['FullRetailPrice'];
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

		$bestPromo = "No Promotion";
		$bestPrice = $retail;
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
					$difference = $retail - $bestPrice;
				}
			}
		}
		$itemInfo = array ("ItemNumber" => $itemNumber, "RetailPrice" => $retail, "BestPrice" => $bestPrice, "BestPromotion" => $bestPromo, "Difference" => $difference);
		$items[$itemNumber] = $itemInfo;
		$itemPrices[$itemNumber] = $difference;
	}
	$topItems = limitResultsToFifty($itemPrices);
	$i = 1;
	foreach ($topItems as $number => $comparePrice){
		$info = $items[$number];
		$itemNumber = $info["ItemNumber"];
		$retail = $info["RetailPrice"];
		$bestPrice = $info["BestPrice"];
		$promotion = $info["BestPromotion"];
		displayResults($i, $itemNumber, $retail, $bestPrice, $promotion);
		$i= $i + 1;
	}
}
function limitResultsToFifty ($itemPrices){
	foreach ($itemPrices as $itemNumber => $price){
		if(count($topItems) < 50){
			$topItems[$itemNumber]= $price;
		}
		else{
			$flag = 0;
			foreach ($topItems as $number => $comparePrice){
				if(($price < $comparePrice) && ($flag = 0)){
					unset($topItems[$number]);
					$topItems[$itemNumber]= $price;
					$flag = 1;
				}
			}
		}
	}
	return $topItems;	
}
function displayResults($i, $itemNum, $retail, $bestPrice,  $bestPromotion){
	$difference = $retail - $bestPrice;
	$difference = number_format ($difference, 2, ".", ",");
	$retail = number_format ($retail, 2, ".", ",");
	$retail = number_format ($retail, 2, ".", ",");
	echo <<<EOD
		<tr>
			<td>$i</td>
			<td>$itemNum</td>
			<td>$$retail</td>
			<td>$$bestPrice</td>
			<td>$$difference</td>
			<td>$bestPromotion</td>
		</tr>
EOD;
}
?>
</table>
	<br/>
	<button type="submit" name="submit" value="Submit" accesskey="S" class="button">Back To Main Menu</button>
	</form>
	<br/>
	</center>
  </body>
</html>
