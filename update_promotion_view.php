<html>
<head>
        <link rel="stylesheet" href="jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script src="_script.js"></script>
        <script type="text/javascript" src="validate_promotion_insert.js"></script>
        <link rel="stylesheet" type="text/css" href="_main.css">
        <link rel="icon" type="image/png" href="favicon.png">
        <title>Aptaris - Advertisement Event System</title>

        <div class="header"><a href="index.html">
                <img src="images/logo_100.jpg" alt="logo" />
                <h1>Advertisement Event System - Update Promotion</h1></a><br/><hr/>
        </div>
</head>
<body>
        <center>
    <form action='update_promotion.php' method='post' name="addPromotion" id="addPromotion" onsubmit="return validate_promotion();">

    <h2>Update a Promotion:</h2>
    <table border="1" cellpadding="5">

<?php
$row = $_POST['row'];
$implode = implode(',',$row);
$explode = explode(',', $implode);
$promoCode = $explode[0];
$promoName = $explode[1];
$promoDescription = $explode[2];
$amountOff = $explode[3];
$promoType = $explode[4];


echo <<<EOD
			<tr>
				<td align="left">Promotion Name:</td>
EOD;
				echo '<td align="center"><input type="text" name="promoName" id="promoName" maxlength="25" size="80" value = "'.$promoName.'"><span id="errorPromoName" class="error"></span>
                  <span id="successPromoName" class="correct"></span></td>';
echo <<<EOD
			</tr>
			<tr>
				<td align="left">Description:</td>
EOD;
				echo '<td align="center"><input type="text" name="promoDescription" id="promoDescription" maxlength="100" size="80" value="'.$promoDescription.'"><span id="errorPromoDescription" class="error"></span>
                  <span id="successPromoDescription" class="correct"></span></td>';
echo <<<EOD
			</tr>
			<tr>
				<td align="left">Amount Off:</td>
EOD;
				echo '<td align="center"><input type="text" name="amountOff" id="amountOff" maxlength="10" size="80" value="'.$amountOff.'"><span id="errorAmountOff" class="error"></span>
                  <span id="successAmountOff" class="correct"></span></td>';
echo <<<EOD
			</tr>
			<tr>
				<td align="left">Promo Type:</td>
				<td><div class="dropDown"><select name="promoType" id="promoType" maxlength="10">
EOD;
                        echo '<option selected>'.$promoType.'</option>';

echo <<<EOD
				<option>Dollar</option>
				<option>Percent</option>
				</select></div>
				</td>
EOD;
echo <<<EOD
			</tr>
		</table>
EOD;
echo '<input type="hidden" name="promoCode" id="promoCode" value="'.$promoCode.'">';
?>		
<p>	
        	<button class="button" onclick="goBack()">Back</button>
		<button type="reset" name="reset" accesskey="R" class="button">Reset</button>
		<button type="submit" name="submit" value="Submit" accesskey="S" class="button">Submit</button>
</p></form>
	<p><br/><a href="index.html"><button name="menu" class="button">Return to Main Menu</button></a></p>
	</center>
</body>
</html>
