<?php
session_start();
require 'includes/database-connection.php'; // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    // Prepare SQL statement to insert user data into the database
    $sql = "INSERT INTO login_info (username, password, email) VALUES (:username, :password, :email)";
    $params = ['username' => $username, 'password' => $password, 'email' => $email];
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);

    // Redirect to a success page or login page
    header('Location: login.php');
    print "<script>window.location = 'login.php'</script>";
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
        <input type="text" id="PokemonID" name="PokemonID" required><br><br>

        <label for="DateCaught">What date did you catch this pokemon? </label><br>
        <input type="date" id="DateCaught" name="DateCaught" required><br><br>

        <label for="stats">Stats Multiplier:</label><br>
        <input type="test" id="stats" name="stats" required><br><br>

        <label for="shiny">Is this pokemon shiny?</label><br>
        <input type="checkbox" id="shiny" name="shiny" required><br><br>

        <label for="party">Is this pokemon in your party?</label><br>
        <input type="checkbox" id="party" name="party" required><br><br>

        <label for="trade">Is this pokemon available to trade?</label><br>
        <input type="checkbox" id="trade" name="trade" required><br><br>

        <label for="stars">How many stars?</label><br>
        <select id="stars" name="stars" required>
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
