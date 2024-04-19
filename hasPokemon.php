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
	function get_pokemon_collection(PDO $pdo, string $PlayerID) {

		// SQL query to retrieve Pokémon information based on the Pokémon ID
		$sql = "SELECT hasPokemon.*
				FROM hasPokemon
				WHERE hasPokemon.PlayerID = :PlayerID;";
		
		// Execute the SQL query using the pdo function and fetch the result
		$stmt = $pdo->prepare($sql);
		$stmt->execute(['player_id' => $player_id]);
		$pokemon_collection = $stmt->fetchAll(PDO::FETCH_ASSOC);

		// Return the toy information (associative array)
		return $pokemon_collection;
	}

	// Retrieve info about toys from the db using provided PDO connection
	$pokemon_collection = get_pokemon_collection($pdo, '1');

// Closing PHP tag  ?> -->

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokémon!</title>
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
    </style>
</head>
<body>
    <h1>ALl Pokémon</h1>
<!-- -->
	
	<!-- Iterate over each Pokémon in the collection -->
	<?php
		foreach ($pokemon_collection as $pokemon) {
		$PokemonID = $pokemon['PokemonID'];
    	$image_src = "https://www.pokemon.com/static-assets/content-assets/cms2/img/pokedex/full/" . str_pad($pokemonID, 3, '0', STR_PAD_LEFT) . ".png";
    	?>

    	<div class="pokemon-card">
        	<!-- Display image of toy with its name as alt text -->
        	<img src="<?= $image_src ?>" alt="<?= $pokemon['Name'] ?>">
        
        	<!-- Display ID of Pokémon -->
        	<h2># <?= $PokemonID ?></h2>

        	<!-- Display name of Pokémon -->
        	<h2><?= $pokemon['Name'] ?></h2>

        	<!-- Display generation of Pokémon -->
        	<p>Generation <?= $pokemon['Generation'] ?></p>
    	</div>

	<?php
	}
	?>

</body>
</html>