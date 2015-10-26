<?php

function display_items_promotions($itemMessage, $itemResult, $promoMessage, $promoResult)
{
  //----------------------------------------------------------
  // Start the html page
  echo "<html>";
  echo "<head>";
  echo "</head>";
  echo "<body>";

  // If the error messages are non-null and not an empty string print it

  if ($itemMessage)
  {
    if ($itemMessage != "")
       {
	 echo $itemMessage;
   exit;
       }
  }

  if ($promoMessage)
  {
    if ($promoMessage != "")
       {
  echo $promoMessage;
  exit;
       }
  }
  echo '<form action='assign_promo_item.php' method='post'>'
  echo '<table border="1">';
  echo '<th>Selection</th>';
  echo '<th>Item Department</th>';
  echo '<th>Item Number</th>';
  echo '<th>Item Description</th>';
  echo '<thead>';
  echo '</thead>';
  echo '<tbody>';


   //While there are more rows in the result, get the next row
   //as an associative array
   while ($itemRow = mysql_fetch_assoc($itemResult))
   {
     $itemDepartment = $itemRow['itemDepartment'];
     $itemNumber = $itemRow['itemNumber'];
     $itemDescription = $itemRow['itemDescription'];

     //Put results in table rows. The htmlentities function converts any
     //special chars in the string to a html-displayable form.
      echo '<tr>';
      echo '<td><input type="radio" name="item" value='.$itemNumber.'></td>';
      echo '<td>'.htmlentities($itemDepartment).'</td>';
      echo '<td>'.htmlentities($itemNumber).'</td>';
      echo '<td>'.htmlentities($itemDescription).'</td>';
      echo '</tr>';
   }

   echo '</tbody>';
   echo '</table>';

	 echo '<table border="1">';
   echo '<th>Selection</th>';
	 echo '<th>Promo Code</th>';
	 echo '<th>Promo Name</th>';
	 echo '<th>Promo Description</th>';
	 echo '<thead>';
	 echo '</thead>';
	 echo '<tbody>';


		//While there are more rows in the result, get the next row
		//as an associative array
		while ($promoRow = mysql_fetch_assoc($promoResult))
		{
			$promoCode = $promoRow['promoCode'];
			$promoName = $promoRow['promoName'];
			$promoDescription = $promoRow['promoDescription'];

			 //Put results in table rows. The htmlentities function converts any
			 //special chars in the string to a html-displayable form.
			 echo '<tr>';
       echo '<td><input type="radio" name="promotion" value='.$promoCode.'></td>';
			 echo '<td>'.htmlentities($promoCode).'</td>';
			 echo '<td>'.htmlentities($promoName).'</td>';
			 echo '<td>'.htmlentities($promoDescription).'</td>';
			 echo '</tr>';
		}

		echo '</tbody>';
		echo '</table>';
    echo '</form>';

  echo <<<UPTOEND
  <p>
    <button type="submit" name="submit" value="Submit" accesskey="S">
      <u>S</u>ubmit</button>
    <button type="reset" name="reset" accesskey="R">
      <u>R</u>eset</button>
  </p>
UPTOEND;

  echo "</body>";
  echo "</html>";
}

?>
