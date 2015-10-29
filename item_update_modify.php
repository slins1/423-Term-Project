<?php

require('db_connect.inc');

require('item_update_result_view.php');

update_item();

function update_item(){

	connect_and_select_db(DB_SERVER, DB_UN, DB_PWD,DB_NAME);

	$itemnumber = $_POST['ItemNumber']; 
	$description = $_POST['Description']; 
	$category = $_POST['Category']; 
	$department = $_POST['Department']; 
	$cost = $_POST['Cost']; 
	$retail = $_POST['Retail'];
	
	$updateStmt = "UPDATE Item Set ItemNumber='".$itemnumber."' ,description='".$description."', category='".$category."', 
	department = '".$department."',cost=".$cost."',retail='".$retail."' WHERE ItemNumber='".$itemnumber."';";

	//Execute the query. The result will just be true or false
	$result = mysql_query($updateStmt);

	$message = "";

	if (!$result) 
	{
  	  $message = "Error in updating item: $itemnumber , $description: ";
	}
	else
	{
	  $message = "The item $itemnumber was updated successfully.";
	  
	}

	ui_show_item_update_result($message, $itemnumber, $description, $category, $department, $cost,
                      $retail);
			   
}

function connect_and_select_db($server, $username, $pwd, $dbname)
{
	//echo "inside connect!";
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

?>