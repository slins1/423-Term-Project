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
		<h1>Advertisement Event System - Insert Promotion</h1></a><br/><hr/>
	</div>
</head>

<body>
	<center>
	
<?php
require('db_connect.inc');
//Connect to the database 
connect();
//Insert promotion into the database
insertPromotion();

function insertPromotion() {
	$name = $_POST['promoName'];
	$description = $_POST['promoDescription'];
	$amountOff = $_POST['amountOff'];
	$promoType = $_POST['promoType'];

	if(($promoType == 'Percent') && ($amountOff >= 1)){
		$amountOff = $amountOff/100;
		//$amountOff = ltrim($amountOff, "0");
	}
	
	$insertStatement = "INSERT INTO Promotion (Name, Description, AmountOff, PromoType) values ( '$name', '$description', '$amountOff', '$promoType')";
	//Execute the query. The result will just be true or false
	$result = mysql_query($insertStatement);
	$message = "";
	if (!$result) {
  	$message = "Error in inserting Promotion: $name , $description";
	} else {
	  $message = "The Promotion $name was inserted successfully";
	}
	showPromotionInsertResult($message, $name, $description, $amountOff, $promoType);
}
			   
function showPromotionInsertResult($message, $name, $description, $amountOff, $promoType) {
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
	<a href="insert_promotion_view.html"><button name="insert"  accesskey="S" class="button">Insert another promotion</button></a>
</p>
</center>
</body>
</html>
