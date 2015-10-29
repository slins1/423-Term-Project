<?php

function display_all_items($message, $result)
{
  //----------------------------------------------------------
  // Start the html page
  echo "<html>";
  echo "<HEAD>";
  echo "</HEAD>";
  echo "<body>";

  // If the message is non-null and not an empty string print it
  // message contains the lastname and firstname
  echo '<form action="item_update_modify.php" method="post" name="modifyitem" id="modifyitem"'
  if ($message)
  {
    if ($message != "")
       {
	 echo '<center><font color="blue">'.$message.'</font></center><br />';
       }
  }
  echo '<table border="1" align="center" width="98%">';
  echo '<th width="20%">Select Item</th>';
  echo '<th width="20%">Item Number</th>';
  echo '<th width="20%">Description</th>';
  echo '<th width="10%">Category</th>';
  echo '<th width="50%">Department</th>';
  echo '<th width="50%">Cost</th>';
  echo '<th width="50%">Retail</th>';
  echo '<thead>'; 
  echo '</thead>'; 
  echo '<tbody>'; 


   //While there are more rows in the $result, get the next row
   //as an associative array
   while ($row = mysql_fetch_assoc($result)) 
   {
     $itemnumber = $row['ItemNumber']; 
     $description = $row['Description']; 
     $category = $row['Category']; 
     $department = $row['Department']; 
	 $cost = $row['Cost']; 
	 $retail = $row['Retail'];  
 
      //Put these in a table row. The htmlentities function converts any
      //special chars in the string to a html-displayable form.
      echo '<tr>'; 
	  echo '<td><span align=center><input type = "radio" id = "selected" value = '.htmlentities($row).'></span></td>';
      echo '<td><span align=center>'.htmlentities($itemnumber).'</span></td>'; 
      echo '<td><span align=center>'.htmlentities($description).'</span></td>'; 
      echo '<td><span align=center>'.htmlentities($category).'</span></td>'; 
      echo '<td><span align=center>'.htmlentities($department).'</span></td>'; 
	  echo '<td><span align=center>'.htmlentities($cost).'</span></td>'; 
	  echo '<td><span align=center>'.htmlentities($retail).'</span></td>'; 
      echo '</tr>'; 
   } 
    
   echo '</tbody>'; 
   echo '</table>'; 
	echo '<button type = "submit">'
  echo "</body>";
  echo "</html>";
}

?>