<?php

ui_show_new_adEvent_page();

function ui_show_new_adEvent_page(){

echo '<html>';
echo '<head>';
echo '<title> Add an ad event page </title>';

echo '</head>';
echo '<body>';

echo '<FORM action="insert_adEvent.php" method="post">';
echo '<center>';
echo '<table>';
echo  '<tr>';
echo    '<td align="left"> EventCode </td>';
echo    '<td align="left"> :<input type="text" name="eventCode" id="eventCode" maxlength=25 size=20></td>';
echo  '</tr>';
echo  '<tr>';
echo    '<td align="left"> Name </td>';
echo    '<td align="left"> :<input type="text" name="name" id="name" maxlength=25 size=20></td>';
echo  '</tr>';
echo  '<tr>';
echo    '<td align="left"> Start Date </td>';
echo    '<td align="left"> :<input type="text" name="startDate" id="startDate" maxlength=25 size=20></td>';
echo  '</tr>';
echo  '<tr>';
echo    '<td align="left"> End Date </td>';
echo    '<td align="left"> :<input type="text" name="endDate" id="endDate" maxlength=25 size=20></td>';
echo  '</tr>';
echo  '<tr>';
echo    '<td align="left"> Description </td>';
echo    '<td align="left"> :<input type="text" name="description" id="description" maxlength=100 size=35></td>';
echo  '</tr>';
echo  '<tr>';
echo    '<td align="left"> Type </td>';
echo    '<td align="left"> :<input type="text" name="type" id="type" maxlength=10 size=5></td>';
echo  '</tr>';
echo '</table>';
echo '</center>';
echo '<center>';
echo '<button type="submit" value="submit"> Submit Information </button>';
echo '<button type="reset" value="reset"> Reset </button>';
echo '</center>';
echo '</form>';

echo '</body>';
echo '</html>';
}

?>