<?php

session_start();

?>

<!DOCTYPE html>
<!-- Declaring the doctype of the web pages which is XHTML Strict 1.0 -->

<head>
<title>Winestore Database</title>
<link type="text/css" rel="stylesheet" href="../css/stylesheet.css" /> <!-- links to the css stylesheet that the website is using-->
<meta charset="UTF-8">
</head>

<body>

<div class="container">

<div class = "header"></div> <!-- close header -->
<div class = "menu"></div> <!-- close menu -->
<div class = "contentarea">
<h1>OOPS</h1>
<p>Your search has encounted an error. You have incorrectly entered information into one or more of the fields.</p>
<p>Please ensure that you have not entered any characters such as ; or / into your search query, and that you added numbers into the numeric search fields</p>
<p>Please navigate back to the search page, and try again.</p>
<p>Thank you</p>

<a href = "../search.php">Search Again </a>

</div> <!-- close contentarea -->
<div class = "footer"></div> <!-- close footer -->

</div> <!-- close container -->
</html>

