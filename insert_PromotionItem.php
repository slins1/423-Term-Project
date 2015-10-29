<?php
require('db_connect.inc');

insert_promotionItem();

function insert_promotionItem(){

connect_and_select_db(DB_SERVER, DB_UN, DB_PWD, DB_NAME);

if (isset($_POST['items'])){

  $itemArray = $_POST['items'];
  $arraySize = count($itemArray);

        for ($k = 0; $k < $arraysize; $k++){

        	$current_item = $itemArray[$k];

        	$item_search_sql ="SELECT ItemNumber, FullRetailPrice FROM Item 
        	WHERE ItemNumber = '$current_item'";

        	$itemResult = mysql_query($item_search_sql);

        	if (!$itemResult)
  			{
     			$item_search_message = "The retrieval of items was unsuccessful: ".mysql_error();
  			}

			$number_item_rows = mysql_num_rows($itemResult);


  // Check if results turned out empty

	$item_search_message = "";
	if ($number_item_rows == 0)
	  $item_search_message = "No items found in database";
        	
	$row = mysql_fetch_assoc($itemResult);
	$itemNumber = $row['ItemNumber'];
	$fullRetailPrice = $row['FullRetailPrice'];

        	$promoCode = $_SESSION['promoCode'];
        	$amountOff = $_SESSION['amountOff'];
        	$promoType = $_SESSION['promoType'];

        	if($promoType == "Dollar"){
        		$salePrice = $fullRetailPrice - $amountOff;
        	}
        	else if($promoType == "percent"){
        		$salePrice = $fullRetailPrice * $amountOff;
        	}
        	$insertStatement = "INSERT INTO PromotionItem (PromoCode,
        		ItemNumber, SalePrice) values ('$promoCode', 
        		'$itemNumber', 'salePrice')";
        }


}

echo "<html>";
  echo "<head>";
  echo	"<link rel='stylesheet' type='text/css' href='_main.css'>";
  echo  "<link rel='logo_favicon.jpg' href='/favicon.ico' />";
  echo  "</head>";
  echo  "<body>";
  echo  "<div class='header'><a href='index.html'>";
	echo	"<img src='logo_100.jpg' alt='logo' />";
	echo	"<h1>Promotion System - Add Item to a Promotion</h1></a><br/><hr />";
	echo "</div>";


echo "Inserted Items into ItemPromotion Successfully";
$footer = <<<EOD
			<br/>
		<br/>
    <a href="index.html"><input type="button" value="Return to Main Menu"/></a>
    </body>
	</html>
EOD;

	echo $footer;
	session_destroy();

}
function connect_and_select_db($server, $username, $pwd, $dbname)
  {
  	// Connect to db server
  	$conn = mysql_connect($server, $username, $pwd);

  	if (!$conn) {
  	    echo "Unable to connect to DB: " . mysql_error();
      	    exit;
  	}

  	// Select the database
  	$dbh = mysql_select_db($dbname);
  	if (!$dbh){
      		echo "Unable to select ".$dbname.": " . mysql_error();
  		exit;
  	}
  }


?>