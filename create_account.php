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
    $params = ['username' => $username, 'password' => $hashed_password, 'email' => $email];
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
          <li><a href="home.php">Home Page</a></li>
        </ul>
      </nav>
    </div>
  </header>
    <h1>Create Account</h1>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>
        <input type="submit" value="Create Account">
    </form>
</body>

</html>
