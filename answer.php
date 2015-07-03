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

<?php
require_once('php/db.php');
$pdo = new PDO('mysql:host=localhost;dbname=winestore', DB_USER, DB_PW);
if (!pdo){echo "Please try later";
          die("Could Not Connect");}

$wine = $_GET["winename"];
$winery = $_GET["wineryname"];
$region = $_GET["region"];
$grapevariety = $_GET["grapevariety"];
$minyear = $_GET["minyear"];
$maxyear = $_GET["maxyear"];
$minstock = $_GET["minwinesinstock"];
$minorder = $_GET["minwinesordered"];
$dollarrangelow = $_GET["mincost"];
$dollarrangemax = $_GET["maxcost"];


//if (empty($wine)){$wine = "%";}
//if (empty($winery)){$winery = "%";}
//if (empty($region)){$region = "%";}
//if (empty($grapevariety)){$grapevariety = "%";}


$query = "
SELECT DISTINCT w.wine_id, w.wine_name, w.year, v.varieties, y.winery_name, r.region_name, i.Inventorycost, j.Stocksold, j.revenue
        FROM wine w
        INNER JOIN
        	(SELECT a.wine_id, GROUP_CONCAT(DISTINCT variety SEPARATOR '|') as Varieties
        	from wine a
        	INNER JOIN wine_variety b ON a.wine_id=b.wine_id
        	INNER JOIN grape_variety c ON b.variety_id=c.variety_id
        	GROUP BY a.wine_id
        	) v ON v.wine_id = w.wine_id
	INNER JOIN 
		(SELECT e.wine_id, SUM(d.on_hand * d.cost) AS Inventorycost
		 FROM wine e
		 INNER JOIN inventory d ON e.wine_id = d.wine_id
		 GROUP BY e.wine_id
		) i on i.wine_id = w.wine_id
	INNER JOIN
		(SELECT f.wine_id, SUM(g.qty) AS Stocksold, SUM(g.price) AS revenue
		FROM wine f
		INNER JOIN items g ON f.wine_id = g.wine_id
		GROUP BY f.wine_id
		) j on j.wine_id = w.wine_id

        INNER JOIN winery y ON w.winery_id = y.winery_id
        INNER JOIN region r ON y.region_id = r.region_id
	WHERE w.year >= '$minyear'
";

$statement = array();
if (!empty($wine)) {$statement[] = "w.wine_name ='$wine'"     ; };
 
if (count($statement) > 0)
{
	$query .= ' AND ' .implode(' AND ', $statement);
}

$query .= ';';
    

$result = $pdo->query($query);
$result->execute();

//echo $query;

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
	echo "</tr>";	

}


?>

</div> <!-- close contentarea -->
<div class = "footer"></div> <!-- close footer -->

</div> <!-- close container -->
</html>

