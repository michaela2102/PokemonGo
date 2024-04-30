<?php
	session_start();
	require 'includes/database-connection.php';

    $username = $_SESSION['username'];
    function get_player_id(PDO $pdo, string $username) {

		// SQL query to retrieve PlayerID based on the username
		$sql = "SELECT PlayerID
				FROM login_info
				WHERE Username = :username;";
		
		// Execute the SQL query using the pdo function and fetch the result
		$PlayerID = pdo($pdo, $sql, ['username' => $username])->fetchAll();

		// Return the Pokémon collection (associative array)
		return $PlayerID;
	}

    function get_pokemon_collection(PDO $pdo, string $PlayerID) {

		// SQL query to retrieve Pokémon collection based on the PlayerID
		$sql = "SELECT *
				FROM hasPokemon
				JOIN pokemon ON hasPokemon.PokemonID = pokemon.PokemonID
				JOIN pokemonType ON pokemon.PokemonID = pokemonType.PokemonID
				WHERE PlayerID = :PlayerID
				GROUP BY pokemon.PokemonID;";
		
		// Execute the SQL query using the pdo function and fetch the result
		$pokemon_collection = pdo($pdo, $sql, ['PlayerID' => $PlayerID])->fetchAll();

		// Return the Pokémon information (associative array)
		return $pokemon_collection;
	}

    $PlayerID = get_player_id($pdo, $username);
    $pokemon_collection = get_pokemon_collection($pdo, strval($PlayerID[0]["PlayerID"]));

	// Function to filter the Pokémon based on user input
	function filter_pokemon($pokemon_collection, $search) {
		// Array to store the filtered Pokémon
		$filtered_collection = array();
	        
	    if ($search == "Legendary" || $search == "legendary"){
	        $legend = "Sí";
	    }
	    else if ($search == "Not Legendary" || $search == "not legendary" || $search == "Not legendary"){
	        $legend = "No";
	    }
		else {
			$legend = "fillerstring";
		}

		if ($search == "Shiny" || $search == "shiny"){
			$shiny = "Yes";
		}
		else if ($search == "Not Shiny" || $search == "not shiny" || $search == "Not shiny"){
			$shiny = "No";
		}
		else {
			$shiny = "fillerstring";
		}

		// Iterate over each Pokémon in the collection
		foreach ($pokemon_collection as $pokemon) {

			$id = ltrim($pokemon['PokemonID'], '0');
			$gen = "Generation " . $pokemon['Generation'];
			$stars = $pokemon['NumStars'] . " Stars";

			// Check if the Pokémon matches the search criteria
			if (stripos($pokemon['Name'], $search) !== false ||
				stripos($id, $search) !== false ||
	            stripos($gen, $search) !== false ||
				stripos($stars, $search) !== false ||
	            stripos($pokemon['Type'], $search) !== false ||
	            stripos($pokemon['Legendary'], $legend) !== false ||
				stripos($pokemon['IsShiny'], $shiny) !== false
			) {
				// Add the Pokémon to the filtered array
				$filtered_collection[] = $pokemon;
			}
		}

		// Remove any duplicate Pokémon from the filtered Pokémon array
		$filtered_collection = array_unique($filtered_collection, SORT_REGULAR);

		// Return the filtered Pokémon
		return $filtered_collection;
	}

