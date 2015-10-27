<?php

function ui_show_item_update_result($message, $itemnumber, $description, $category, $department, $cost, $retail){
  
  echo '<HTML>';
  echo '<HEAD>';
  echo '</HEAD>';
  echo '<BODY>';

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

echo  '<BR/>';
echo '<BR/>';
echo  '<center>';
echo  '<a href="index.html"><input type="button" value="Return to Main Menu"/></a>';
echo  '</center>';


 echo '</BODY>';
 echo '</HTML>';
?>