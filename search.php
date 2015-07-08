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
<div class = "contentarea">

<h1>Winestore</h1>
<hr>

<form action="answer.php" method="get">

	<p class = "heading">Wine Name:</p>
	<input type = "text" name = "winename" id="winename" /> <br/>
	<p class = "heading">Winery Name:</p>
	<input type = "text" name = "wineryname" id="wineryname" /><br/>

<?php
	require_once('php/db.php');
	$pdo = new PDO('mysql:host=localhost;dbname=winestore', DB_USER, DB_PW);	
	if (!pdo){
 		echo "Please try later";
		die("Could Not Connect");}

	$regionquery = 'SELECT region_name FROM region';
        $result = $pdo->query($regionquery);
	echo "<p class = \"heading\">Region Name: </p>";
	echo "<select name='region'>";
	foreach($result as $row){echo "<option value='" . $row['region_name'] . "'>" . $row['region_name'] . "</option>";}
	echo "</select><br/>";

	$grapevariety = 'SELECT variety FROM grape_variety';
        $result2 = $pdo->query($grapevariety);
	echo "<p class = \"heading\">Grape Variety: </p>";
	echo "<select name='grapevariety'>";
	echo "<option value=\"All\">All </option>";
        foreach($result2 as $row){echo "<option value='" . $row['variety'] . "'>" . $row['variety'] . "</option>";}
        echo "</select><br/>";
	
	$minquery = 'SELECT year FROM wine ORDER BY year ASC';
	$minresult = $pdo->prepare($minquery);
	$minresult->execute();
	$result = $minresult->fetchColumn();

	$maxquery = 'SELECT year FROM wine ORDER BY year DESC';
        $maxresult = $pdo->prepare($maxquery);
        $maxresult->execute();
        $result2 = $maxresult->fetchColumn();

	echo "<p class = \"heading\">Wine Year:</p>";
	echo "<p>Min: </p>";
	echo "<select id = \"year\" name = 'minyear'>";
	for ($i = $result; $i <= $result2; $i++){echo "<option value ='".$i."'>$i</option>";}
	echo "</select><br/>";

        echo "<p>Max: </p>";
        echo "<select id = \"year\" name = 'maxyear'>";
        for ($i = $result2; $i >= $result; $i--){echo "<option value ='".$i."'>$i</option>";}
        echo "</select><br/>";
?>

	<p class = "heading">Minimum no of wines in stock: </p>
	<input type = "text" name = "minwinesinstock" id="minwinesinstock" /><br/>
	<p class = "heading">Mininum no of wines ordered, per wine</p>
	<input type = "text" name = "minwinesordered" id="minwinesordered" /><br/>

<?php
        $maxamount = 'SELECT cost FROM inventory ORDER BY cost DESC';
        $maxresult = $pdo->prepare($maxamount);
        $maxresult->execute();
        $amountresult = $maxresult->fetchColumn();
        $finalamount = round($amountresult);

	echo "<p>Dollar Cost Range:</p> <br/>";
        echo "<p>Min Cost</p>";
        echo "<input type=\"range\" name = \"mincost\" min=\"0\" max=\"$finalamount\" value=\"0\" step=\"1\" onchange=\"showValue(this.value)\" />";
        echo "<span id=\"minrange\">0</span>";
        echo "<script type=\"text/javascript\">
        
	function showValue(newValue){document.getElementById('minrange').innerHTML=newValue;}</script>";
        echo "<br /><span>Max Cost</span>";
        echo "<input type=\"range\" name = \"maxcost\" min=\"0\" max=\"$finalamount\" value=\"30\" step=\"1\" onchange=\"showValue2(this.value)\" />";
        echo "<span id=\"range\">30</span>";
        echo "<script type=\"text/javascript\">
        function showValue2(newValue){document.getElementById('range').innerHTML=newValue;}</script>";


?>
	<input type="submit" name="submit" value="Submit" /><br/>
	</form>
</div> <!-- close contentarea -->
<div class = "footer"></div> <!-- close footer -->

</div> <!-- close container -->
</html>
