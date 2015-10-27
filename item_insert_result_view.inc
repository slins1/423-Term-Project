<?php

function view_show_item_insert_result($message, $itemNum, $description
	$category, $deptName, $purchaseCost, $retailPrice)
{
	echo "<html>";
	echo "<head>";
	echo "</head>";
	echo "<body>";
	
	if($message)
	{
		if($message != "")
		{
			echo $message;
			exit;
		}
	}
	
	echo <<<UPTOEND
		<p>
			<input type="button" name="menu" value="Return to Main Menu"
				onClick="window.location='index.html'"/>
		</p>
	UPTOEND;
	
	echo "</body>";
	echo "</html>";
}
?>