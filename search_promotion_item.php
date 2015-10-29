<?php
require('db_connect.inc');
require('search_promotion_item_result_view.inc');

// Main control logic
get_items_and_promotions();

//------------------------------------------------------
function get_items_and_promotions()
{

  // Connect to db
  connect_and_select_db(DB_SERVER, DB_UN, DB_PWD, DB_NAME);

	$itemDepartment = $_POST['itemDepartment'];
	$itemNumber = $_POST['itemNumber'];
	$itemDescription = $_POST['itemDescription'];
	$promoCode = $_POST['promoCode'];
	$promoName = $_POST['promoName'];
	$promoDescription = $_POST['promoDescription'];

  //Construct SQL statements
  $item_search_sql = "SELECT DepartmentName, ItemNumber, ItemDescription, PurchaseCost
			FROM Item
			WHERE DepartmentName = '$itemDepartment'
			AND   ItemNumber = '$itemNumber'
			AND	 ItemDescription = '$itemDescription'";


		$promotion_search_sql = "SELECT PromoCode, Name, Description, AmountOff, PromoType
			FROM Promotion
			WHERE PromoCode = '$promoCode'
			AND	 Name = '$promoName'
			AND   Description = '$promoDescription'";

  //Execute the queries
  $itemResult =   mysql_query($item_search_sql);
	$promotionResult = mysql_query($promotion_search_sql);

  //Test whether the queries were successful
  if (!$itemResult)
  {
     $item_search_message = "The retrieval of items was unsuccessful: ".mysql_error();
  }
	if (!$promotionResult)
  {
     $promotion_search_message = "The retrieval of promotions was unsuccessful: ".mysql_error();
  }

  $number_item_rows = mysql_num_rows($itemResult);
	$number_promotion_rows = mysql_num_rows($promotionResult);


  // Check if results turned out empty
	$item_search_message = "";
	if ($number_item_rows == 0)
		$item_search_message = "No items found in database";

	$promotion_search_message = "";
	if ($number_promotion_rows == 0)
	  $promotion_search_message = "No promotions found in database";

  //Display the results
  display_items_promotions($item_search_message, $itemResult, $promotion_search_message, $promotionResult);

  //Free the result sets
  mysql_free_result($itemResult);
	mysql_free_result($promotionResult);

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

}

?>
