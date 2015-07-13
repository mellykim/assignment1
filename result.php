<?php 
session_start();
?>

<!DOCTYPE html>
<!-- Declaring the doctype of the web pages which is XHTML Strict 1.0 -->

<head>
<title>Winestore Database Results</title>
<link type="text/css" rel="stylesheet" href="css/stylesheet.css" /> <!-- links to the css stylesheet that the website is using-->
<meta charset="UTF-8">
</head>

<body>

<div class="container">

<div class = "header"></div> <!-- close header -->
<div class = "menu"></div> <!-- close menu --> 
<div class = "resultarea">

<h1>Search Results</h1>

<?php

$count = count($_SESSION['queryresult']);
echo "<p>Total search records fitting your criteria: " . $count . "</p>";

	echo "<table>
	<tr>
	<th>Wine Name</th>
	<th>Wine Year</th>
	<th>Wine Variety</th>
	<th>Winery Name</th>
	<th>Region Name</th>
	<th>Cost In Inventory</th>
	<th>Total Stock Sold</th>
	<th>Total Wine Sales</th>
	<th>Total Wine On Hand </th>
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


