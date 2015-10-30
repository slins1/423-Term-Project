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
       
    <table border="1">
      <tr>
        <td>Category:</td>
         <td><select name="category" id="category">
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
				</td>
    </tr>
  </table>
  
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
