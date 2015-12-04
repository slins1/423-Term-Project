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
		<h1>Advertisement Event System - Update Promotion</h1></a><br/><hr/>
	</div>
</head>

<body>
<center>
<form action='update_promotion_view.php' method='post'>
<h2>Please check the promotion you would like to update</h2>
<table>


<?php
require('db_connect.inc');
connect();

searchPromotionsForUpdate();

function searchPromotionsForUpdate() {

	$promoCode = $_POST['promoCode'];
	$promotionName = $_POST['name'];
	$promotionDescription = $_POST['description'];
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
	if(isset($promotionName) && ($promotionName != "")){
		$cond2 = "Name LIKE '%".$promotionName."%'";
	}
	if(isset($promotionDescription) && ($promotionDescription != "")){
		$cond3 = "Description LIKE '%".$promotionDescription."%'";
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

	$promotion_search_sql = "SELECT * FROM Promotion WHERE $whereCondition";
	$promotionResult = mysql_query($promotion_search_sql);
	//Test whether the queries were successful
	if (!$promotionResult) {
     $promotion_search_message = "The retrieval of promotions was unsuccessful: ";
  }
	
	$number_promotion_rows = mysql_num_rows($promotionResult);
	// Check if results turned out empty
	$promotion_search_message = "";
	if ($number_promotion_rows == 0) {
	  $promotion_search_message = "No promotions found in database";
	}
		
	//Display the results
  displayPromotions($promotion_search_message, $promotionResult);
  //Free the result sets
	mysql_free_result($promotionResult);
}

function displayPromotions($promotion_search_message, $promotionResult) {
	    
	  echo <<<EOD
	<p>$promotion_search_message</p>
  <tr>
  	<th></th>
  	<th><b>Promo Code</b></th>
  	<th><b>Name</b></th>
  	<th><b>Description</b></th>
  	<th><b>Amount Off</b></th>
  	<th><b>Promo Type</b></th>
  </tr>
EOD;
		
		while ($row = mysql_fetch_assoc($promotionResult)) {
		
		$promoCode = $row['PromoCode'];
		$promoDescription = $row['Description'];
		$promoName = $row['Name'];
		$amountOff = $row['AmountOff'];
		$promoType = $row['PromoType'];
	
	  echo '<tr>';
				echo "<td><input type='radio' name='row[]' value='". implode(',', $row) ."'></td>";
				echo "<td>$promoCode</td>";
				echo "<td>$promoName</td>";
				echo "<td>$promoDescription</td>";
				echo "<td>$amountOff</td>";
				echo "<td>$promoType</td>";
			echo '</tr>';

	}

}
?>
</table>
	<p>			
		<button class="button" onclick="goBack()">Back</button>
		<button type="submit" name="submit" value="Submit" accesskey="S" class="button">Submit</button>
	</p>
	</form>
	</center>
</body>
</html>