?> 

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Pokémon</title>
	<style>
        /* Basic CSS for styling */
        body {
            font-family: gill sans, sans-serif;
			color: #313167;
			background-color: #98C8DE; /* Add a light blue background color */
        }
        h1 {
            text-align: center;
        }
    </style>
	<style>
		/* CSS for styling the Pokémon cards */
		.pokemon-card {
			border: 2px solid #313167; /* Add a border around the card */
			color: #313167; /* Set the text color to dark blue */
			background-color: #5C7FD0; /* Add a blue background color */
			border-radius: 10px; /* Add rounded corners to the card */
			padding: 10px; /* Add some padding inside the card */
			margin: 10px auto; /* Center align the cards horizontally */
			width: 180px; /* Set a fixed width for the card */
			display: inline-block; /* Make the cards display inline */
			text-align: center; /* Center align the content inside the card */
			position: relative; /* Add position relative to the card */
		}

		.pokemon-card img {
			width: 90px; /* Set a fixed width for the Pokémon image */
			height: auto; /* Automatically adjust the height to maintain aspect ratio */
			margin-bottom: 2px; /* Add some space below the image */
		}

		.pokemon-card h2 {
			margin: 2px 0; /* Add some margin to the heading elements */
			font-size: 14px; /* Set the font size to 14px */
		}

		/* Hover effect */
		.pokemon-card:hover {
			background-color: #313167; /* Dark blue background color on hover */
			border-color: #B986D7; /* Magenta border color on hover */
			color: #B986D7; /* Change text color to magenta on hover */
		}

		.search-container {
			display: flex;
			justify-content: center;
			align-items: center;
			width: 100%;
			margin-bottom: 20px;
		}

		.add-button {
			padding: 10px;
			background-color: #5C7FD0;
			border: 2px solid #313167;
			color: white;
			border-radius: 5px;
			cursor: pointer;
		}

		/* Hover effect */
		.add-button:hover {
			background-color: #313167; /* Dark blue background color on hover */
			border-color: #B986D7; /* Magenta border color on hover */
			color: #B986D7; /* Change text color to magenta on hover */
		}

		.header-left {
			float: left;
		}

		.header-right {
			float: right;
		}

	</style>
	<style>
		/* CSS for styling the search form */
		input[type="text"] {
			width: 300px;
			padding: 10px;
			border: 2px solid #313167;
			border-radius: 5px;
		}

		input[type="submit"] {
			padding: 10px;
			background-color: #5C7FD0;
			border: 2px solid #313167;
			color: white;
			border-radius: 5px;
			cursor: pointer;
		}

		input[type="submit"]:hover {
			background-color: #313167;
			border-color: #B986D7;
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
				<li><a href="pokedex.php">Pokédex</a></li>
				<li><a href="logout.php">Log Out</a> </li>
			</ul>
		</div>
	</header>
	<h1> My Pokémon!</h1>
	<div class="search-container">
		<form action="hasPokemon.php" method="get">
			<input type="text" name="search" placeholder="Search for a Pokémon!">
			<input type="submit" value="Search">
		</form>
		<a href="add.php"><button class="add-button">Add to your collection!</button></a>
	</div>
	</div>
<!-- -->
	
	<!-- Iterate over each Pokémon in the collection -->
	<?php
		// Check if a search query is submitted
		if (isset($_GET['search'])) {
			// Get the search query from the URL parameter
			$search = $_GET['search'];

			// Filter the Pokémon based on the search query
			$filtered_collection = filter_pokemon($pokemon_collection, $search);
		} else {
			// If no search query is submitted, display all Pokémon
			$filtered_collection = $pokemon_collection;
		}

		for($row = 0; $row < count($filtered_collection); $row++) {
			$PokemonID = $filtered_collection[$row]['PokemonID'];
			$PokemonName = $filtered_collection[$row]['Name'];
			$Generation = $filtered_collection[$row]['Generation'];
			$image_src = "https://www.pokemon.com/static-assets/content-assets/cms2/img/pokedex/full/" . str_pad($PokemonID, 3, '0', STR_PAD_LEFT) . ".png";
			$CP = $filtered_collection[$row]['CP'];    
			$Stars = $filtered_collection[$row]['NumStars'];
			$Trade = $filtered_collection[$row]['AvailableToTrade'];
			$Shiny = $filtered_collection[$row]['IsShiny'];
			$Type = $filtered_collection[$row]['Type'];
	?>

		<div class="pokemon-card">
			<!-- Create a hyperlink to poke.php page with PokemonID as parameter -->
			<a href="poke.php?PokemonID=<?= $PokemonID ?>">
				<!-- Display image of Pokémon with its name as alt text -->
				<img src="<?= $image_src ?>" alt="<?= $PokemonName ?>">
			</a>
			
			<!-- Display ID and Name of Pokémon -->
			<h2># <?= $PokemonID ?> <?= $PokemonName ?></h2>

			<!-- Display Type(s) of Pokémon -->
			<h2>Type: <?= $Type ?></h2>

			<!-- Display CP of Pokémon -->
			<h2><?= $CP ?> CP</h2>

			<!-- Display #Stars of Pokémon -->
			<h2><?= $Stars ?> Stars</h2>

			<!-- Display Tradeability of Pokémon -->
			<h2>Available To Trade: <?= $Trade ?></h2>

			<!-- Display Shinyness of Pokémon -->
			<h2>Shiny: <?= $Shiny ?></h2>

		</div>

	<?php
	}
	?>

</body>
</html>