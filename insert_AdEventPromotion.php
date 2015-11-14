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

<?php
require('db_connect.inc');
connect();

insert_AdEventPromotion();

function insert_AdEventPromotion() {
	$eventCode = $_POST['eventCode'];
	

	if (isset($_POST['promos'])) {

	  $promoArray = $_POST['promos'];
	  $arraySize = count($promoArray);

    for ($k = 0; $k < $arraySize; $k++) {
    	$promoCode = $promoArray[$k];
    	
      $insertStatement = "INSERT INTO AdEventPromotion (EventCode, PromoCode) VALUES ('$eventCode','$promoCode')";
			
			$result = mysql_query($insertStatement);
			if (!$result) {
  			echo "<h2>Error in inserting Ad Event</h2>";
			} else {
	  		echo "<h2>The Ad Events were inserted successfully</h2>";
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