<html>
<head>
        <link rel="stylesheet" href="jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script src="_script.js"></script>
        <script src="validate_ad_event.js" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="_main.css">
        <link rel="icon" type="image/png" href="favicon.png">
        <title>Aptaris - Advertisement Event System</title>

        <div class="header"><a href="index.html">
                <img src="images/logo_100.jpg" alt="logo" />
                <h1>Advertisement Event System - Update Ad Event</h1></a><br/><hr/>
        </div>
</head>
<body>
        <center>
    <form action='update_ad_event.php' name = "addEvent" id="addEvent" method="post" onsubmit="return validate_event();">

    <h2>Update an Ad Event:</h2>
	<table border="1">
<?php
$row = $_POST['row'];
$implode = implode(',',$row);
$explode = explode(',', $implode);
$eventCode = $explode[0];
$name = $explode[1];
$start = $explode[2];
$end = $explode[3];
$description = $explode[4];
$type = $explode[5];

$temp = "";
$startDates	= explode("-", $start); //[2015], [10], [28]
$startDatesReversed = array_reverse($startDates); //[28], [10], [2015]
$temp = $startDatesReversed[1]; //[28], [10], [2015]  t:[10]
$startDatesReversed[1] = $startDatesReversed[0]; //[28], [28], [2015] t:[10]
$startDatesReversed[0] = $temp; //[28], [28], [2015]
$startDate = implode("/", $startDatesReversed); //[10]/[28]/[2015]

$endDates	= explode("-", $end); //[2015], [10], [28]
$endDatesReversed = array_reverse($endDates); //[28], [10], [2015]
$temp = $startDatesReversed[1]; //[28], [10], [2015]  t:[10]
$endDatesReversed[1] = $endDatesReversed[0]; //[28], [28], [2015] t:[10]
$endDatesReversed[0] = $temp; //[28], [28], [2015]
$endDate = implode("/", $endDatesReversed); //[10]/[28]/[2015]

echo <<<EOD
		<tr>
                    <td align="left">EventCode:</td>
EOD;
                    echo '<td align="left"><input type="text" name="eventCode" id="eventCode" value="'.$eventCode.'" maxlength="25" size="30"><span id="errorEventCode" class="error"></span><span id="successEventCode" class="correct"></span></td>';
echo <<<EOD
                </tr>
                <tr>
                    <td align="left">Name:</td>
EOD;
                    echo '<td align="left"><input type="text" name="eventName" id="eventName" value="'.$name.'" maxlength="25" size="30"><span id="errorName" class="error"></span> <span id="successName" class="correct"></span></td>';
echo <<<EOD
                </tr>
                <tr>
                    <td align="left">Start Date:</td>
EOD;
                    echo '<td align="left"><input type="text" name="startDate" id="startDate" value="'.$startDate.'" maxlength="25" size="30"><span id="errorStartDate" class="error"></span> <span id="successStartDate" class="correct"></span></td>';
echo <<<EOD
                </tr>
                <tr>
                    <td align="left">End Date:</td>
EOD;
                    echo '<td align="left"><input type="text" name="endDate" id="endDate" value="'.$endDate.'" maxlength="25" size="30"><span id="errorEndDate" class="error"></span><span id="successEndDate" class="correct"></span></td>';
echo <<<EOD
                </tr>
                <tr>
                    <td align="left">Description:</td>
EOD;
                    echo '<td align="left"><input type="text" name="eventDescription" id="eventDescription" value="'.$description.'" maxlength="100" size="30"><span id="errorDescription" class="error"></span><span id="successDescription" class="correct"></span></td>';
echo <<<EOD
                </tr>
                <tr>
                    <td align="left">Type:</td>
                    <td align="left"><div class="dropDown"><select name="eventType" id="eventType">
EOD;
                        echo '<option selected>'.$type.'</option>';
echo <<<EOD
                        <option value="Planner">
                            Planner
                        </option>
                        <option value="Circular">
                            Circular
                        </option>
                        <option value="Passout">
                            Pass Out
                        </option>
                    </select></div></td>
                </tr>
            </table>
EOD;
echo '<input type="hidden" name="code" id="code" value="'.$eventCode.'">';
?>	
<p>
		<button class="button" onclick="goBack()">Back</button>
		<button type="submit" name="submit" value="Submit" accesskey="S" class="button">Submit</button>
</p></form>
	<p><br/><a href="index.html"><button name="menu" class="button">Return to Main Menu</button></a></p>
	</center>
</body>
</html>
