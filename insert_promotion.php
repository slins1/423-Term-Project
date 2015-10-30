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
		<h1>Advertisement Event System</h1></a><br/><hr/>
	</div>
</head>

<body>
<center>

<?php
require('db_connect.inc');

//Connect to the database
connect(DB_SERVER, DB_UN, DB_PWD,DB_NAME);
//Insert promotion into the database
insertPromotion();

function insertPromotion() {
	$name = $_POST['name'];
	$description = $_POST['description'];
	$amountOff = $_POST['amountOff'];
	$promoType = $_POST['promoType'];
	
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
	// Start the html page
	echo "</div>";

	// If the message is non-null and not an empty string print it
  // message contains the lastname and firstname
  if ($message) {
    if ($message != "") {
			echo <<<EOD
			<h2 class = 'text-center'>$message</h2>
			<p class = 'text-center'>
					Description: $description<br/>
					Amount Off: $amountOff<br/>
					Promo Type: $promoType</p>
EOD;
    } else {
			echo "<h2>Error: $message</h2>";
		}
  }
}
?>

			<br/>
			<br/>
			<a href="index.html"><button class="button">Return to Main Menu</button></a>
			<a href="insert_promotion_view.html"><button class="button">Insert Another Promotion</button></a>
		</center>
  </body>
</html>