<?php
require('db_connect.inc');
require('search_promotion_item_result_view2.inc');

// Main control logic
get_items_and_promotions();

//------------------------------------------------------
function get_items_and_promotions()
{

  // Connect to db
  connect_and_select_db(DB_SERVER, DB_UN, DB_PWD, DB_NAME);

	$itemNumber = $_POST['itemNumber'];
	$category = $_POST['category'];

  //Construct SQL statements
		$item_search_sql = "SELECT ItemNumber, ItemDescription, Category, DepartmentName, PurchaseCost, FullRetailPrice
			FROM Item
			WHERE ItemNumber = '$itemNumber'
			AND	 Category = '$category'";

  //Execute the queries
	$itemResult = mysql_query($item_search_sql);

  //Test whether the queries were successful
	if (!$itemResult)
  {
     $item_search_message = "The retrieval of items was unsuccessful: ".mysql_error();
  }

	$number_item_rows = mysql_num_rows($itemResult);


  // Check if results turned out empty

	$item_search_message = "";
	if ($number_item_rows == 0)
	  $item_search_message = "No items found in database";

  //Display the results
  display_items_promotions($item_search_message, $itemResult);

  //Free the result sets
	mysql_free_result($itemResult);
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
