<?php

function display_items_promotions($itemMessage, $itemResult, $promoMessage, $promoResult)
{
  //----------------------------------------------------------
  // Start the html page
  echo "<HTML>";
  echo "<HEAD>";
  echo "</HEAD>";
  echo "<BODY>";

  // If the message is non-null and not an empty string print it
  // message contains the lastname and firstname

  if ($itemMessage)
  {
    if ($itemMessage != "")
       {
	 echo '<center><font color="blue">'.$itemMessage.'</font></center><br />';
       }
  }
  echo '<table border="1" align="center" width="98%">';
  echo '<th width="20%">Item Department</th>';
  echo '<th width="20%">Item Number</th>';
  echo '<th width="10%">Item Description</th>';
  echo '<thead>';
  echo '</thead>';
  echo '<tbody>';


   //While there are more rows in the $result, get the next row
   //as an associative array
   while ($itemRow = mysql_fetch_assoc($itemResult))
   {
     $itemDepartment = $itemRow['itemDepartment'];
     $itemNumber = $itemRow['itemNumber'];
     $itemDescription = $itemRow['itemDescription'];

      //Put these in a table row. The htmlentities function converts any
      //special chars in the string to a html-displayable form.
      echo '<tr>';
      echo '<TD><SPAN ALIGN=CENTER>'.htmlentities($itemDepartment).'</SPAN></TD>';
      echo '<TD><SPAN ALIGN=CENTER>'.htmlentities($itemNumber).'</SPAN></TD>';
      echo '<TD><SPAN ALIGN=CENTER>'.htmlentities($itemDescription).'</SPAN></TD>';
      echo '</tr>';
   }

   echo '</TBODY>';
   echo '</table>';

	 // If the message is non-null and not an empty string print it
	 // message contains the lastname and firstname

	 if ($promoMessage)
	 {
		 if ($promoMessage != "")
				{
	 echo '<center><font color="blue">'.$promoMessage.'</font></center><br />';
				}
	 }
	 echo '<table border="1" align="center" width="98%">';
	 echo '<th width="20%">Promo Code</th>';
	 echo '<th width="20%">Promo Name</th>';
	 echo '<th width="10%">Promo Description</th>';
	 echo '<thead>';
	 echo '</thead>';
	 echo '<tbody>';


		//While there are more rows in the $result, get the next row
		//as an associative array
		while ($promoRow = mysql_fetch_assoc($promoResult))
		{
			$promoCode = $promoRow['promoCode'];
			$promoName = $promoRow['promoName'];
			$promoDescription = $promoRow['promoDescription'];

			 //Put these in a table row. The htmlentities function converts any
			 //special chars in the string to a html-displayable form.
			 echo '<tr>';
			 echo '<TD><SPAN ALIGN=CENTER>'.htmlentities($promoCode).'</SPAN></TD>';
			 echo '<TD><SPAN ALIGN=CENTER>'.htmlentities($promoName).'</SPAN></TD>';
			 echo '<TD><SPAN ALIGN=CENTER>'.htmlentities($promoDescription).'</SPAN></TD>';
			 echo '</tr>';
		}

		echo '</TBODY>';
		echo '</table>';


//finish up the html code, and put the return button to go back to main menu
  echo <<<UPTOEND
  <BR/><BR/>
  <center>
  <input type="button" value="Return to Main Menu"
	onClick="window.location='promo_item_assignment.html'"/>
  </center>
UPTOEND;

  echo "</BODY>";
  echo "</HTML>";
}

?>
