<?php
define('DB_SERVER', 'csdb.brockport.edu'); // database server
define('DB_UN', 'rconn4'); // Database username
define('DB_PWD', '1234'); // Database password
define('DB_NAME', 'rconn4_fall15_1'); // Database name

function connect() {
	// Connect to db server
	$conn = mysql_connect(DB_SERVER, DB_UN, DB_PWD);
	if (!$conn) {
	    echo "Unable to connect to DB: ";
    	    exit;
	}
	// Select the database	
	$dbh = mysql_select_db(DB_NAME);
	if (!$dbh) {
    		echo "Unable to select ".DB_NAME.": ";
		exit;
	}
}

?>
