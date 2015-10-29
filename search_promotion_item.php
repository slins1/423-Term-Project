<?php
require('db_connect.inc');
session_start();

// Main control logic
get_items_and_promotions();

//------------------------------------------------------
function get_items_and_promotions()
{

  // Connect to db
  connect_and_select_db(DB_SERVER, DB_UN, DB_PWD, DB_NAME);

	$promoCode = $_POST['promoCode'];
	$promoName = $_POST['promoName'];

  //Construct SQL statements
		$promotion_search_sql = "SELECT PromoCode, Name, Description, AmountOff, PromoType
			FROM Promotion
			WHERE PromoCode = '$promoCode'
			AND	 Name = '$promoName'";

  //Execute the queries
	$promotionResult = mysql_query($promotion_search_sql);

  //Test whether the queries were successful
	if (!$promotionResult)
  {
     $promotion_search_message = "The retrieval of promotions was unsuccessful: ".mysql_error();
  }

	$number_promotion_rows = mysql_num_rows($promotionResult);


  // Check if results turned out empty

	$promotion_search_message = "";
	if ($number_promotion_rows == 0)
	  $promotion_search_message = "No promotions found in database";

  //Display the results
  display_items_promotions($promotion_search_message, $promotionResult);

  //Free the result sets
	mysql_free_result($promotionResult);
}
  function connect_and_select_db($server, $username, $pwd, $dbname)
  {
  	// Connect to db server
  	$conn = mysql_connect($server, $username, $pwd);

  	if (!$conn) {
  	    echo "Unable to connect to DB: " . mysql_error();
      	    exit;
  	}

  	// Select the database
  	$dbh = mysql_select_db($dbname);
  	if (!$dbh){
      		echo "Unable to select ".$dbname.": " . mysql_error();
  		exit;
  	}
  }

function display_items_promotions($promoMessage, $promoResult)
{
  //----------------------------------------------------------
  // Start the html page
  echo "<html>";
  echo "<head>";
  echo "</head>";
  echo "<body>";
  echo "<table>";
  echo "<form action='item_search.html' method='post'>";
  echo "<h2>Please Click submit to confirm the Promotion Or Click back to go back</h2>";

  // If the error messages are non-null and not an empty string print it

  $row = mysql_fetch_assoc($promoResult);


    $promoCode = $row['PromoCode'];
    $name = $row['Name'];
    $description = $row['Description'];
    $amountOff = $row['AmountOff'];
    $promoType = $row['PromoType'];

      echo '<tr>';
                echo '<td>';
                echo "<input type='checkbox' name='promo' value=$promoCode>";
                echo '</td>';
                echo '<td>';
                echo "NAME: $name";
                echo '</td>';
                echo '<td>';
                echo "DESCRIPTION: $description";
                echo '</td>';
                echo '<td>';
                echo "AMOUNT OFF: $amountOff";
                echo '</td>';
                echo '<td>';
                echo "PROMO TYPE: $promoType";
                echo '</td>';
                echo "</tr>"; 
  
echo "</table>";

  echo <<<UPTOEND
  <p>
    <button type="submit" name="submit" value="Submit" accesskey="S">
      <u>S</u>ubmit</button>
    <button type="reset" name="reset" accesskey="R">
      <u>R</u>eset</button>
  </p>
UPTOEND;
echo "</form>";
  echo "</body>";
  echo "</html>";
}


?>
