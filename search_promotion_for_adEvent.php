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
<form action='insert_AdEventPromotion.php' method='post'>

<?php
require('db_connect.inc');
connect();

searchPromotions();

function searchPromotions() {
	$eventCode = $_POST['eventCode'];
	$eventName = $_POST['eventName'];
echo <<<EOD
	<h2>Please check all promotions you would like to add to the Ad Event $eventName</h2>
<h2> Click submit to confirm the addition of all promotions to the Ad Event</h2>
<table>
EOD;
	$promoCode = $_POST['promoCode'];
	$name = $_POST['name'];
	$description = $_POST['description'];
	$amountOff = $_POST['amountOff'];
	$promoType = $_POST['promoType'];

	if (($promoType == 'Percent') && ($amountOff >= 1)) {
    	$amountOff =  str_replace("%", "", $amountOff);
		$amountOff = $amountOff/100;
	}

	$cond1 = "";
	$cond2 = "";
	$cond3 = "";
	$cond4 = "";
	$cond5 = "";
	$whereCondition = "";

	if(isset($promoCode) && ($promoCode != "")){
		$cond1 = "PromoCode = '".$promoCode."'";
	}
	if(isset($name) && ($name != "")){
		$cond2 = "Name = '".$name."'";
	}
	if(isset($description) && ($description != "")){
		$cond3 = "Description = '".$description."'";
	}
	if(isset($amountOff) && ($amountOff != "")){
		$cond4 = "AmountOff = ".$amountOff."";
	}
	if(isset($promoType) && ($promoType != "---")){
		$cond5 = "PromoType = '".$promoType."'";
	}

	if($cond1 != ""){
		$whereCondition = $whereCondition.$cond1;
	}
	if($cond2 != ""){
		if(strlen($whereCondition) > 1){
			$whereCondition = $whereCondition." AND ".$cond2;
		}
		else{
			$whereCondition = $whereCondition.$cond2;
		}
	}
	if($cond3 != ""){
		if(strlen($whereCondition) > 1){
			$whereCondition = $whereCondition." AND ".$cond3;
		}
		else{
			$whereCondition = $whereCondition.$cond3;
		}
	}
	if($cond4 != ""){
		if(strlen($whereCondition) > 1){
			$whereCondition = $whereCondition." AND ".$cond4;
		}
		else{
			$whereCondition = $whereCondition.$cond4;
		}
	}
	if($cond5 != ""){
		if(strlen($whereCondition) > 1){
			$whereCondition = $whereCondition." AND ".$cond5;
		}
		else{
			$whereCondition = $whereCondition.$cond5;
		}
	}
	if($cond6 != ""){
		if(strlen($whereCondition) > 1){
			$whereCondition = $whereCondition." AND ".$cond6;
		}
		else{
			$whereCondition = $whereCondition.$cond6;
		}
	}

	$promo_search_sql = "SELECT PromoCode, Name, Description, AmountOff, PromoType FROM Promotion WHERE $whereCondition";
	
	//Construct SQL statements
	$promoResult = mysql_query($promo_search_sql);
	//Test whether the queries were successful
	if (!$promoResult) {
     $promo_search_message = "The retrieval of items was unsuccessful: ";
  }
	
	$number_promo_rows = mysql_num_rows($promoResult);
	// Check if results turned out empty
	$promo_search_message = "";
	if ($number_promo_rows == 0) {
	  $promo_search_message = "No items found in database";
	}
	
	//Display the results
  displayItemsPromotions($promo_search_message, $promoResult, $eventCode,
  	$eventName);
  //Free the result sets
	mysql_free_result($promoResult);
}

function displayItemsPromotions($promo_search_message, $promoResult, 
	$eventCode, $eventName) {
	    
	  echo <<<EOD
	<p>$promo_search_message</p>
	<input type="hidden" name="eventCode" value="$eventCode">
	<input type="hidden" name="eventName" value="$eventName">
  <tr>
		<th></th>
		<th><b>Promo Code</b></th>
		<th><b>Name</b></th>
		<th><b>Description</b></th>
		<th><b>Amount Off</b></th>
		<th><b>Promotion Type</b></th>
  </tr>
EOD;
		
		while ($row = mysql_fetch_assoc($promoResult)) {
    		$promoCode = $row['PromoCode'];
    		$name = $row['Name'];
    		$description = $row['Description'];
    		$amountOff = $row['AmountOff'];
    		$promoType = $row['PromoType'];
	
			echo "<tr>";
			if (isDuplicatePromotion($promoCode)) {
				echo "<td title='Promotion is already in the ad event'><input type='checkbox' disabled='true' name='promos[]' value=$promoCode></td>";
			} else {
				echo "<td><input type='checkbox' name='promos[]' value=$promoCode></td>";
			}
	  echo <<<EOD
	  			<td>$promoCode</td>
      			<td>$name</td>
				<td>$description</td>
				<td>$amountOff</td>
				<td>$promoType</td>			
		</tr>
EOD;
	}
}

function isDuplicatePromotion($promoCode) {
	$eventCode = $_POST['eventCode'];
	$checkPromotionStatement = "SELECT PromoCode FROM AdEventPromotion WHERE EventCode = '$eventCode'";
	$promoResult = mysql_query($checkPromotionStatement);
	while ($row = mysql_fetch_assoc($promoResult)) {
		if ($row['PromoCode'] == $promoCode) {
			return true;
		}	
	}
	return false;
}

?>
</table>
	<p>			
		<button class="button" onclick="goBack()">Back</button>
		<button type="submit" name="submit" value="Submit" accesskey="S" class="button">Submit</button>
	</p></form>
	<p><br/><a href="index.html"><button name="menu" class="button">Return to Main Menu</button></a></p>
	</center>
</body>
</html>