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

<body> 
<?php
require('db_connect.inc');
connect();
    $eventCode = $_POST['adEvent'];
    $adEvent_search_sql = "SELECT Name FROM AdEvent WHERE EventCode = '$eventCode'";
    $adEventResult = mysql_query($adEvent_search_sql);
    $row = mysql_fetch_assoc($adEventResult);
    $eventName = $row['Name'];
?>
	<center>  
    <form action='search_promotion_for_adEvent.php' method='post' onsubmit="">
        
    <h2>Search for a Promotion to add to the Ad Event <?php echo "$eventName";?>:</h2>
    <h4>At least one field is required</h4>
    <table>
      <tr>
        <td><p><b>Promo Code:</b></td>
        <td><input type="text" name="promoCode" id="promoCode" placeholder="Enter a Promo Code"></p><span id="errorItemNum" class="error"></span>
        <span id="successItemNum" class="correct"></span></td>
      </tr>
      <tr>
        <td><p><b>Name:</b></td>
        <td><input type="text" name="name" id="name" placeholder= "Enter a Name"></p><span id="errorItemNum" class="error"></span>
        <span id="successItemNum" class="correct"></span></td>
      </tr>
      <tr>
        <td><p><b>Description:</b></td>
        <td><input type="text" name="description" id="description" placeholder="Enter a Description"></p><span id="errorItemNum" class="error"></span>
        <span id="successItemNum" class="correct"></span></td>
      </tr>
      <tr>
        <td><p><b>Amount Off:</b></td>
        <td><input type="text" name="amountOff" id="amountOff" placeholder="Enter an Amount off"></p><span id="errorItemNum" class="error"></span>
        <span id="successItemNum" class="correct"></span></td>
      </tr>
      <tr>
        <td><p><b>Promotion Type:</b></td>
        <td><div class="dropDown"><select name="promoType" id="promoType">
	            <option>---</option>
	            <option>Dollar</option>
	            <option>Percent</option>
	            </select></div>
         </p></td>
      </tr>
</table>
        
<?php
  echo <<<EOD
    <input type="hidden" name="eventCode" value="$eventCode">
    <input type="hidden" name="eventName" value="$eventName">
EOD;
?>

<p>			
	<button type="reset" name="reset" accesskey="R" class="button">Reset</button>
	<button type="submit" name="submit" value="Submit" accesskey="S" class="button">Submit</button>
</p>
</form>
	<p><br/><a href="index.html"><button name="menu" class="button">Return to Main Menu</button></a></p>
</center>
</body>
</html>
