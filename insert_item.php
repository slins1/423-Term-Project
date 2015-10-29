<?php
require ('db_connect.inc');

//Connect to the database
connect(DB_SERVER, DB_UN, DB_PWD,DB_NAME);
//Insert item into the database
insertItem();

function insertItem() {
	$itemNum = $_POST['itemNum'];
	$description = $_POST['description'];
	$category = $_POST['category'];
	$deptName = $_POST['deptName'];
	$purchaseCost = $_POST['purchaseCost'];
	$retailPrice = $_POST['retailPrice'];

	$insertStatement = "INSERT INTO Item (ItemNumber, ItemDescription, Category, DepartmentName, PurchaseCost, FullRetailPrice) values ( '$itemNum', '$description', '$category', '$deptName', '$purchaseCost', '$retailPrice')";
	
	// Execute the query--it will return either true or false
	$result = mysql_query($insertStatement);
	$message = "";
	if(!$result) {
		$message = "Error in inserting Item: $itemNum, $description";
	} else {
		$message = "Data for Item: $itemNum inserted successfully";
	}

	showItemInsertResult($message, $itemNum, $description, $category, $deptName, $purchaseCost, $retailPrice);
}

function showItemInsertResult($message, $itemNum, $description, $category, $deptName, $purchaseCost, $retailPrice) {
	// Start the html page
  echo "<html>";

  // If the message is non-null and not an empty string print it
  // message contains the lastname and firstname
  if ($message) {
    if ($message != "") {
      echo "<center><font color='blue'>$message</font></center><br />";
    } else {
			echo "<p>Error</p>";
		}
  }
  
	//finish up the html code, and put the return button to go back to main menu
	$footer = <<<EOD
			<br/>
		<br/>
    <a href="index.html"><input type="button" value="Return to Main Menu"/></a>
    </body>
	</html>
EOD;

	echo $footer;
}

?>