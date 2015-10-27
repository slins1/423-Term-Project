<?php

require('promotion_cn.inc');

//require('promotion_insert_result_ui.inc');

insert_adEvent();

function insert_adEvent(){

	connect_and_select_db(DB_SERVER, DB_UN, DB_PWD,DB_NAME);


	
	$eventCode = $_POST['eventCode'];
	$name = $_POST['name'];
	$startDate = $_POST['startDate'];
	$endDate = $_POST['endDate'];
	$description = $_POST['description'];
	$type = $_POST['type'];
	
	
	
	$insertStmt = "INSERT INTO AdEvent (EventCode, Name, StartDate, EndDate, Description, AdType) values ( '$eventCode', '$name', '$startDate', '$endDate','$description',
                      '$type')";

	//Execute the query. The result will just be true or false
	$result = mysql_query($insertStmt);

	$message = "";

	if (!$result) 
	{
  	  $message = "Error in inserting ad event: $name , $description: ";
	}
	else
	{
	  $message = "The ad event $name was inserted successfully.";
	  
	}

	ui_show_promotion_insert_result($message, $eventCode, $name, $startDate, $endDate, $description,
                      $type);
			   
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

function ui_show_promotion_insert_result($message, $eventCode, $name, $startDate, $endDate, $description,
                      $type)
{
  //----------------------------------------------------------
  // Start the html page
  echo '<HTML>';
  echo '<HEAD>';
  echo '</HEAD>';
  echo '<BODY>';

  // If the message is non-null and not an empty string print it
  // message contains the lastname and firstname
  if ($message)
  {
    if ($message != "")
       {
	 echo '<center><font color="blue">'.$message.'</font></center><br />';
       }
	else{
		echo 'error';
	}
  }

//finish up the html code, and put the return button to go back to main menu

echo  '<BR/>';
echo '<BR/>';
echo  '<center>';
echo  '<a href="index.html"><input type="button" value="Return to Main Menu"/></a>';
echo  '</center>';


 echo '</BODY>';
 echo '</HTML>';
}

?>