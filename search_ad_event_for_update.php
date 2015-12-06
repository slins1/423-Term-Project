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
		<h1>Advertisement Event System - Update Ad Event</h1></a><br/><hr/>
	</div>
</head>

<body>
<center>
<form action='update_ad_event_view.php' method='post'>
<h2>Please check the ad event you would like to update</h2>
<table>


<?php
require('db_connect.inc');
connect();

searchAdEventsByCategory();

function searchAdEventsByCategory() {

	$eventCode = $_POST['eventCode'];
	$eventName = $_POST['name'];
	$startDateUnformatted = $_POST['startDate'];
	$endDateUnformatted = $_POST['endDate'];
	$description = $_POST['description'];
	$eventType = $_POST['eventType'];


	$temp = "";
	$startDates	= explode("/", $startDateUnformatted); //[10], [28], [2015]
	$startDatesReversed = array_reverse($startDates); //[2015], [28], [10]
	$temp = $startDatesReversed[1]; //[2015], [28], [10] t:[28]
	$startDatesReversed[1] = $startDatesReversed[2]; //[2015], [10], [10] t:[28]
	$startDatesReversed[2] = $temp; //[2015], [10], [28]
	$startDate = implode("-", $startDatesReversed); //2015-10-28


	
	$endDates	= explode("/", $endDateUnformatted);
	$endDatesReversed = array_reverse($endDates);
	$temp = $endDatesReversed[1];
	$endDatesReversed[1] = $endDatesReversed[2];
	$endDatesReversed[2] = $temp;
	$endDate = implode("-", $endDatesReversed);


	$cond1 = "";
	$cond2 = "";
	$cond3 = "";
	$cond4 = "";
	$cond5 = "";
	$cond6 = "";
	$whereCondition = "";

	if(isset($eventCode) && ($eventCode != "")){
		$cond1 = "EventCode LIKE '%".$eventCode."%'";
	}
	if(isset($description) && ($description != "")){
		$cond2 = "Description LIKE '%".$description."%'";
	}
	if(isset($eventName) && ($eventName != "")){
		$cond3 = "Name LIKE '%".$eventName."%'";
	}
	if(isset($startDate) && ($startDate != "--")){
		$cond4 = "StartDate = '".$startDate."'";
	}
	if(isset($endDate) && ($endDate != "--")){
		$cond5 = "EndDate = '".$endDate."'";
	}
	if(isset($eventType) && ($eventType != "---")){
		$cond6 = "AdType = '".$eventType."'";
	}

	if($cond1 != ""){
		$whereCondition = $whereCondition.$cond1;
	}
	if($cond2 != ""){
		if(strlen($whereCondition) > 1){
			$whereCondition = $whereCondition." AND ".$cond2;
		}
		else{
			$whereCondition = $whereCondition.$cond2;
		}
	}
	if($cond3 != ""){
		if(strlen($whereCondition) > 1){
			$whereCondition = $whereCondition." AND ".$cond3;
		}
		else{
			$whereCondition = $whereCondition.$cond3;
		}
	}
	if($cond4 != ""){
		if(strlen($whereCondition) > 1){
			$whereCondition = $whereCondition." AND ".$cond4;
		}
		else{
			$whereCondition = $whereCondition.$cond4;
		}
	}
	if($cond5 != ""){
		if(strlen($whereCondition) > 1){
			$whereCondition = $whereCondition." AND ".$cond5;
		}
		else{
			$whereCondition = $whereCondition.$cond5;
		}
	}
	if($cond6 != ""){
		if(strlen($whereCondition) > 1){
			$whereCondition = $whereCondition." AND ".$cond6;
		}
		else{
			$whereCondition = $whereCondition.$cond6;
		}
	}

	$ad_event_search_sql = "SELECT * FROM AdEvent WHERE $whereCondition";
	$eventResult = mysql_query($ad_event_search_sql);
	//Test whether the queries were successful
	if (!$eventResult) {
     $event_search_message = "The retrieval of ad events was unsuccessful: ";
  }
	
	$number_event_rows = mysql_num_rows($eventResult);
	// Check if results turned out empty
	$event_search_message = "";
	if ($number_event_rows == 0) {
	  $event_search_message = "No ad events found in database";
	}
	
	//Display the results
  displayEvents($event_search_message, $eventResult);
  //Free the result sets
	mysql_free_result($eventResult);
}

function displayEvents($event_search_message, $eventResult) {
	    
	  echo <<<EOD
	<p>$event_search_message</p>
  <tr>
  	<th></th>
  	<th><b>EVENT CODE</b></th>
  	<th><b>NAME</b></th>
  	<th><b>START DATE</b></th>
  	<th><b>END DATE</b></th>
  	<th><b>DESCRIPTION</b></th>
  	<th><b>AD TYPE</b></th>
  </tr>
EOD;
		
		while ($row = mysql_fetch_assoc($eventResult)) {
		
		$eventCode = $row['EventCode'];
		$name = $row['Name'];
		$startDate = $row['StartDate'];
		$endDate = $row['EndDate'];
		$description = $row['Description'];
		$type = $row['AdType'];
	
	  echo '<tr>';
				echo "<td><input type='radio' name='row[]' value='". implode(',', $row) ."'></td>";
				echo "<td>$eventCode</td>";
				echo "<td>$name</td>";
				echo "<td>$startDate</td>";
				echo "<td>$endDate</td>";
				echo "<td>$description</td>";
				echo "<td>$type</td>";
			echo '</tr>';

	}

}
?>
</table>
	<p>			
		<button class="button" onclick="goBack()">Back</button>
		<button type="submit" name="submit" value="Submit" accesskey="S" class="button">Submit</button>
</p></form>
	<p><br/><a href="index.html"><button name="menu" class="button">Return to Main Menu</button></a></p>
	</center>
</body>
</html>
