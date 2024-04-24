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
		$sql = "SELECT *
				FROM hasPokemon
				JOIN pokemon ON hasPokemon.PokemonID = pokemon.PokemonID
				WHERE AvailableToTrade = 'Yes'";
		
		// Execute the SQL query using the pdo function and fetch the result
		$pokemon_collection = pdo($pdo, $sql, ['PlayerID' => $PlayerID])->fetchAll();

		// Return the toy information (associative array)
		return $pokemon_collection;
	}

	// Retrieve info about toys from the db using provided PDO connection
	$pokemon_collection = get_pokemon_collection($pdo, '1');

        // Function 10 to take 10 randomly generated tradeable pokemon from our database
        function random_trades(PDO $pdo) {
            // SQL query to selkect the 10 random pokemon from the database that are tradeable
            $sql = "SELECT pokemon.PokemonID
                   FROM hasPokemon 
                   JOIN pokemon ON hasPokemon.PokemonID = pokemon.PokemonID
                   WHERE hasPokemon.AvailableToTrade='Yes'
                   ORDER BY RAND()
                   LIMIT 10";
 // Prepare the query to prevent SQL injection
    $stmt = $pdo->prepare($sql);
    // Bind the limit parameter
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    // Execute the query
    $stmt->execute();

    // Fetch the result as an associative array
    return $stmt->fetchAll(PDO::FETCH_ASSOC);

// Closing PHP tag  ?> -->

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
            font-family: 'Pokemon', sans-serif;
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
        .chat-button {
            background: #B986D7;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
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

		<div class="header-right">
		    <ul>
                <li><a href="pokedex.php">Pokédex</a></li>
		    	<li><a href="hasPokemon.php">My Collection</a></li>
				<li><a href="logout.php">Log Out</a> </li>
		    </ul>
        </div>
    <header>
        <h1>Pokémon Go Trading Page</h1>
    </header>
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 sidebar">
                <h2>Tradeable Pokémon</h2>
                <ul>
                    <!-- Itterating through a list of pokemon in our database that are tradeable randomly generating 10 -->

                    <?php
                         if (!empty($pokemon_collection)){
                             foreach ($row as $random_trades){
                             echo $row["PokemonID"] "<li>" . 
                       htmlspecialchars($pokemon['PokemonName']) . "</li>";
                        }
                    } else {
                        echo "<li>No Pokémon available for trade.</li>";
                    }
                             
       ?>
                   
                </ul>
            </div>
            <div class="col-md-9 content">
                <div class="form-group">
                    <label for="search">Search for Tradeable Pokémon:</label>
                    <input type="text" id="search" class="form-control" placeholder="Type Pokémon name..." onkeyup="searchPokemon()">
                </div>
                <div id="search-results">
                    <!-- Search results will be displayed here -->
                </div>
            </div>
        </div>
    </div>

    <script>
        // Example list of Pokémon with user data (this would usually come from a database)
        const pokemonData = [
            { name: 'Charmander', user: 'Ash', img: 'charmander.png', stats: 'Level 10, CP 500' },
            { name: 'Bulbasaur', user: 'Misty', img: 'bulbasaur.png', stats: 'Level 15, CP 600' },
            { name: 'Squirtle', user: 'Brock', img: 'squirtle.png', stats: 'Level 20, CP 700' },
            { name: 'Pikachu', user: 'Gary', img: 'pikachu.png', stats: 'Level 25, CP 800' },
            { name: 'Eevee', user: 'Tracey', img: 'eevee.png', stats: 'Level 5, CP 300' },
        ];

        // Function to search Pokémon
        function searchPokemon() {
            const searchQuery = document.getElementById('search').value.toLowerCase();
            const resultsDiv = document.getElementById('search-results');
            resultsDiv.innerHTML = ''; // Clear previous results

            const filteredPokemon = pokemonData.filter(p => p.name.toLowerCase().includes(searchQuery));

            if (filteredPokemon.length > 0) {
                filteredPokemon.forEach(pokemon => {
                    const pokemonElement = document.createElement('div');
                    pokemonElement.className = 'pokemon';
                    pokemonElement.innerHTML = `
                        <img src="${pokemon.img}" alt="${pokemon.name}">
                        <div>
                            <strong>${pokemon.name}</strong><br>
                            User: ${pokemon.user}<br>
                            Stats: ${pokemon.stats}
                        </div>
                        <button class="chat-button">Chat</button>
                    `;
                    resultsDiv.appendChild(pokemonElement);
                });
            } else {
                resultsDiv.innerHTML = '<p>No tradeable Pokémon found.</p>';
            }
        }
    </script>
</body>
</html>
