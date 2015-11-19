<!DOCTYPE html>
<html>
  <head>
      <link rel="stylesheet" href="jquery-ui.css">
			<script src="//code.jquery.com/jquery-1.10.2.js"></script>
			<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
      <script src="_script.js"></script>
      <link rel="stylesheet" type="text/css" href="_main.css">
      <link rel="images/logo_favicon.jpg" href="/favicon.ico"/>        
      <title>Aptaris - Advertisement Event System</title>
      
      <div class="header"><a href="index.html">
			<img src="images/logo_100.jpg" alt="logo" />
			<h1>Advertisement Event System - Update an Ad Event</h1></a>
			<br/><hr/>
		</div>
  </head>
  
<body>
	<center>
<?php
require ('db_connect.inc');
connect();
//Update ad event in the database
updateAdEvent();

function updateAdEvent() {
	$eventCode = $_POST['eventCode'];
	$oldCode = $_POST['code'];
	$name = $_POST['name'];
	$description = $_POST['description'];
	$startDate = $_POST['startDate'];
	$endDate = $_POST['endDate'];
	$eventType = $_POST['eventType'];
	
	$updateStatement = "Update AdEvent SET EventCode = '".$eventCode."', Description = '".$description."', Name = '".$name."', StartDate = '".$startDate."', EndDate = '".$endDate."', EventType = '".$eventType."' WHERE EventCode = '".$oldCode."'";
	// Execute the query--it will return either true or false
	$result = mysql_query($updateStatement);
	$message = "";
	if(!$result) {
		$message = "Error in updating Ad Event: $eventCode, $description";
	} else {
		$message = "Data for Event Code: $eventCode updated successfully";
	}
	showItemUpdateResult($message, $eventCode, $description, $name, $startDate, $endDate, $eventType);
}

function showItemUpdateResult($message, $eventCode, $description, $name, $startDate, $endDate, $eventType) {

  // If the message is non-null and not an empty string print it
  // message contains the lastname and firstname
  if ($message) {
    if ($message != "") {
      echo "<h2>$message</h2><br />";
    } else {
			echo "<p>Error</p>";
		}
  }
}
?>
<p>
	<a href="index.html"><button name="menu" accesskey="R" class="button">Return to Main Menu</button></a>
	<a href="update_ad_event_search_view.html"><button name="update"  accesskey="S" class="button">Update another ad event</button></a>
</p>
</center>
</body>
</html>
