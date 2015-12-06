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
<center>
<table>

<?php
require('db_connect.inc');
connect();

insert_AdEventPromotion();

function insert_AdEventPromotion() {
	$eventCode = $_POST['eventCode'];
	$eventName = $_POST['eventName'];
	
echo "<h2> The Following Promotions were added to the Ad Event: $eventName </h2>";
echo <<<EOD
	<tr>
		<th><b>Promo Code</b></th>
		<th><b>Name</b></th>
		<th><b>Description</b></th>
		<th><b>Amount Off</b></th>
		<th><b>Promotion Type</b></th>
	</tr>
EOD;
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

    	if (($promoType == 'Percent') && ($amountOff >= 1)) {
        	$amountOff =  str_replace("%", "", $amountOff);
            $amountOff = $amountOff/100;
	}


      $insertStatement = "INSERT INTO AdEventPromotion (EventCode, PromoCode) VALUES ('$eventCode','$promoCode')";
			
			$result = mysql_query($insertStatement);
			if (!$result) {
  			echo "<h2>Error in inserting Ad Event</h2>";
			} else {
	  		echo <<<EOD
	  			<tr>
	  				<td>$promoCode</td>
	  				<td>$name</td>
	  				<td>$description</td>
	  				<td>$amountOff</td>
	  				<td>$promoType</td>
	  			</tr>
EOD;
			} 
		}
	} else {
		echo "<h2>No promos </h2>";
	}
}

?>
</table>
<p>
	<a href="index.html"><button name="menu" accesskey="R" class="button">Return to Main Menu</button></a>
	<a href="assign_promotion_adEvent_view.html"><button name="insert"  accesskey="S" class="button">Assign another promotion</button></a>
</p>
</center>
</body>
</html>