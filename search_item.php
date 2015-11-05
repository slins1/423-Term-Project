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

<body> 
	<center>  
    <form action='search_item_for_promotion.php' method='post' onsubmit="return validateCategory(this)">
        
    <h2>Search for a Item to add the promotion to:</h2>
    <h3>Please Select a Type to Search by:</h3>
                <select name="searchType" id="searchType">
                    <option>Item Number</option>
                    <option>Item Description</option>
                    <option>Category</option>
                    <option>Department Name</option>
                    <option>Purchase Cost</option>
                    <option>Full Retail Price</option>
                </select>
    <br/></br/>
    <input type="text" name="searchData" id="searchData">
  
<?php
	$promoCode = $_POST['promoCode'];
	$amountOff = $_POST['amountOff'];
	$promoType = $_POST['promoType'];



  echo <<<EOD
    <input type="hidden" name="promoCode" value="$promoCode">
    <input type="hidden" name="amountOff" value="$amountOff">
    <input type="hidden" name="promoType" value="$promoType">
EOD;
?>

<p>			
		<button type="reset" name="reset" accesskey="R" class="button">Reset</button>
		<button type="submit" name="submit" value="Submit" accesskey="S" class="button">Submit</button>
	</p>
	</form>
	</center>
</body>
</html>
