<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokémon Home Page</title>
    <style>
        li {
            margin-bottom: 10px;
            text-align: center;
        }
        body {
            background: #98C8DE;
            color: #333;
            font-family: Arial, sans-serif;
        }

        h1 {
            font-family: 'Pokemon', sans-serif;
            color: #FFFFFF;
            text-align: center;
        }

        header {
            background-color: #313167;
            padding: 10px;
            text-align: center;
        }

        /* Content styles */
        .content {
            padding: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .login-icon {
            position: absolute;
            top: 10px; /* Adjust as needed */
            right: 10px; /* Adjust as needed */
        }
    </style>
</head>
<body>
    <h1>Welcome to our PokémonGo Web Application!</h1>

    <center>Here you can log in to your account, or create an account if you don't already have one.</center><br>
    <center>Or, view the leaderboard of PokémonGo players and cheer on your friends!</center><br>
    <center>Once you log in, you can view your current Pokémon.</center><br>
    <br>
    <a href="login.php" class="login-icon">
        <img src="images/login.png" alt="Login Icon" width= "10%" height="10%">
    </a><br>
    <li><a href="create_account.php">New user? Create an account</a></li> <br>
    <li><a href="leaderboard.php">View the leaderboard</a></li> <br>
    <li><a href="trading_page.php">View the pokemon trading page</a></li> <br>
    
    <center>Pokémon Go Community Web Application created and designed by Group 5</center>

    
</body>
</html>
