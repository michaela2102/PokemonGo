<!-- <?php   										// Opening PHP tag
	
	// Include the database connection script
	require 'includes/database-connection.php';

	/*
	 * Retrieve Pokémon information from the database based on the Pokémon ID.
	 * 
	 * @param PDO $pdo       An instance of the PDO class.
	 * @param string $id     The ID of the Pokémon to retrieve.
	 * @return array|null    An associative array containing the Pokémon information, or null if no Pokémon is found.
	 */
    function get_pokedex_info(PDO $pdo) {

        // SQL query to retrieve all Pokémon information
		$sql = "SELECT p.*, pt.Type
			FROM pokemon p
			JOIN (
				SELECT PokemonID, GROUP_CONCAT(DISTINCT Type ORDER BY Type SEPARATOR '/') AS Type
				FROM pokemonType
				GROUP BY PokemonID
			) pt ON p.PokemonID = pt.PokemonID";
        
        // Execute the SQL query using the pdo function and fetch all the results
        $pokedex_info = pdo($pdo, $sql)->fetchAll();

        // Return the Pokémon information (array of associative arrays)
        return $pokedex_info;
    }

    $pokedex_info = get_pokedex_info($pdo);

	// Function to filter the Pokémon based on user input
	function filter_pokemon($pokedex_info, $search) {

		// Array to store the filtered Pokémon
		$filtered_pokemon = array();
        
        if ($search == "Legendary"){
            $legend = "Sí";
        }
        else if ($search == "Not Legendary"){
            $legend = "No";
        }
		else {
			// Since stripos says a substring of a string "matches",
			// we need to make sure that the search string is not a substring of the string
			$legend = "fillerstring";
		}

		// Iterate over each Pokémon in the collection
		foreach ($pokedex_info as $pokemon) {

			$id = ltrim($pokemon['PokemonID'], '0');
			$gen = "Generation " . $pokemon['Generation'];

			// Check if the Pokémon matches the search criteria
			if (stripos($pokemon['Name'], $search) !== false ||
			stripos($id, $search) !== false ||
			stripos($gen, $search) !== false || 
			stripos($pokemon['Type'], $search) !== false || 
			stripos($pokemon['Legendary'], $legend) !== false) {
				// Add the Pokémon to the filtered array
				$filtered_pokemon[] = $pokemon;
			}
		}

		// Remove any duplicate Pokémon from the filtered Pokémon array
		$filtered_pokemon = array_unique($filtered_pokemon, SORT_REGULAR);

		// Return the filtered Pokémon
		return $filtered_pokemon;
	}

?> -->

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokédex!</title>
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
		/* CSS for styling the Pokémon cards */
		.pokemon-card {
			border: 2px solid #313167; /* Add a border around the card */
			color: #313167; /* Set the text color to dark blue */
			background-color: #5C7FD0; /* Add a blue background color */
			border-radius: 10px; /* Add rounded corners to the card */
			padding: 10px; /* Add some padding inside the card */
			margin: 10px auto; /* Center align the cards horizontally */
			width: 121px; /* Set a fixed width for the card */
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
		    	<li><a href="hasPokemon.php">My Collection</a></li>
				<li><a href="logout.php">Log Out</a> </li>
		    </ul>
		</div>
	</header>
    <h1>Pokédex</h1>
		<div class="search-container">
			<form action="pokedex.php" method="get">
				<input type="text" name="search" placeholder="Search for a Pokémon!">
				<input type="submit" value="Search">
			</form>
		</div>
<!-- -->
	
	<!-- Iterate over each Pokémon in the collection -->
	<?php
		
		// Check if a search query is submitted
		if (isset($_GET['search'])) {
			// Get the search query from the URL parameter
			$search = $_GET['search'];

			// Filter the Pokémon based on the search query
			$filtered_pokemon = filter_pokemon($pokedex_info, $search);
		} else {
			// If no search query is submitted, display all Pokémon
			$filtered_pokemon = $pokedex_info;
		}

		// Display the filtered Pokémon
		foreach ($filtered_pokemon as $pokemon) {
			$PokemonID = $pokemon['PokemonID'];
			$PokemonName = $pokemon['Name'];
			$Generation = $pokemon['Generation'];
			$image_src = "https://www.pokemon.com/static-assets/content-assets/cms2/img/pokedex/full/" . str_pad($PokemonID, 3, '0', STR_PAD_LEFT) . ".png";
		?>
	
		<div class="pokemon-card">
			<!-- Create a hyperlink to poke.php page with PokemonID as parameter -->
			<a href="poke.php?PokemonID=<?= $PokemonID ?>">
				<!-- Display image of Pokémon with its name as alt text -->
				<img src="<?= $image_src ?>" alt="<?= $PokemonName ?>">
			</a>
			<!-- Display ID of Pokémon -->
			<h2>#<?= $PokemonID ?></h2>
			<!-- Display name of Pokémon -->
			<h2><?= $PokemonName ?></h2>
			<!-- Display generation of Pokémon -->
			<h2>Generation <?= $Generation ?></h2>
		</div>

	<?php
	}

// Closing PHP tag  ?>

</body>
</html>