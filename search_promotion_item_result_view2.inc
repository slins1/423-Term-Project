<?php

function display_items_promotions($itemMessage, $itemResult)
{
  //----------------------------------------------------------
  // Start the html page
  echo "<html>";
  echo "<head>";
  echo "</head>";
  echo "<body>";
  echo "<table>";
  echo "<form action='insert_PromotionItem.php' method='post'>";
  echo "<h2>Please Click submit to confirm the adds of all items to the promotion</h2>";

  // If the error messages are non-null and not an empty string print it

  $row = mysql_fetch_assoc($itemResult);


    $itemNumber = $row['ItemNumber'];
    $itemDescription = $row['ItemDescription'];
    $category = $row['Category'];
    $departmentName = $row['DepartmentName'];
    $purchaseCost = $row['PurchaseCost'];
    $fullRetailPrice = $row['FullRetailPrice'];

while ($row = mysql_fetch_assoc($itemResult)){

      echo '<tr>';
                echo '<td>';
                echo "<input type='checkbox' name='items[]' value=$itemNumber>";
                echo '</td>';
                echo '<td>';
                echo "ITEM DESCRIPTION: $itemDescription";
                echo '</td>';
                echo '<td>';
                echo "CATEGORY: $category";
                echo '</td>';
                echo '<td>';
                echo "DEPARTMENT NAME: $departmentName";
                echo '</td>';
                echo '<td>';
                echo "PURCHASE COST: $purchaseCost";
                echo '</td>';
                echo '<td>';
                echo "FULL RETAIL PRICE: $fullRetailPrice";
                echo '</td>';
                echo "</tr>"; 
}
  
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
