<?php

ui_show_new_promotion_page();

function ui_show_new_promotion_page(){

echo '<html>';
echo '<head>';
echo '<title> Add a Promotion page </title>';

echo '</head>';
echo '<body>';

echo '<FORM action="insert_promotion.php" method="post">';
echo '<center>';
echo '<table>';
echo  '<tr>';
echo    '<td align="left"> Name </td>';
echo    '<td align="left"> :<input type="text" name="name" id="name" maxlength=25 size=20></td>';
echo  '</tr>';
echo  '<tr>';
echo    '<td align="left"> Description </td>';
echo    '<td align="left"> :<input type="text" name="description" id="description" maxlength=100 size=35></td>';
echo  '</tr>';
echo  '<tr>';
echo    '<td align="left"> Amount Off </td>';
echo    '<td align="left"> :<input type="text" name="amountOff" id="amountOff" maxlength=10 size=5></td>';
echo  '</tr>';
echo  '<tr>';
echo    '<td align="left"> Promo Type </td>';
echo    '<td align="left"> :<input type="text" name="promoType" id="promoType" maxlength=10 size=5></td>';
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