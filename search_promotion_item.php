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
			<h1>Advertisement Event System</h1></a>
			<br/><hr/>
		</div>
  </head>
  
  <table>
  <form action='item_search.html' method='post'>
	<h2>Please Click submit to confirm the Promotion Or Click back to go back</h2>
	
<?php
require('db_connect.inc');
session_start();

// Connect to db
connect(DB_SERVER, DB_UN, DB_PWD, DB_NAME);

$promoCode = $_POST['promoCode'];
$promoName = $_POST['promoName'];

//Construct SQL statements
$insertStatement = "SELECT PromoCode, Name, Description, AmountOff, PromoType FROM Promotion WHERE PromoCode = '$promoCode' AND	 Name = '$promoName'";

//Execute the queries
$result = mysql_query($insertStatement);

//Test whether the queries were successful
if (!$result) {
   $message = "The retrieval of promotions was unsuccessful";
}

$numberPromotionRows = mysql_num_rows($result);

// Check if results turned out empty
$message = "";
if ($numberPromotionRows == 0) {
  $message = "No promotions found in database";
}

//Display the results
displayItemsPromotions($message, $result);

//Free the result sets
mysql_free_result($result);

function displayItemsPromotions($promoMessage, $promoResult) {

  $row = mysql_fetch_assoc($promoResult);
  $promoCode = $row['PromoCode'];
  $name = $row['Name'];
  $description = $row['Description'];
  $amountOff = $row['AmountOff'];
  $promoType = $row['PromoType'];

  echo <<<EOD
  	<p>$promoMessage</p>
    <tr>
			<td><input type='checkbox' name='promo' value='$promoCode'></td>
      <td>Name: $name</td>
			<td>Description: $description</td>
			<td>Amount Off: $amountOff</td>
			<td>Promotion Type: $promoType</td>
		</tr>
EOD;

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