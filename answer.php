<?php
session_start();
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

$query = "SELECT DISTINCT w.wine_id, w.wine_name, w.year, v.varieties, y.winery_name, r.region_name, i.Inventorycost, i.cost, i.on_hand, j.Stocksold, j.revenue
        FROM wine w
        INNER JOIN
        	(SELECT a.wine_id, GROUP_CONCAT(DISTINCT variety SEPARATOR ' | ') as Varieties
        	from wine a
        	INNER JOIN wine_variety b ON a.wine_id=b.wine_id
        	INNER JOIN grape_variety c ON b.variety_id=c.variety_id
        	GROUP BY a.wine_id
        	) v ON v.wine_id = w.wine_id
	INNER JOIN 
		(SELECT e.wine_id, d.cost, d.on_hand, SUM(d.on_hand * d.cost) AS Inventorycost
		 FROM wine e
		 INNER JOIN inventory d ON e.wine_id = d.wine_id
		 GROUP BY e.wine_id
		) i on i.wine_id = w.wine_id
	LEFT JOIN
		(SELECT f.wine_id, SUM(g.qty) AS Stocksold, SUM(g.price) AS revenue
		FROM wine f
		INNER JOIN items g ON f.wine_id = g.wine_id
		GROUP BY f.wine_id
		) j on j.wine_id = w.wine_id
        INNER JOIN winery y ON w.winery_id = y.winery_id
        INNER JOIN region r ON y.region_id = r.region_id
	WHERE w.year >= '$minyear' AND w.year <= '$maxyear'
	AND i.cost >= '$dollarrangelow' AND i.cost <= '$dollarrangemax'


";

$statement = array();

if (!empty($wine)) {$statement[] = "w.wine_name ='$wine'";};
if (!empty($wineryname)) {$statement[] = "w.winery_name = '$winery'";};
if ($region != "All") {$statement[] = "r.region_name = '$region'";};
if ($grapevariety != "All") {$statement[] = "v.varieties LIKE '$grapevariety%'";}; 
if (!empty($minstock)) {$statement[] = "i.on_hand >= '$minstock'";};
if (count($statement) > 0){$query .= ' AND ' .implode(' AND ', $statement);}
$query .= ';';

$result = $pdo->query($query);
$result->execute();

unset($_SESSION['queryresult']);
while ($row = $result->fetch(PDO::FETCH_ASSOC))
{
	$_SESSION['queryresult'][] = array
	(
	      	$row['wine_id'], $row['wine_name'], $row['year'], $row['varieties'], 
		$row['winery_name'], $row['region_name'], $row['Inventorycost'],
     		$row['Stocksold'], $row['revenue']
	);
} 


header('location: result.php');
exit();
?>


