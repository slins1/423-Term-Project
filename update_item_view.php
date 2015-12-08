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
                <h1>Advertisement Event System - Update Item</h1></a><br/><hr/>
        </div>
</head>
<body>
        <center>
    <form action='update_item.php' method='post' onsubmit="">

    <h2>Update an Item:</h2>
    <p><b>Item Number:</b></p>

<?php
$row = $_POST['row'];
$implode = implode(',',$row);
$explode = explode(',', $implode);
$itemNumber = $explode[0];
$itemDescription = $explode[1];
$category = $explode[2];
$departmentName = $explode[3];
$purchaseCost = $explode[4];
$fullRetailPrice = $explode[5];
echo '<input type="text" name="itemNum" id="itemNum" value = "'.$itemNumber.'"><span id="errorItemNum" class="error"></span>
                  <span id="successItemNum" class="correct"></span>';
echo <<<EOD
    <p><b>Item Description:</b></p>
EOD;
echo '<input type="text" name="itemDescription" id="itemDescription" value = "'.$itemDescription.'"><span id="errorItemNum" class="error"></span>
                  <span id="successItemNum" class="correct"></span>';
echo <<<EOD
    <p><b>Category:</b></p>
EOD;
echo '<select name="category" id="category" selected = "'.$category.'">';
echo <<<EOD
            <option selected value="$category">$category</option>
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
EOD;
echo '<select name="departmentName" id="departmentName" selected="'.$departmentName.'">';
echo <<<EOD
            <option selected value="$departmentName">$departmentName</option>
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
<p>
EOD;
echo '<p><b>Purchase Cost:</b></p>';
echo '<input type="text" name="purchaseCost" id="purchaseCost" value="'.$purchaseCost.'"><span id="errorItemNum" class="error"></span>
                  <span id="successItemNum" class="correct"></span>';
echo '<p><b>Full Retail Price:</b></p>';
echo '<input type="text" name="fullRetailPrice" id="fullRetailPrice" value="'.$fullRetailPrice.'"><span id="errorItemNum" class="error"></span>
                  <span id="successItemNum" class="correct"></span>';
echo '<input type="hidden" name="itemNumber" id="itemNumber" value="'.$itemNumber.'">';
?>
		<button class="button" onclick="goBack()">Back</button>
		<button type="reset" name="reset" accesskey="R" class="button">Reset</button>
		<button type="submit" name="submit" value="Submit" accesskey="S" class="button">Submit</button>
	</p>
	</form>
	</center>
</body>
</html>
