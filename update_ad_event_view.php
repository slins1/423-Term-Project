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
		<h1>Advertisement Event System - Update an Ad Event</h1></a><br/><hr/>
	</div>
</head>

<body>
<center>
<form action='' method='post'>
<h2></h2>
<table>
<tr>
	<th></th>
	<th>Name</th>
	<th>Start Date</th>
	<th>End Date</th>
	<th>Description</th>
	<th>Ad Type</th>
</tr>
<?php
require('db_connect.inc');
connect();

fetchAdEvents();

function fetchAdEvents() {
	$eventCode = $_POST['EventCode'];
	$name = $_POST['Name'];
	$startDate = $_POST['StartDate'];
	$endDate = $_POST['EndDate']; 
	$description = $_POST['Description'];
	$adType = $_POST['AdType'];
	
	//Construct SQL statements
	$selectStatement = "SELECT EventCode, Name, StartDate, EndDate, Description, AdType FROM AdEvent";
	
	$result = mysql_query($selectStatement);
	//Test whether the queries were successful
	if (!$result) {
     $message = "The retrieval of items was unsuccessful";
  }
	
	$numRows = mysql_num_rows($result);
	// Check if results turned out empty
	$message = "";
	if ($numRows == 0) {
	  $message = "No items found in database";
	}
	
	//Display the results
  displayAdEvents($message, $result, $eventCode, $name, $startDate, $endDate, $description, $adType);
  //Free the result sets
	mysql_free_result($result);
}

function displayAdEvents($message, $result, $eventCode, $name, $startDate, $endDate, $description, $adType) {

	echo <<<EOD
	<p>$message</p>
	<input type="hidden" name="eventCode" value="$eventCode">
  <input type="hidden" name="name" value="$name">
  <input type="hidden" name="startDate" value="$startDate">
  <input type="hidden" name="endDate" value="$endDate">
  <input type="hidden" name="description" value="$description">
  <input type="hidden" name="adType" value="$adType">
EOD;
		
		while ($row = mysql_fetch_assoc($result)) {
		
			$eventCode = $row['EventCode'];
			$name = $row['Name'];
			$startDate = $row['StartDate'];
			$endDate = $row['EndDate'];
			$description = $row['Description'];
			$adType = $row['AdType'];
		
		  echo <<<EOD
		  	<tr>
					<td><button>Edit</button>
					<td>$name</td>
					<td>$startDate</td>
					<td>$endDate</td>
					<td>$description</td>
					<td>$adType</td>
				</tr>
EOD;

	}

}
?>
</table>
	<p>			
		<button type="reset" name="reset" accesskey="R" class="button">Reset</button>
		<button type="submit" name="submit" value="Submit" accesskey="S" class="button">Submit</button>
	</p>
	</form>
	</center>
</body>
</html>