<?php

require_once('db.php');

try
{
	$pdo = new PDO('mysql:host=localhost;dbname=winestore', DB_USER, DB_PW);

	$query = "SELECT COUNT(*) FROM wine";
	if ($res = $pdo->query($query))
	{
		if ($res->fetchColumn() > 0)
		{
			$sql = "SELECT * FROM wine";


			echo "<table border='1'>
        		<tr>
        		<th>Firstname</th>
        		<th>Lastname</th>
        		</tr>";

        		foreach($pdo->query('Select * from wine') as $row)
        		{
				echo "<tr>";
				echo "<td>" . $row['wine_id'] . "</td>";
				echo "<td>" . $row['wine_name'] . "</td>";
				echo "<td>" . $row['wine_type'] . "</td>";
				echo "<td>" . $row['year'] . "</td>";
				echo "</tr>";
        		}
		}

	}
	else
	{
		print "No rows matched the query";
	}

} catch (PDOException $e)
{
	print "Error!: " . $e->getMessage() . "<br/>";
	die();
}

?>
