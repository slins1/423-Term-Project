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
		<h1>Advertisement Event System - Assign Promotion to an Ad Event</h1></a><br/><hr/>
	</div>
</head>
<body>
<center>
<table>
<tr>
	<th>Item Number</th>
	<th>Item Description</th>
	<th>Category</th>
	<th>Department Name</th>
	<th>Purchase Cost</th>
	<th>Full Retail Price</th>
	<th>Sale Price</th>

  <form action='index.html' method='post'>

<?php
require('db_connect.inc');
connect();

retrieveItems();

function retrieveItems() {
	
	$promoCode1 = $_POST['promo'];
	$promo_search_sql ="SELECT PromoCode, Name, AmountOff, PromoType 
        FROM Promotion WHERE PromoCode = $promoCode1";

        $promoResult = mysql_query($promo_search_sql);
        $row = mysql_fetch_assoc($promoResult);

        $promoCode = $row['PromoCode'];
        $promoName = $row['Name'];
        $amountOff = $row['AmountOff'];
        $promoType = $row['PromoType'];



    echo"<h2>Items associated with Promotion: $promoName</h2>";

    $itemPromoSearch = "SELECT ID, ItemNumber, SalePrice 
    FROM PromotionItem Where PromoCode = '$promoCode'";
    

    $itemPromoResult = mysql_query($itemPromoSearch);

    while($row2 = mysql_fetch_assoc($itemPromoResult)){
    	
    	$id = $row2['ID'];
    	$itemNumber = $row2['ItemNumber'];
	$salePrice = $row2['SalePrice'];

    	$itemSearch = "SELECT * FROM Item WHERE ItemNumber = $itemNumber";

    	$searchResult = mysql_query($itemSearch);

    	while($row3 = mysql_fetch_assoc($searchResult)){
    		
    		$itemNumber2 = $row3['ItemNumber'];
    		$itemDescription2 = $row3['ItemDescription'];
    		$category2 = $row3['Category'];
    		$departmentName2 = $row3['DepartmentName'];
    		$purchaseCost2 = $row3['PurchaseCost'];
		$fullRetailPrice2 = $row3['FullRetailPrice'];


		echo <<<EOD
    <tr>
		<td>$itemNumber2</td>
		<td>$itemDescription2</td>
		<td>$category2</td>
		<td>$departmentName2</td>
		<td>$purchaseCost2</td>
		<td>$fullRetailPrice2</td>
		<td>$salePrice</td>
	</tr>
EOD;
    	}

    }
    








}
	
?>
	</table>
	<br/>

	<button type="submit" name="submit" value="Submit" accesskey="S" class="button">Back To Main Menu</button>
	</form>
	<br/>
		<a href="report_promotion_items_view.html"><button name="insert" class="button">Run Another Report</button></a>
  </center>
  </body>
</html>