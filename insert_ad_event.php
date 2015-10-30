<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="jquery-ui.css">
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script src="_script.js"></script>
	<link rel="stylesheet" type="text/css" href="_main.css">
	<link rel="logo_favicon.jpg" href="/favicon.ico"/>        
	<title>Aptaris - Advertisement Event System</title>
	
	<div class="header"><a href="index.html">
		<img src="logo_100.jpg" alt="logo" />
		<h1>Advertisement Event System - Assign Promotion to an Item</h1></a><br/><hr/>
	</div>
</head>
<?php
require('db_connect.inc');

//Connect to the database
connect(DB_SERVER, DB_UN, DB_PWD,DB_NAME);
//Insert AdEvent into the database
insertAdEvent();

function insertAdEvent() {	
	$eventCode = $_POST['eventCode'];
	$name = $_POST['name'];
	$startDate = $_POST['startDate'];
	$endDate = $_POST['endDate'];
	$description = $_POST['description'];
	$type = $_POST['type'];
		
	$insertStatement = "INSERT INTO AdEvent (EventCode, Name, StartDate, EndDate, Description, AdType) values   ('$eventCode', '$name', '$startDate', '$endDate','$description','$type')";
	
	//Execute the query. The result will just be true or false
	$result = mysql_query($insertStatement);
	$message = "";
	if (!$result)  {
		$message = "Error in inserting ad event: $name , $description";
	} else {
	  $message = "The ad event $name was inserted successfully.";
	}
	
	//Show result
	showAdEventInsertResult($message, $eventCode, $name, $startDate, $endDate, $description, $type);
}
  
function showAdEventInsertResult($message, $eventCode, $name, $startDate, $endDate, $description, $type) {
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