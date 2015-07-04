<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">

<!-- Declaring the doctype of the web pages which is XHTML Strict 1.0 -->

<head> 
<title></title>
<link type="text/css" rel="stylesheet" href="stylesheet.css" /> <!-- links to the css stylesheet that the website is using--> 
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
</head>

<body>

<div class="container">

<div class = "header"></div> <!-- close header -->
<div class = "menu"></div> <!-- close menu --> 
<div class = "contentarea">


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
<th>*Wine Cost</th>
<th>*On Hand</th>
</tr>";

while ($row = $result->fetch(PDO::FETCH_ASSOC))
{
        echo "<tr>";
        echo "<td>".$row['wine_id']."</td>";
        echo "<td>".$row['wine_name']."</td>";
        echo "<td>".$row['year']."</td>";
        echo "<td>".$row['varieties']."</td>";
        echo "<td>".$row['winery_name']."</td>";
        echo "<td>".$row['region_name']."</td>";
        echo "<td>".$row['Inventorycost']."</td>";
        echo "<td>".$row['Stocksold']."</td>";
        echo "<td>".$row['revenue']."</td>";
        echo "<td>".$row['cost']."</td>";
        echo "<td>".$row['on_hand']."</td>";
        echo "</tr>";

}



</div> <!-- close contentarea -->
<div class = "footer"></div> <!-- close footer -->

</div> <!-- close container -->
</html>

