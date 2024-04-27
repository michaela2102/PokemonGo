<?php
session_start();
require 'includes/database-connection.php'; // Include your database connection file
$username = $_SESSION['username'];

function get_player_id(PDO $pdo, string $username) {

    // SQL query to retrieve PlayerID based on the username
    $sql = "SELECT PlayerID
            FROM player
            WHERE Username = :username;";
    
    // Execute the SQL query using the pdo function and fetch the result
    $PlayerID = pdo($pdo, $sql, ['username' => $username])->fetchAll();

    // Return the Pokémon collection (associative array)
    return $PlayerID;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $PlayerID = get_player_id($pdo, $username);
    $pokedex_id = $_POST['PokemonID'];
    $date_caught = $_POST['DateCaught'];
    $stats_multiplier = $_POST['stats'];
    $is_shiny = $_POST['is_shiny'];
    $in_fighting_party = $_POST['in_fighting_party'];
    $available_to_trade = $_POST['available_to_trade'];
    $num_stars = $_POST['num_stars'];
    $cp = $_POST['cp'];
    
    // Prepare SQL statement to insert user data into the database
    $sql = "INSERT INTO hasPokemon (PlayerID, PokemonID, DateCaught, StatsMultiplier, IsShiny, InFightingParty, AvailableToTrade, NumStars, CP) VALUES (:player_id, :pokedex_id, :date_caught, :stats_multiplier, :is_shiny, :in_fighting_party, :available_to_trade, :num_stars, :cp)";
    $params = [
        'player_id' => $PlayerID[0]["PlayerID"],
        'pokedex_id' => intval($pokedex_id),
        'date_caught' => NULL, // date('Y-m-d H:i:s', strtotime($date_caught . ' UTC')),
        'stats_multiplier' => floatval($stats_multiplier),
        'is_shiny' => $is_shiny,
        'in_fighting_party' => $in_fighting_party,
        'available_to_trade' => $available_to_trade,
        'num_stars' => $num_stars,
        'cp' => intval($cp)
    ];
    var_dump($params);
    $stmt = $pdo->prepare($sql);
    var_dump($stmt);
    $stmt->execute($params);

    // Redirect to a success page or login page
    header('Location: hasPokemon.php');
    print "<script>window.location = 'hasPokemon.php'</script>";
    exit;
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <style>
    body {
      background-color: #98C8DE; /* Dark background color */
      color: #333; /* Text color */
      font-family: Arial, sans-serif; /* Font family */
      margin: 0;
      padding: 0;
    }

    header {
      background-color: #313167; /* Header background color */
      padding: 10px;
    }

    header nav ul {
      list-style-type: none;
      padding: 0;
      margin: 0;
    }

    header nav ul li {
      display: inline;
      margin-right: 10px;
    }

    header nav ul li a {
      color: #fff;
      text-decoration: none;
    }

    h1 {
      font-family: 'Pokemon', sans-serif;
      color: #313167;
      margin-bottom: 20px;
    }

    hr {
      width: 50%;
      border-color: #ffffff;
      margin: 0; /* Remove default margin */
      float: left;
    }

    form {
      margin-top: 20px;
    }

    input[type="text"],
    input[type="password"] {
      width: 50%;
      padding: 10px;
      margin: 5px 0;
      border: none;
      border-radius: 5px;
      background-color: #fff; /* Input background color */
      color: #000; /* Input text color */
    }
    input[type="email"] {
      width: 50%;
      padding: 10px;
      margin: 5px 0;
      border: none;
      border-radius: 5px;
      background-color: #fff; /* Input background color */
      color: #000; /* Input text color */
    }

    input[type="submit"] {
      width: 10%;
      padding: 10px;
      margin-top: 10px;
      border: none;
      border-radius: 5px;
      background-color: #ff4c4c; /* Pokémon GO red */
      color: #fff;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #cc0000; /* Darker red on hover */
    }

    p.error-message {
      color: #ff4c4c; /* Error message color */
    }
  </style>
</head>

<body>
<header>
    <div>
      <div></div>
      <nav>
        <ul>
          <li><a href="hasPokemon.php">Back</a></li>
        </ul>
      </nav>
    </div>
  </header>
    <h1>Add Pokémon!</h1>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="PokemonID">Pokédex ID:</label><br>
        <input type="text" id="pokedex_id" name="PokemonID" required><br><br>

        <label for="DateCaught">What date did you catch this pokemon? </label><br>
        <input type="date" id="date_caught" name="DateCaught" required><br><br>

        <label for="stats">Stats Multiplier:</label><br>
        <input type="test" id="stats_multiplier" name="stats" required><br><br>

        <label for="shiny">Is this pokemon shiny?</label><br>
        <input type="checkbox" id="is_shiny" name="is_shiny" value="Yes"><br><br>

        <label for="party">Is this pokemon in your party?</label><br>
        <input type="checkbox" id="in_fighting_party" name="in_fighting_party" value="Yes"><br><br>

        <label for="trade">Is this pokemon available to trade?</label><br>
        <input type="checkbox" id="available_to_trade" name="available_to_trade" value="Yes"><br><br>

        <label for="stars">How many stars?</label><br>
        <select id="stars" name="num_stars" required>
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
        </select><br><br>

        <label for="cp">CP?</label><br>
        <input type="text" id="cp" name="cp" required><br><br>

        <input type="submit" value="Add Pokémon">
    </form>
</body>

</html>
