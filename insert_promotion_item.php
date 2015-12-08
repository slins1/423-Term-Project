<?php

require('db_connect.inc');

insert_promotion_item();

function insert_promotion_item(){

	connect_and_select_db(DB_SERVER, DB_UN, DB_PWD,DB_NAME);

	$itemId = $_POST['itemId'];
	$promotionId = $_POST['promotionId'];
	$salePrice = $_POST['salePrice'];

	$insertStatement = "INSERT INTO Promotion-Item (PromoCode, ItemNumber, SalePrice,
		       PromoType) values ( '$promotionId', '$itemId',
                      '$salePrice')";

	//Execute the query. The result will just be true or false
	$result = mysql_query($insertStatement);

	$message = "";

	if (!$result) {
  	  $message = "Error in inserting Promotion: $promotionId , with Item: $itemId: ";
	} else {
	  $message = "The Promotion $promotionId with Item $itemId was inserted successfully.";
	}

	ui_show_promotion_item_insert_result($message, $promotionId, $itemId,
		$salePrice);

}

function connect_and_select_db($server, $username, $pwd, $dbname) {

	// Connect to db server
	$conn = mysql_connect($server, $username, $pwd);

	if (!$conn) {
	    echo "Unable to connect to DB: ";
    	exit;
	}

	// Select the database
	$dbh = mysql_select_db($dbname);
	if (!$dbh){
    		echo "Unable to select ".$dbname.": ";
		exit;
	}
}

function ui_show_promotion_insert_result($message, $promotionId, $itemId,
		$salePrice) {

  // Start the html page
  $head = <<<EOD
            <html>
                <head>
                </head>
                <body>
EOD;

echo $head;

  // If the message is non-null and not an empty string print it
  // message contains the lastname and firstname
  if ($message) {
    if ($message != "") {
			echo '<center><font color="blue">'.$message.'</font></center><br />';
    } else {
			echo 'error';
		}
  }

//finish up the html code, and put the return button to go back to main menu

$foot = <<<EOD
	<br/>
	<br/>
	<center>
	<button class="button" onclick="goBack()">Back</button>
	<a href="index.html"><input type="button" value="Return to Main Menu"/></a>
</center>

</body>
</html>

EOD;

echo $foot;
}

?>
