<?php

function ui_show_promotion_insert_result($message, $name, $description, 
		$amountOff, $promoType)
{
  //----------------------------------------------------------
  // Start the html page
  echo "<HTML>";
  echo "<HEAD>";
  echo "</HEAD>";
  echo "<BODY>";

  // If the message is non-null and not an empty string print it
  // message contains the lastname and firstname
  if ($message)
  {
    if ($message != "")
       {
	 echo '<center><font color="blue">'.$message.'</font></center><br />';
       }
	else{
		echo 'error';
	}
  }

//finish up the html code, and put the return button to go back to main menu

echo  "<BR/>";
echo "<BR/>";
echo  "<center>";
echo  "<input type="button" value="Return to Main Menu" onClick="window.location='index.html'"/>";
echo  "</center>";


 echo "</BODY>";
 echo "</HTML>";
}
?>