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
  echo "<html>";

	// If the message is non-null and not an empty string print it
  // message contains the lastname and firstname
  if ($message) {
    if ($message != "") {
			echo "<center><font color='blue'>$message</font></center><br />";
    } else {
			echo "<p>Error</p>";
		}
  }

	//finish up the html code, and put the return button to go back to main menu
	$footer = <<<EOD
			<br/>
		<br/>
    <a href="index.html"><input type="button" value="Return to Main Menu"/></a>
    </body>
	</html>
EOD;

	echo $footer;
}

?>