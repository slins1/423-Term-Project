<?php
$part1 = <<<EOD
<html>
	<head>
		<title>Modify an Item</title>
		<style type="text/css">
			td {
				vertical-align: bottom
			}
		</style>
	</head>
	<body>
		<h2>Modify an Item</h2>
		<form action="update_item_modify.php" method="post" name="updateitem" id="updateitem">
			<table>
				<tr>
					<td>Item Number</td>
					<td>: <input type="text" name="itemNum" id="itemNum" size="7" value="
EOD;

$part2 = <<<EOD
					"/></td>
				</tr>
				<tr>
					<td>Item Description</td>
					<td>: <textarea maxlength="50" rows="3" cols="10" name="description" id="description" value =
EOD;
$part3 = <<<EOD
					">(Maximum 50 characters)</textarea></td>
				</tr> 
				<tr>
					<td>Category</td>
					<td>:
						<select name="category" id="category" slected = "					
EOD;
$part4 = <<<EOD
						">
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
				<tr>
					<td>Department Name</td>
					<td>:
						<select name="deptName" id="deptName" selected="
EOD;

$part5 = <<<EOD
						">
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
					</td>
				</tr> 
				<tr>
					<td>Purchase Cost</td>
					<td>: <input type="text" name="purchaseCost" id="purchaseCost" size="10" value = "
EOD;

$part6 = <<<EOF
					"/></td>
				</tr>
				<tr>
					<td>Full Retail Price</td>
					<td>: <input type="text" name="retilPrice" id="retailPrice" size="10" value = 
					
EOF;
$part7 = <<<EOD
					"/></td>
				</tr>
			</table>
		</form>
	</body>
</html>
EOD;
$itemnumber = $row['ItemNumber']; 
$description = $row['Description']; 
$category = $row['Category']; 
$department = $row['Department']; 
$cost = $row['Cost']; 
$retail = $row['Retail']; 
echo $part1;
echo $itemnumber;
echo $part2;
echo $description;
echo $part3;
echo $category;
echo $part4;
echo $department;
echo $part5;
echo $cost;
echo $part6;
echo $retail;
echo $part7;
?>
