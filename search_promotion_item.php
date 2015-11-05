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

  <center>
  <form action='search_item.php' method='post'>
	<h2>Please select a promotion and click submit to confirm, or click back to go back</h2>
	<table>
<?php
require('db_connect.inc');
connect();

retrievePromotions();

function retrievePromotions() {
	$searchType = $_POST['searchType'];
	$searchData = $_POST['searchData'];

	if($searchType == "Promotion Code"){
		$insertStatement = "SELECT PromoCode, Name, Description, 
		AmountOff, PromoType FROM Promotion 
		WHERE PromoCode = '$searchData'";
	}
	else if($searchType == "Promotion Name"){
		$insertStatement = "SELECT PromoCode, Name, Description, 
		AmountOff, PromoType FROM Promotion 
		WHERE Name = '$searchData'";
	}
	else if($searchType == "Promotion Description"){
		$insertStatement = "SELECT PromoCode, Name, Description, 
		AmountOff, PromoType FROM Promotion 
		WHERE Description = '$searchData'";
	}
	else if($searchType == "Amount Off"){
		$insertStatement = "SELECT PromoCode, Name, Description, 
		AmountOff, PromoType FROM Promotion 
		WHERE AmountOff = '$searchData'";
	}
	else if($searchType == "Promotion Type(Dollar/Percent)"){
		$insertStatement = "SELECT PromoCode, Name, Description, 
		AmountOff, PromoType FROM Promotion 
		WHERE PromoType = '$searchData'";
	}
	
	//Construct SQL statements
	
	
	//Execute the queries
	$result = mysql_query($insertStatement);
	$numberPromotionRows = mysql_num_rows($result);

	//Test whether the queries were successful
	if (!$result || $numberPromotionRows == 0) {
	   $message = "The retrieval of promotions was unsuccessful";
	}
	
	//Display the results
	displayItemsPromotions($message, $result);
	
	//Free the result sets
	mysql_free_result($result);

}

function displayItemsPromotions($promoMessage, $promoResult) {

	echo '<input type="hidden" name="promoCode" value="'.$promoCode.'" >';
    echo '<input type="hidden" name="amountOff" value="'.$amountOff.'" >';
    echo '<input type="hidden" name="promoType" value="'.$promoType.'" >';


	while ($row = mysql_fetch_assoc($promoResult)) {
    $promoCode = $row['PromoCode'];
    $name = $row['Name'];
    $description = $row['Description'];
    $amountOff = $row['AmountOff'];
    $promoType = $row['PromoType'];
    

		echo <<<EOD
    <tr>
			<td><input type='checkbox' name='promo[]' value=$promoCode></td>
      		<td>Name: $name</td>
			<td>Description: $description</td>
			<td>Amount Off: $amountOff</td>
			<td>Promotion Type: $promoType</td>
		</tr>
	
EOD;
}



}
	
?>
	</table>
	<br/>
	<a href="assign_promotion_item_view.html"><button class="button">Back</button></a>
	<button type="submit" name="submit" value="Submit" accesskey="S" class="button">Submit</button>
	</form>
		</center>
  </body>
</html>