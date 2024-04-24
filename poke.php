<?php   										// Opening PHP tag
	
	// Include the database connection script
	require 'includes/database-connection.php';

	// Retrieve the value of the 'PokemonID' parameter from the URL query string
	//		i.e., ../toy.php?PokemonID=0001
	$PokemonID= $_GET['PokemonID'];


	// Define a function that retrieves ALL Pokémon and stats info from the database based on the toynum parameter from the URL query string
	function get_pokemon_and_stats(PDO $pdo, string $PokemonID) {

		// SQL query to retrieve Pokémon and stats information based on Pokémon ID
		$sql = "SELECT *
				FROM pokemon
				WHERE PokemonID = :PokemonID;";
	
		// Execute the SQL query using PDO and fetch the result
		$statement = $pdo->prepare($sql);
		$statement->execute(['PokemonID' => $PokemonID]);
		$pokeInfo = $statement->fetch(PDO::FETCH_ASSOC);
	
		// Return the Pokémon info
		return $pokeInfo;
	}

	// Call the function to retrieve the toy info
	$pokeInfo = get_pokemon_and_stats($pdo, $PokemonID);
	$image_src = "https://www.pokemon.com/static-assets/content-assets/cms2/img/pokedex/full/" . str_pad($PokemonID, 3, '0', STR_PAD_LEFT) . ".png";

// Closing PHP tag  ?> 

<!DOCTYPE>
<html>

	<head>
		<meta charset="UTF-8">
  		<meta name="viewport" content="width=device-width, initial-scale=1.0">
  		<title>Info</title>
  		<link rel="stylesheet" href="css/style.css">
  		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
		<title> Information: </title>
		<style>
			/* Basic CSS for styling */
			body {
				font-family: gill sans, sans-serif;
				color: #313167;
				background-color: #B986D7; /* Add a magenta background color */
			}
			h1 {
				text-align: center;
			}
		</style>
		<style>
			.header-left {
				float: left;
			}

			.header-right {
				float: right;
			}
			
			.pokemon-stats-container {
				display: flex;
				justify-content: center;
				align-items: center;
			}

			.pokemon-image {
				margin-right: 20px;
			}

			.pokemon-stats {
				background-color: #f1f1f1;
				padding: 20px;
				border-radius: 10px;
				margin-left: 20px;
				margin-top: 70px; /* Add margin-top to lower the container */
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
						<li><a href="trading_page.php">Trading</a> </li>
			        </ul>
			    </nav>
		   	</div>

		    <div class="header-right">
		    	<ul>
		    		<li><a href="hasPokemon.php">My Collection</a></li>
					<li><a href="pokedex.php">Pokédex</a></li>
					<li><a href="logout.php">Log Out</a> </li>
		    	</ul>
		    </div>
		</header>

		<main>
			<!-- 
			  -- TO DO: Fill in ALL the placeholders for this toy from the db
  			  -->
			
			<div class="pokemon-stats-container">

				<div class="pokemon-image">
					<!-- Display image of Pokémon with its name as alt text -->
					<img src="<?= $image_src ?>" alt="<?= $pokeInfo['Name'] ?>">
				</div>

				<div class="pokemon-stats">

					<!-- Display heading -->
			        <h1><?= $pokeInfo['Name']?> Information:</h1>

			        <hr />

			        <!-- Display PokémonID -->
			        <p><strong>ID:#</strong><?=$pokeInfo['PokemonID']?></p>

			        <!-- Display name of Pokémon -->
			        <p><strong>Name:</strong> <?= $pokeInfo['Name'] ?></p>

					<!-- Display Generation -->
			        <p><strong>Generation:</strong> <?= $pokeInfo['Generation'] ?></p>

					<!-- Display Weight -->
			        <p><strong>Weight:</strong> <?= $pokeInfo['Weight'] ?> kg</p>

					<!-- Display Height -->
			        <p><strong>Height:</strong> <?= $pokeInfo['Height'] ?> m</p>

					<!-- Display if it is a Legendary Pokémon -->
			        <p><strong>Legendary:</strong> <?= $pokeInfo['Legendary'] ?></p>

			        <br />

			        <h3>Stats:</h3>
					
					<!-- Display Stamina -->
			        <p><strong>Stamina:</strong> <?= $pokeInfo['Stamina'] ?></p>

			        <!-- Display Attack -->
			        <p><strong>Attack:</strong> <?= $pokeInfo['Attack'] ?></p>

					<!-- Display Defense -->
			        <p><strong>Defense:</strong> <?= $pokeInfo['Defense'] ?></p>

					<!-- Display MaxHP -->
			        <p><strong>Max HP:</strong> <?= $pokeInfo['MaxHP'] ?></p>

					<!-- Display MaxCP -->
			        <p><strong>Max CP:</strong> <?= $pokeInfo['MaxCP'] ?></p>

					<!-- Display Capture Rate -->
			        <p><strong>Capture Rate:</strong> <?= $pokeInfo['Capture_rate'] ?></p>

					<!-- Display Escape Rate -->
			        <p><strong>Escape Rate:</strong> <?= $pokeInfo['Escape_rate'] ?></p>
			        
			    </div>
			</div>
		</main>

	</body>
</html>
