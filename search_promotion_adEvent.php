<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="jquery-ui.css">
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script src="_script.js"></script>
	<link rel="stylesheet" type="text/css" href="_main.css">
	<link rel="icon" type="image/png" href="favicon.png">        
	<title>Aptaris - Advertisement Event System</title>
	
	<div class="header"><a href="index.html">
		<img src="images/logo_100.jpg" alt="logo" />
		<h1>Advertisement Event System - Assign Promotion to an Ad Event</h1></a><br/><hr/>
	</div>
</head>

  <center>
  <form action='search_Promotion.php' method='post'>
	<h2>Please select an Ad Event and click submit to confirm, or click back to go back</h2>
	<table>
		<tr>
		<th></th>
		<th><b>Event Code</b></th>
		<th><b>Name</b></th>
		<th><b>Start Date</b></th>
		<th><b>End Date</b></th>
		<th><b>Description</b></th>
		<th><b>Ad Type</b></th>
	</tr>
<?php
require('db_connect.inc');
connect();

retrieveAdEvent();

function retrieveAdEvent() {
	$eventCode = $_POST['eventCode'];
	$name = $_POST['name'];
	$startDateUnformatted = $_POST['startDate'];
	$endDateUnformatted = $_POST['endDate'];
	$description = $_POST['description'];
	$adType = $_POST['adType'];


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
		$cond1 = "EventCode = '".$eventCode."'";
	}
	if(isset($name) && ($name != "")){
		$cond2 = "Name = '".$name."'";
	}
	if(isset($startDate) && ($startDate != "--")){
		$cond3 = "StartDate = '".$startDate."'";
	}
	if(isset($endDate) && ($endDate != "--")){
		$cond4 = "EndDate = '".$endDate."'";
	}
	if(isset($description) && ($description != "")){
		$cond5 = "Description = '".$description."'";
	}
	if(isset($adType) && ($adType != "---")){
		$cond6 = "AdType = '".$adType."'";
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
	//echo "$whereCondition";

	$insertStatement = "SELECT EventCode, Name, StartDate, EndDate, 
	Description, AdType FROM AdEvent WHERE $whereCondition";
	//echo "$insertStatement";
	/*
	echo "$cond1";
	echo "$cond2";
	echo "$cond3";
	echo "$cond4";
	echo "$cond5";
*/
	//Construct SQL statements
	
	
	//Execute the queries
	$result = mysql_query($insertStatement);
	$numberAdEventRows = mysql_num_rows($result);

	//Test whether the queries were successful
	if (!$result || $numberAdEventRows == 0) {
	   $message = "The retrieval of Ad Events was unsuccessful";
	}
	//Display the results
	displayItemsPromotions($message, $result);
	
	//Free the result sets
	mysql_free_result($result);

}

function displayItemsPromotions($adEventMessage, $adEventResult) {

	


	while ($row = mysql_fetch_assoc($adEventResult)) {
    $eventCode = $row['EventCode'];
    $name = $row['Name'];
    $startDate = $row['StartDate'];
    $endDate = $row['EndDate'];
    $description = $row['Description'];
    $AdType = $row['AdType'];
    
//echo '<input type="hidden" name="promoCode[]" value=$promoCode>';
//echo '<input type="hidden" name="amountOff" value="'.$amountOff.'" >';
//echo '<input type="hidden" name="promoType" value="'.$promoType.'" >';

		echo <<<EOD
	
    <tr>
			<td><input type='radio' name='adEvent' value=$eventCode></td>
			<td>$eventCode</td>
      		<td>$name</td>
      		<td>$startDate</td>
      		<td>$endDate</td>
			<td>$description</td>
			<td>$AdType</td>
		</tr>
	
EOD;
}





}
	
?>
	</table>
	<br/>
	<p>
	<button class="button" onclick="goBack()">Back</button>
	<button type="submit" name="submit" value="Submit" accesskey="S" class="button">Submit</button>
<br/><br/><a href="index.html"><button name="menu" class="button">Return to Main Menu</button></a></p>
	</form>
		</center>
  </body>
</html>