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
        $sql = "SET @rank = 0;";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $sql = "SELECT @rank := @rank + 1 AS Rank, Username, XP FROM player ORDER BY XP DESC;";

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

    <style>
        /* Basic CSS for styling */
        body {
            font-family: Arial, sans-serif;
        }
        h1 {
            text-align: center;
        }
        h2 {
            text-align: center;
        }
        div {
            text-align: center;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin-bottom: 10px;
        }
        img.center {
            display: block;
            margin: 0 auto; /* Centers the image horizontally */
        }
        .header-left {
			float: left;
		}
		.header-right {
			float: right;
		}
    </style>
</head>
<body>
    <header>
		<div class="header-left">
			<nav>
	      		<ul>
	      			<li><a href="home.php">Home</a></li>
					<li><a href="trading_page.php">Trading</a> </li>
			    </ul>
			</nav>
		</div>

		<div class="header-right">
		    <ul>
                <li><a href="pokedex.php">Pokédex</a></li>
		    	<li><a href="hasPokemon.php">My Collection</a></li>
				<li><a href="logout.php">Log Out</a> </li>
		    </ul>
		</div>
	</header>
    <h1>PokémonGo Player Leaderboard</h1>

	<h2>Top 3 PokémonGo Players</h2>
    <br>

	<img src="images/gold_medal.PNG" alt="Gold Medal" width="50" height="50" class="center">
    <br>
    <div><?= $rankings[0]['Username'] ?> with <?= $rankings[0]['XP'] ?> XP</div>
    <br>
    <br>

    <img src="images/silver_medal.PNG" alt="Silver Medal" width="50" height="50" class="center">
    <br>
    <div><?= $rankings[1]['Username'] ?> with <?= $rankings[1]['XP'] ?> XP</div>
    <br>
    <br>

    <img src="images/bronze_medal.PNG" alt="Bronze Medal" width="50" height="50" class="center">
    <br>
    <div><?= $rankings[2]['Username'] ?> with <?= $rankings[2]['XP'] ?> XP</div>
    <br>
    <br>

    <h2>Complete Leaderboard</h2>
    <br> <br>

    <div>Rank &emsp; Username &emsp; XP</div>
    <br>
    <?php
    for ($row = 0; $row < count($rankings); $row++) {
        echo '<div>' . $rankings[$row]['Rank'] . ' &emsp; ' . $rankings[$row]['Username'] . ' &emsp; ' . $rankings[$row]['XP'] . ' XP</div> <br>';
    }
    ?>
    
    

</body>
</html>
