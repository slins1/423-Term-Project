<?php
require('db_connect.inc');

insert_promotionItem();

function insert_promotionItem(){

connect_and_select_db(DB_SERVER, DB_UN, DB_PWD, DB_NAME);

echo "<b>In the beginning</b><br/>";
$username = $_POST['username'];
echo "<span>username = $username</span><br/>";

if (isset($_POST['saleItems'])){

  //echo "Jeff Mitchell was here";
  $itemArray = $_POST['saleItems'];
  $arraySize = count($itemArray);

   echo 'Array size = '.$arraySize.'';

        for ($k = 0; $k < $arraySize; $k++){

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
        	echo"This is the promoCode: $promoCode";

        	if($promoType == "Dollar"){
        		$salePrice = $fullRetailPrice - $amountOff;
        	}
        	else if($promoType == "Percent"){
        		$salePrice = $fullRetailPrice * $amountOff;
        	}
        	$insertStatement = "INSERT INTO PromotionItem (PromoCode,
        		ItemNumber, SalePrice) VALUES ('".$promoCode."','".
        		$itemNumber."', '".$salePrice."')";

			echo "$insertStatement";

			/*
			$result = mysql_query($insertStatement);

			if (!$result) {
  			$message = "Error in inserting Promotion: $name , $description";
			} else {
	  		$message = "The Promotion $name was inserted successfully";
			} */
			echo "Ryan is the greatest";
        }


}
echo "<b> Ryan messed up</b>";
echo "<html>";
echo "$message";
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