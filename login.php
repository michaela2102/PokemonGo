<?php
	session_start();										 // Start/renew session
  require 'includes/database-connection.php';

	// $logged_in = $_SESSION['logged_in'] ?? false; 		    // Is user logged in?

	function login($username)          					  // Remember user passed login
	{
    	// session_regenerate_id(true); 					 // Update session id
	    $_SESSION['logged_in'] = true; 					// Set logged_in key to true
	    $_SESSION['username'] = $username;		       // Set username key to one from form 
	}

	function authenticate($pdo, $username, $password) {
	    $sql = "SELECT username, password
	            FROM login_info
	            WHERE username = :username AND password = :password";

	    $user = pdo($pdo, $sql, ['username' => $username, 'password' => $password])->fetch();

	    return $user;
  	}

if ($logged_in) {   
  header('Location: index.php'); 
  print "<script>window.location = 'index.php'</script>";
  exit;
}    

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $user = authenticate($pdo, $username, $password);

  if ($user) {
    login($username);                               
    header('Location: index.php');
    print "<script>window.location = 'index.php'</script>";
    exit;   
  } else {
    $login_err = "Invalid username or password";
  }
}
?> 
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Log-in</title>
  <style>
    body {
      background-color: #1a1a1a; /* Dark background color */
      color: #fff; /* Text color */
      font-family: Arial, sans-serif; /* Font family */
      margin: 0;
      padding: 0;
    }

    header {
      background-color: #000; /* Header background color */
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
      color: #ff4c4c; /* Pokémon GO red */
      margin-bottom: 20px;
    }

    hr {
      width: 50%;
      border-color: #ff4c4c; /* Pokémon GO red */
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
      background-color: #333; /* Input background color */
      color: #fff; /* Input text color */
    }

    input[type="submit"] {
      width: 5%;
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
  <div>
    <h1>Log In</h1>
    <hr />
    <br />
    <?php if(isset($login_err)) { ?>
      <p class="error-message"><?php echo $login_err; ?></p>
    <?php } ?>
    
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      Username: <input type="text" name="username"><br>
      Password: <input type="password" name="password"><br>
      <input type="submit" value="Log In">
    </form>
  </div>
</body>
</html>
