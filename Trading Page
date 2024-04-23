<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <font color="#FFFFFF">
    <title>Pokémon Go Trading Page</title> </font>
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
        <h1>Pokémon Go Trading Page</h1>
    </header>
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 sidebar">
                <h2>Tradeable Pokémon</h2>
                <ul>
                    <!-- Example of 10 randomly generated Pokémon from the database -->
                    <li>Pikachu</li>
                    <li>Charmander</li>
                    <li>Bulbasaur</li>
                    <li>Squirtle</li>
                    <li>Eevee</li>
                    <li>Magikarp</li>
                    <li>Snorlax</li>
                    <li>Jigglypuff</li>
                    <li>Growlithe</li>
                    <li>Onix</li>
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
