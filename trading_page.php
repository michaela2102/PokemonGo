<?php   										// Opening PHP tag
	// Include the database connection script
	require 'includes/database-connection.php';
    $request = "Yes";
	function get_pokemon_collection(PDO $pdo, string $request) {

		// SQL query to retrieve Pokémon information based on the Pokémon ID
		$sql = "SELECT * 
                FROM hasPokemon 
				JOIN pokemon ON hasPokemon.PokemonID = pokemon.PokemonID
				JOIN player ON hasPokemon.PlayerID = player.PlayerID
                WHERE AvailableToTrade = :request;";
		
		// Execute the SQL query using the pdo function and fetch the result
		$pokemon_collection = pdo($pdo, $sql, ['request' => $request])->fetchAll();

		// Return the toy information (associative array)
		return $pokemon_collection;
	}
	// Retrieve info about toys from the db using provided PDO connection
	$pokemon_collection = get_pokemon_collection($pdo, $request);

?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pokémon Go Trading Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Pokémon-themed colors */
        body {
            background: #98C8DE;
            color: #333;
        }
        header {
            background-color: #313167;
            padding: 10px;
            text-align: center;
        }
        h1 {
            font-family: gill sans, sans-serif;
            color: #FFFFFF;
        }
        .sidebar {
            background-color: #645AA4;
            padding: 20px;
            color: #FFF;
            height: 100vh;
            overflow-y: auto;
        }
        .content {
            padding: 20px;
        }
        .pokemon {
            border: 1px solid #ddd;
            padding: 10px;
            margin: 10px 0;
            background: white;
            display: flex;
            align-items: center;
        }
        .pokemon img {
            height: 60px;
            margin-right: 20px;
        }
        .header-left {
			float: left;
            font-size: 14px;
		}
		.header-right {
			float: right;
            font-size: 14px;
		}
    </style>
</head>
<body>
    <header>
		<div class="header-left">
			<nav>
	      		<ul>
	      			<li><a href="home.php">Home</a></li>
	      			<li><a href="leaderboard.php">Leaderboard</a></li>
			    </ul>
			</nav>
		</div>

        </div>
        <h1>Pokémon Go Trading Page</h1>
    </header>
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 sidebar">
                <h2>Tradeable Pokémon</h2>
                <ul>
                    <img src="images/pika.png" alt="Pikachu Icon" width= "75" height="75">
                </ul>
            </div>
            <div class="col-md-9 content">
                <div id="search-results">
                    <!-- Search results will be displayed here -->
                </div>

	<?php
		for($row = 0; $row < count($pokemon_collection); $row++) {
			$PokemonID = $pokemon_collection[$row]['PokemonID'];
			$PokemonName = $pokemon_collection[$row]['Name'];
			$Trainer = $pokemon_collection[$row]['Username'];
			$image_src = "https://www.pokemon.com/static-assets/content-assets/cms2/img/pokedex/full/" . str_pad($PokemonID, 3, '0', STR_PAD_LEFT) . ".png";
			$CP = $pokemon_collection[$row]['CP'];    
			$Stars = $pokemon_collection[$row]['NumStars'];
			$Trade = $pokemon_collection[$row]['AvailableToTrade'];
			$Shiny = $pokemon_collection[$row]['IsShiny'];
	?>

		<div class="pokemon">
			<!-- Create a hyperlink to poke.php page with PokemonID as parameter -->
			<a href="poke.php?PokemonID=<?= $PokemonID ?>">
				<!-- Display image of Pokémon with its name as alt text -->
				<img src="<?= $image_src ?>" alt="<?= $PokemonName ?>">
			</a>
			<div>
				<!-- Display ID and Name of Pokémon -->
				<strong> <?= $PokemonName ?></strong> #<?= $PokemonID ?>:</br>
				Trainer: <?= $Trainer ?> </br>

				<!-- Display CP of Pokémon -->
				CP: <?= $CP ?>  

				<!-- Display #Stars of Pokémon -->
				Stars: <?= $Stars ?>

				<!-- Display Shinyness of Pokémon -->
				Shiny: <?= $Shiny ?>
			</div>
		</div>

	<?php
	}
	?>
            </div>
        </div>
    </div>



</body>
</html>
