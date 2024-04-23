<?php
	session_start();
    $username = $_SESSION['username'];

    function get_player_id(PDO $pdo, string $username) {

		// SQL query to retrieve Pokémon information based on the Pokémon ID
		$sql = "SELECT PlayerID
				FROM player
				WHERE Username = :username;";
		
		// Execute the SQL query using the pdo function and fetch the result
		$pokemon_collection = pdo($pdo, $sql, ['Username' => $username])->fetchAll();

		// Return the toy information (associative array)
		return $pokemon_collection;
	}

    function get_pokemon_collection(PDO $pdo, string $PlayerID) {

		// SQL query to retrieve Pokémon information based on the Pokémon ID
		$sql = "SELECT *
				FROM hasPokemon
				JOIN pokemon ON hasPokemon.PokemonID = pokemon.PokemonID
				WHERE PlayerID = :PlayerID;";
		
		// Execute the SQL query using the pdo function and fetch the result
		$pokemon_collection = pdo($pdo, $sql, ['PlayerID' => $PlayerID])->fetchAll();

		// Return the toy information (associative array)
		return $pokemon_collection;
	}

    $PlayerID = get_player_id($pdo, $username);
    $pokemon_collection = get_pokemon_collection($pdo, $PlayerID);
?> 

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokémon!</title>
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
			color: #313167; /* Set the text color to white */
			background-color: #5C7FD0; /* Add a light grey background color */
			border-radius: 10px; /* Add rounded corners to the card */
			padding: 20px; /* Add some padding inside the card */
			margin: 10px; /* Add some margin around the card */
			width: 200px; /* Set a fixed width for the card */
			display: inline-block; /* Make the cards display inline */
			text-align: center; /* Center align the content inside the card */
		}

		.pokemon-card img {
			width: 150px; /* Set a fixed width for the Pokémon image */
			height: auto; /* Automatically adjust the height to maintain aspect ratio */
			margin-bottom: 10px; /* Add some space below the image */
		}

		.pokemon-card h2 {
			margin: 5px 0; /* Add some margin to the heading elements */
		}

		/* Hover effect */
		.pokemon-card:hover {
			background-color: #313167; /* Darker gray background color on hover */
			border-color: #B986D7; /* Dark border color on hover */
			color: #B986D7;
		}

	</style>
</head>
<body>
    <h1>Pokémon!</h1>
<!-- -->
	
	<!-- Iterate over each Pokémon in the collection -->
	<?php
		
		for($row = 0; $row < count($pokemon_collection); $row++) {
			$PokemonID = $pokemon_collection[$row]['PokemonID'];
			$PokemonName = $pokemon_collection[$row]['Name'];
			$Generation = $pokemon_collection[$row]['Generation'];
			$image_src = "https://www.pokemon.com/static-assets/content-assets/cms2/img/pokedex/full/" . str_pad($PokemonID, 3, '0', STR_PAD_LEFT) . ".png";	
	?>

    	<div class="pokemon-card">
        	<!-- Display image of toy with its name as alt text -->
        	<img src="<?= $image_src ?>" alt="<?= $pokemon['Name'] ?>">
        
        	<!-- Display ID of Pokémon -->
        	<h2># <?= $PokemonID ?></h2>

        	<!-- Display name of Pokémon -->
        	<h2><?= $PokemonName ?></h2>

        	<!-- Display generation of Pokémon -->
        	<h2>Generation <?= $Generation ?></h2>
    	</div>

	<?php
	}
	?>
</body>
</html>
