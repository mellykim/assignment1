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

$wine = $_GET["winename"];
$winery = $_GET["wineryname"];
$region = $_GET["region"];
$grapevariety = $_GET["grapevariety"];
$minyear = $_GET["minyear"];
$maxyear = $_GET["maxyear"];
$minwinestock = $_GET["minwinesinstock"];
$minwinesordered = $_GET["minwinesordered"];
$dollarrangelow = $_GET["mincost"];
$dollarrangemax = $_GET["maxcost"];

echo "$wine </br>";
echo "$winery</br>";
echo "$region</br>";
echo "$grapevariety </br>";
echo "$minyear </br>";
echo "$maxyear </br>";
echo "$minwinestock </br>";
echo "$minwinesordered </br>";
echo "$dollarrangelow </br>";
echo "$dollarrangemax </br>";

?>

</div> <!-- close contentarea -->
<div class = "footer"></div> <!-- close footer -->

</div> <!-- close container -->
</html>

