<?php
require('item_update_selection_view.php');
require('db_connect.inc');
get_all_items();

//-------------------------------------------------------------
function get_all_items()
{
	connect_and_select_db(DB_SERVER, DB_UN, DB_PWD,DB_NAME);

	$itemnumber = $_POST['itemnumber'];
	$itemdescription = $_POST['itemdescription'];
	$category = $_POST['category'];
	$department = $_POST['department'];
        
	// Create a String consisting of the SQL command. Remember that
        // . is the concatenation operator. $varname within double quotes
 	// will be evaluated by PHP
	$selectStmt = "SELECT Itemnumber, Itemdescription, Category, Departmentname, Purchasecost, Fullretailprice 
               FROM Item
               WHERE Itemnumber = '$itemnumber' OR
			   Itemdescription = '$itemdescription' OR
			   Category = '$category' OR 
			   Departmentname = '$department'";

	//Execute the query. The result will just be true or false
	$result = mysql_query($selectStmt);

	$message = "";

	//Test whether the query was successful
	if (!$result)
	{
		echo "The retrieval was unsuccessful: ".mysql_error();
		exit;
	}

	//$result is non-empty. So count the rows
	$numrows = mysql_num_rows($result);

	//Create an appropriate message
	$message = "";
	if ($numrows == 0)
		$message = "No items found in database";
	  
	//Display the results
	show_all_items($message, $result);

	//Free the result set
	mysql_free_result($result);
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