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
		<h1>Advertisement Event System - Assign Promotion to an Ad Event</h1></a><br/><hr/>
	</div>
</head>

  <center>
  <form action='index.html' method='post'>

<?php
require('db_connect.inc');
connect();

retrieveAdEvent();

function retrieveAdEvent() {

	$startDateUnformatted = $_POST['startDate'];
	$endDateUnformatted = $_POST['endDate'];



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

	$whereCondition = "";

	if(isset($startDate) && ($startDate != "--")){
		$cond1 = "StartDate = '".$startDate."'";
	}
	if(isset($endDate) && ($endDate != "--")){
		$cond2 = "EndDate = '".$endDate."'";
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

	//echo "$whereCondition";

	$searchStatement = "SELECT EventCode, Name, StartDate, EndDate,
	Description, AdType FROM AdEvent WHERE $whereCondition";
	//echo "$searchStatement";

	//Construct SQL statements


	//Execute the queries
	$result = mysql_query($searchStatement);
	$numberAdEventRows = mysql_num_rows($result);

	//Test whether the queries were successful
	if (!$result || $numberAdEventRows == 0) {
	   $message = "The retrieval of Ad Events was unsuccessful";
	}
	//Display the results
	displayAdEvents($message, $result);


	//Free the result sets
	mysql_free_result($result);

}

function displayAdEvents($adEventMessage, $adEventResult) {




	while ($row = mysql_fetch_assoc($adEventResult)) {

    $eventCode = $row['EventCode'];
    $name = $row['Name'];
    $startDate = $row['StartDate'];
    $endDate = $row['EndDate'];
    $description = $row['Description'];
    $AdType = $row['AdType'];

    echo"<h2>Promotions associated with Ad Event: $name</h2>";

    $adEventPromoSearch = "SELECT ID, EventCode, PromoCode
    FROM AdEventPromotion Where EventCode = '$eventCode'";


    $adEventPromoResult = mysql_query($adEventPromoSearch);

    while($row2 = mysql_fetch_assoc($adEventPromoResult)){

    	$eventCode2 = $row2['EventCode'];
    	$id2 = $row2['ID'];
    	$promoCode2 = $row2['PromoCode'];


    	$promoSearch = "SELECT * FROM Promotion WHERE PromoCode = $promoCode2";

    	$promoResult = mysql_query($promoSearch);

    	while($row3 = mysql_fetch_assoc($promoResult)){

    		$promoCode3 = $row3['PromoCode'];
    		$promoName3 = $row3['Name'];
    		$promoDescription3 = $row3['Description'];
    		$amountOff3 = $row3['AmountOff'];
    		$promoType3 = $row3['PromoType'];



		echo <<<EOD
		<br/>
	<table>
    <tr>
		<td>Promo Code</td>
		<td>$promoCode3</td>
	</tr>
	<tr>
		<td> Name </td>
		<td>$promoName3</td>
	</tr>
	<tr>
		<td>Description</td>
		<td>$promoDescription3</td>
	</tr>
	<tr>
		<td>AmountOff</td>
		<td>$amountOff3</td>
	</tr>
	<tr>
		<td>Promo Type</td>
		<td>$promoType3</td>
	</tr>
	</table>
EOD;
    	}

    }

//echo '<input type="hidden" name="promoCode[]" value=$promoCode>';
//echo '<input type="hidden" name="amountOff" value="'.$amountOff.'" >';
//echo '<input type="hidden" name="promoType" value="'.$promoType.'" >';

}





}

?>
	<br/>

	<button type="submit" name="submit" value="Submit" accesskey="S" class="button">Back To Main Menu</button>
	</form>
	<br/>
		<button class="button" onclick="goBack()">Back</button>
		<a href="report_adEvent_view.html"><button name="insert" class="button">Run Another Report</button></a>
  </center>
  </body>
</html>
