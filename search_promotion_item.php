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
		<h1>Advertisement Event System - Assign Item to a Promotion</h1></a><br/><hr/>
	</div>
</head>

  <center>
  <form action='search_item.php' method='post'>
	<h2>Please select a promotion and click submit to confirm, or click back to go back</h2>
	<table>
		<tr>
			<th></th>
			<th>Promo Code</th>
			<th>Promo Name</th>
			<th>Description</th>
			<th>Amount Off</th>
			<th>Promo Type</th>
		</tr>
<?php
require('db_connect.inc');

connect();

retrievePromotions();

function retrievePromotions() {
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
	

	$insertStatement = "SELECT PromoCode, Name, Description,
	AmountOff, PromoType FROM Promotion WHERE $whereCondition";
	//echo "$insertStatement";
	/*
	echo "$cond1";
	echo "$cond2";
	echo "$cond3";
	echo "$cond4";
	echo "$cond5";
*/
/*
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
	*/
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

	


	while ($row = mysql_fetch_assoc($promoResult)) {
    $promoCode = $row['PromoCode'];
    $name = $row['Name'];
    $description = $row['Description'];
    $amountOff = $row['AmountOff'];
    $promoType = $row['PromoType'];
    
echo '<input type="hidden" name="promoCode" value="'.$promoCode.'" >';
echo '<input type="hidden" name="amountOff" value="'.$amountOff.'" >';
echo '<input type="hidden" name="promoType" value="'.$promoType.'" >';

		echo <<<EOD
    <tr>
			<td><input type='radio' name='promo' value=$promoCode></td>
			<td>$promoCode</td>
      		<td>$name</td>
			<td>$description</td>
			<td>$amountOff</td>
			<td>$promoType</td>
		</tr>
	
EOD;
}





}
	
?>
	</table>
	<br/>
	<button class="button" onclick="goBack()">Back</button>
	<button type="submit" name="submit" value="Submit" accesskey="S" class="button">Submit</button>
	</form>
		</center>
  </body>
</html>