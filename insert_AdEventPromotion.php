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
		<h1>Advertisement Event System - Assign Promotion to an Ad Event</h1></a><br/><hr/>
	</div>
</head>
<center>

<?php
require('db_connect.inc');
connect();

insert_AdEventPromotion();

function insert_AdEventPromotion() {
	$eventCode = $_POST['eventCode'];
	$eventName = $_POST['eventName'];
	
echo "<h2> The Following Promotions were added to the Ad Event: $eventName </h2>";

	if (isset($_POST['promos'])) {

	  $promoArray = $_POST['promos'];
	  $arraySize = count($promoArray);

    for ($k = 0; $k < $arraySize; $k++) {
    	$promoCode = $promoArray[$k];
    	$promo_search_sql = "SELECT * FROM Promotion WHERE PromoCode = '$promoCode'";
    	$promoResult = mysql_query($promo_search_sql);

    	$row = mysql_fetch_assoc($promoResult);
    	$promoCode = $row['PromoCode'];
    	$name = $row['Name'];
    	$description = $row['Description'];
    	$amountOff = $row['AmountOff'];
    	$promoType = $row['PromoType'];


      $insertStatement = "INSERT INTO AdEventPromotion (EventCode, PromoCode) VALUES ('$eventCode','$promoCode')";
			
			$result = mysql_query($insertStatement);
			if (!$result) {
  			echo "<h2>Error in inserting Ad Event</h2>";
			} else {
	  		echo <<<EOD
	  		<br />
	  		<table>
	  			<tr>
	  				<td>Promo Code</td>
	  				<td>$promoCode</td>
	  			</tr>
	  			<tr>
	  				<td>Name</td>
	  				<td>$name</td>
	  			</tr>
	  			<tr>
	  				<td>Description</td>
	  				<td>$description</td>
	  			</tr>
	  			<tr>
	  				<td>AmountOff</td>
	  				<td>$amountOff</td>
	  			</tr>
	  			<tr>
	  				<td>Promo Type</td>
	  				<td>$promoType</td>
	  			</tr>
	  		</table>
EOD;
			} 
		}
	} else {
		echo "<h2>No promos </h2>";
	}
}

?>
<p>
	<a href="index.html"><button name="menu" accesskey="R" class="button">Return to Main Menu</button></a>
	<a href="assign_promotion_item_view.html"><button name="insert"  accesskey="S" class="button">Assign another promotion</button></a>
</p>
</center>
</body>
</html>