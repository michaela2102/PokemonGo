<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokémon Home Page</title>
    <style>
        body {
            background: #98C8DE;
            color: #333;
            font-family: Arial, sans-serif; /* Font family */
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #313167; /* Header background color */
            padding: 10px;
            display: flex; /* Use flexbox for layout */
            justify-content: space-between; /* Align items to the left and right */
            align-items: center; /* Align items vertically */
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
            color: #FFFFFF;
            margin-bottom: 20px;
        }

        hr {
            width: 50%;
            border-color: #ffffff; /* Pokémon GO red */
            margin: 0; /* Remove default margin */
            float: left;
        }

        .login-icon {
            margin-right: 10px; /* Add margin to separate from other nav items */
        }

        li {
            margin-bottom: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li>    
                    <a href="login.php" class="login-icon"> <img src="images/login.png" alt="Login Icon" width= "10%" height="10%"></a><br>
                </li>
            </ul>
        </nav>
    </header>

    <h1>Welcome to our PokémonGo Web Application!</h1>

    <center>Here you can log in to your account, or create an account if you don't already have one.</center><br>
    <center>Or, view the leaderboard of PokémonGo players and cheer on your friends!</center><br>
    <center>Once you log in, you can view your current Pokémon.</center><br>
    <li><a href="create_account.php">New user? Create an account</a></li> <br>
    <li><a href="leaderboard.php">View the leaderboard</a></li> <br>
    <li><a href="trading_page.php">View the pokemon trading page</a></li> <br>
    
    <center>Pokémon Go Community Web Application created and designed by Group 5</center>

    
</body>
</html>
