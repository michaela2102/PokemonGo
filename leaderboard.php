<?php   										// Opening PHP tag
	
 	// Include the database connection script
 	require 'includes/database-connection.php'; // comment out for now

 	/*
	 * Retrieve rankings information from the database.
	 * 
	 * @param PDO $pdo       An instance of the PDO class.
	 * @return array|null    An associative array containing the ranks information
	 */

    function get_rankings(PDO $pdo) {
        // SQL query to retrieve toy information based on the toy ID
        $sql = "SET @rank = 0; SELECT @rank := @rank + 1 AS Rank, Username, XP FROM player ORDER BY XP DESC;";

        // Execute the SQL query using the pdo function and fetch the result
        $rankings = pdo($pdo, $sql)->fetchAll();

        // Return the ranks information (associative array)
        return $rankings;
    }

    // Retrieve info
    $rankings = get_rankings($pdo);
	
// Closing PHP tag  ?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PokémonGo Player Leaderboard</title>

	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['table']});
      google.charts.setOnLoadCallback(drawTable);

      function drawTable() {
        var data = new google.visualization.DataTable();
		data.addColumn('number', 'Rank');
		data.addColumn('string', 'Username');
		data.addColumn('number', 'XP');
        data.addRows($rankings);

        var table = new google.visualization.Table(document.getElementById('table_div'));

        table.draw(data, {showRowNumber: false, width: '100%', height: '100%'});
      }
    </script>

    <style>
        /* Basic CSS for styling */
        body {
            font-family: Arial, sans-serif;
        }
        h1 {
            text-align: center;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin-bottom: 10px;
        }
        img {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <h1>PokémonGo Player Leaderboard</h1>

	<desc>Here is a leaderboard of the top PokémonGo players.</desc>
    <br> <br>

	<img src="images/gold_medal.png" alt="Gold Medal" width="50" height="50">
    <rank><?= $rankings[0]['Username'] ?> with <?= $rankings[0]['XP'] ?> XP.</rank>
    <br>
    <br>

    <img src="images/silver_medal.png" alt="Silver Medal" width="50" height="50">
    <rank><?= $rankings[1]['Username'] ?> with <?= $rankings[1]['XP'] ?> XP.</rank>
    <br>
    <br>

    <img src="images/bronze_medal.png" alt="Bronze Medal" width="50" height="50">
    <rank><?= $rankings[2]['Username'] ?> with <?= $rankings[2]['XP'] ?> XP.</rank>
    <br>
    <br>

    <ul>
        <?php
        
        ?>
    </ul>

	<div id="table_div"></div>

</body>
</html>
