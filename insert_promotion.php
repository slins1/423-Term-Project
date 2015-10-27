<?php

require('db_connect.inc');

//require('promotion_insert_result_ui.inc');

insert_promotion();

function insert_promotion(){

	connect_and_select_db(DB_SERVER, DB_UN, DB_PWD,DB_NAME);
	
	$name = $_POST['name'];
	$description = $_POST['description'];
	$amountOff = $_POST['amountOff'];
	$promoType = $_POST['promoType'];
	
	$insertStmt = "INSERT INTO Promotion (Name, Description, AmountOff, 
		       PromoType) values ( '$name', '$description',
                      '$amountOff', '$promoType')";

	//Execute the query. The result will just be true or false
	$result = mysql_query($insertStmt);

	$message = "";

	if (!$result) {
  	  $message = "Error in inserting Promotion: $name , $description: ";
	} else {
	  $message = "The Promotion $name was inserted successfully.";
	}

	ui_show_promotion_insert_result($message, $name, $description, 
		$amountOff, $promoType);
			   
}

function connect_and_select_db($server, $username, $pwd, $dbname) {

	// Connect to db server
	$conn = mysql_connect($server, $username, $pwd);

	if (!$conn) {
	    echo "Unable to connect to DB: ";
    	exit;
	}

	// Select the database	
	$dbh = mysql_select_db($dbname);
	if (!$dbh){
    		echo "Unable to select ".$dbname.": ";
		exit;
	}
}

function ui_show_promotion_insert_result($message, $name, $description, 
		$amountOff, $promoType) {

  // Start the html page
  $head = <<<EOD 
            <html>
                <head>
                </head>
                <body>
EOD;

echo $head;

  // If the message is non-null and not an empty string print it
  // message contains the lastname and firstname
  if ($message) {
    if ($message != "") {
			echo '<center><font color="blue">'.$message.'</font></center><br />';
    } else {
			echo 'error';
		}
  }

//finish up the html code, and put the return button to go back to main menu

$foot = <<<EOD
	<br/>
	<br/>
	<center>
	<a href="index.html"><input type="button" value="Return to Main Menu"/></a>
</center>

</body>
</html>

EOD;

echo $foot;
}

?>