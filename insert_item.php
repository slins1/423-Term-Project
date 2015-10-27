<?php
require ('db_connect.inc');
require ('item_insert_result_view.inc');

insert_item();
// Main control logic

function insert_item();
{
		// Connect to the database
		connect_and_select_db(DB_SERVER, DB_UN, DB_PWD, DB_NAME);
		
		// Get information entered into form
		$itemNum = $_POST['itemNum'];
		$description = $_POST['description'];
		$category = $_POST['category'];
		$deptName = $_POST['deptName'];
		$purchaseCost = $_POST['purchaseCost'];
		$retailPrice = $_POST['retailPrice'];
		
		// Create an SQL Insert statement
		$insertStmt = "insert Item (ItemNumber, ItemDescription,
			Category, DepartmentName, PurchaseCost, FullRetailPrice)
			values ( '$itemNum', '$description', '$category', '$deptName',
			'$purchaseCost', '$retailPrice')";
			
		// Execute the query--it will return either true or false
		$result = mysql_query($insertStmt);
		
		$message = "";
		
		if(!$result)
		{
			$message = "Error in inserting Item: $itemNum: ".mysql_error;
		}
		else
		{
			$message = "Data for Item: $itemNum inserted successfully";
		}
		
		view_show_item_insert_result($message, $itemNum, $description, $category,
			$deptName, $purchaseCost, $retailPrice);
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