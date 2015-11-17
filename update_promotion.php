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
	
	$updateStatement = "Update Promotion SET Name = '".$promoName."', Description = '".$description."', AmountOff = '".$amountOff."', PromoType = '".$promoType."' WHERE PromoCode = '".$promoCode."'";
	echo "$updateStatement";
	// Execute the query--it will return either true or false
	$result = mysql_query($updateStatement);
	$message = "";
	if(!$result) {
		$message = "Error in updating Promotion: $promoCode, $description";
	} else {
		$message = "Data for Item: $promoCode updated successfully";
	}
	showItemUpdateResult($message, $promoCode, $description, $promoName, $amountOff, $promoType);
}

function showItemUpdateResult($message, $promoCode, $description, $promoName, $amountOff, $promoType) {

  // If the message is non-null and not an empty string print it
  // message contains the lastname and firstname
  if ($message) {
    if ($message != "") {
      echo "<h2>$message</h2><br />";
    } else {
			echo "<p>Error</p>";
		}
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
