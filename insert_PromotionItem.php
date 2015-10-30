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

<?php
require('db_connect.inc');
insert_promotionItem();
function insert_promotionItem(){
$promoCode = $_POST['promoCode'];
$amountOff = $_POST['amountOff'];
$promoType = $_POST['promoType'];
connect(DB_SERVER, DB_UN, DB_PWD, DB_NAME);
//echo "<b>In the beginning</b><br/>";
//$username = $_POST['username'];
//echo "<span>username = $username</span><br/>";
if (isset($_POST['saleItems'])){
  //echo "Jeff Mitchell was here";
  $itemArray = $_POST['saleItems'];
  $arraySize = count($itemArray);
   //echo 'Array size = '.$arraySize.'';
        for ($k = 0; $k < $arraySize; $k++){
        	$current_item = $itemArray[$k];
        	$item_search_sql ="SELECT ItemNumber, FullRetailPrice FROM Item WHERE ItemNumber = '$current_item'";
        	$itemResult = mysql_query($item_search_sql);
        	if (!$itemResult)
  			{
     			$item_search_message = "The retrieval of items was unsuccessful";
  			}
			$number_item_rows = mysql_num_rows($itemResult);
  // Check if results turned out empty
	$item_search_message = "";
	if ($number_item_rows == 0)
	  $item_search_message = "No items found in database";
        	
	$row = mysql_fetch_assoc($itemResult);
	$itemNumber = $row['ItemNumber'];
	$fullRetailPrice = $row['FullRetailPrice'];
        	//$promoCode = $_SESSION['promoCode'];
        	//$amountOff = $_SESSION['amountOff'];
        	//$promoType = $_SESSION['promoType'];
        	//echo"This is the promoCode: $promoCode";
        	if($promoType == "Dollar"){
        		$salePrice = $fullRetailPrice - $amountOff;
        	}
        	else if($promoType == "Percent"){
        		$salePrice = $fullRetailPrice * $amountOff;
        	}
        	$insertStatement = "INSERT INTO PromotionItem (PromoCode,
        		ItemNumber, SalePrice) VALUES ('".$promoCode."','".
        		$itemNumber."', '".$salePrice."')";
			//echo "$insertStatement";
			
			$result = mysql_query($insertStatement);
			if (!$result) {
  			$message = "Error in inserting Promotion: $name , $description";
			} else {
	  		$message = "The Promotion $name was inserted successfully";
			} 
			//echo "Ryan is the greatest";
        }
}
//echo "<b> Ryan messed up</b>";

echo "A message $message";
$footer = <<<EOD
			<br/>
		<br/>
    <a href="index.html"><input type="button" value="Return to Main Menu"/></a>
    </body>
	</html>
EOD;
	echo $footer;
	//session_destroy();
}
?>