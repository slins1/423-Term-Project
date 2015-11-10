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
    <p><b>Item Number:</b></p>
        <input type="text" name="itemNumber" id="itemNumber"
        placeholder="Enter an Item Number">
    <p><b>Item Description:</b></p>
        <input type="text" name="itemDescription" id="itemDescription"
        placeholder="Enter an Item Description">
    <p><b>Category:</b></p>
        <select name="category" id="category">
            <option>---</option>
            <option>ACCESSORIES/FOOTWEAR</option>
            <option>BASIC APPAREL</option>
            <option>CHILDRENS APPAREL</option>
            <option>ELECTRONICS/PREPAID</option>
            <option>FOOD CONVENIENCE</option>
            <option>FOOD GROCERY</option>
            <option>HEALTH/BEAUTY</option>
            <option>HOME DECOR</option>
            <option>HOUSEHOLD PRODUCTS</option>
            <option>HOUSEWARES</option>
            <option>MENS APPAREL</option>
            <option>MISCELLANEOUS</option>
            <option>OFFICE/PARTY</option>
            <option>SEASONAL MERCHANDISE</option>
            <option>SOFT HOME</option>
            <option>SUPPLIES</option>
            <option>TOYS</option>
            <option>WOMENS APPAREL</option>
        </select>
        <p><b>Department Name</b></p>
        <select name="departmentName" id="departmentName">
            <option>---</option>
            <option>ACCESSORIES</option>
            <option>FOOTWEAR</option>
            <option>CHILDRENS BASICS</option>
            <option>LADIES BASICS</option>
            <option>MENS BASICS</option>
            <option>BOYS APPAREL</option>
            <option>GIRLS APPAREL</option>
            <option>NEWBORN INF TODDLR</option>
            <option>ELECTRONICS</option>
            <option>PPD PRODUCT/SERVICE</option>
            <option>ADULT BEVERAGE</option>
            <option>BREAD</option>
            <option>CANDY</option>
            <option>REFRIGERATED</option>
            <option>TOBACCO</option>
            <option>COOKIES/CRACKERS</option>
            <option>GROCERY</option>
            <option>PREPARED FOOD</option>
            <option>READY TO DRINK BEV</option>
            <option>SALTY SNACKS</option>
            <option>WAREHOUSE BEVERAGES</option>
            <option>ACUTE HEALTH CARE</option>
            <option>BABY CARE</option>
            <option>BATH/BODY</option>
            <option>BEAUTY CARE</option>
            <option>CHRONIC HEALTH CARE</option>
            <option>HAIR CARE</option>
            <option>ORAL CARE</option>
            <option>PERSONAL CARE</option>
            <option>ROUTINE HEALTH</option>
            <option>HOME DECOR</option>
            <option>AUTOMOTIVES</option>
            <option>DISP BAG/WRAP/TABLE</option>
            <option>HARDWARE</option>
            <option>HOUSEHOLD CLEANING</option>
            <option>HOUSEHOLD PAPER</option>
            <option>LAUNDRY CARE</option>
            <option>PET</option>
            <option>HOUSEWARES</option>
            <option>MENS APPAREL</option>
            <option>MISCELLANEOUS</option>
            <option>PARTY/CARD SHOP</option>
            <option>SCHOOL/OFFICE SUPPLY</option>
            <option>LAWN AND GDN/PATIO</option>
            <option>SEASONAL</option>
            <option>BATH</option>
            <option>BEDDING</option>
            <option>FLOORING</option>
            <option>KITCHEN</option>
            <option>WINDOW</option>
            <option>SUPPLIES</option>
            <option>TOYS</option>
            <option>LADIES BOTTOMS</option>
            <option>LADIES TOPS</option>
            <option>PLUS BOTTOMS</option>
            <option>PLUS TOPS</option>
            <option>SLEEPWEAR/SCRUBS</option>
        </select>
        <p><b>Purchase Cost:</b></p>
        <input type="text" name="purchaseCost" id="purchaseCost"
        placeholder="Enter a Purchase Cost">
        <p><b>Full Retail Price:</b></p>
        <input type="text" name="fullRetailPrice" id="fullRetailPrice"
        placeholder="Enter a Full Retial Price">
        
  
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
