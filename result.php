<?php 
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">

<!-- Declaring the doctype of the web pages which is XHTML Strict 1.0 -->

<head> 
<title></title>
<link type="text/css" rel="stylesheet" href="css/stylesheet.css" /> <!-- links to the css stylesheet that the website is using--> 
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
</head>

<body>

<div class="container">

<div class = "header"></div> <!-- close header -->
<div class = "menu"></div> <!-- close menu --> 
<div class = "resultarea">

<?php

	echo "<table border='1'>
	<tr>
	<th>Wine ID</th>
	<th>Wine Name</th>
	<th>Wine Year</th>
	<th>Wine Variety</th>
	<th>Winery Name</th>
	<th>Region Name</th>
	<th>Cost In Inventory</th>
	<th>Total Stock Sold</th>
	<th>Total Wine Sales</th>
	</tr>";

	foreach($_SESSION['queryresult'] as $row)
	{
  		echo"<tr>";
  		foreach($row as $cell) 
		{
    			echo("<td>" . $cell . "</td>");
  		}
  		echo"</tr>";
	}
	echo "</table>";

?>


</div> <!-- close contentarea -->
<div class = "footer"></div> <!-- close footer -->

</div> <!-- close container -->
</html>


