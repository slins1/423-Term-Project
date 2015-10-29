<?php


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
    $_SESSION['promoCode'] = $promoCode;
    $_SESSION['amountOff'] = $amountOff;
    $_SESSION['promoType'] = $promoType;

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
echo "</form>";
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
