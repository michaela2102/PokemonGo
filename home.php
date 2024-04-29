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
            font-family: gill sans, sans-serif; /* Font family */
            margin: 0;
            padding: 0;
            font-size: 16px;
            line-height: 2; /* Add line-height property to increase spacing between lines */
            font-weight: bold; /* Make the font bold */
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
            color: #313167;
            display: inline;
            margin-right: 10px;
        }

        header nav ul li a {
            color: #fff;
            text-decoration: none;
        }

        h1 {
            text-align: center;
            font-family: gill sans, sans-serif;
            color: #FFFFFF;
            margin-bottom: 20px;
            font-size: 44px;
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

        .header-right {
			float: right;
		}

    </style>
</head>
<header>
	<div class="header-left">
		<nav>
	      	<ul>
	      		<li></li>
                    <li><img src="images/poke_ball.png" alt="Pokéball Icon" width= "90" height="90"></a></li>
				<li></li>
			</ul>
		</nav>
	</div>

	<div class="header-right">
		<ul>
            <li><a href="login.php"> <img src="images/login.png" alt="Login Icon" width= "130" height="30"></a></li>
		</ul>
	</div>
</header>
<h1>Welcome to our Pokémon Go Community Web Application!</h1>
<body>

    <center>Here you can log in to your account, or create an account if you don't already have one.</center><br>
    <center>Or, view the leaderboard of PokémonGo players and cheer on your friends!</center><br>
    <center>Once you log in, you can view your current Pokémon.</center><br>
    <li><a href="create_account.php">New user? Create an account</a><img src="images/pikachu.png" alt="Pikachu Icon" width= "20" height="20"></li><br>
    <li><a href="leaderboard.php">View the leaderboard</a><img src="images/ditto.png" alt="Ditto Icon" width= "20" height="20"></li><br>
    <li><a href="trading_page.php">View the pokemon trading page</a><img src="images/charmander.png" alt="Charmander Icon" width= "20" height="20"></li><br>
    
    <center>Pokémon Go Community Web Application created and designed by Group 5</center>
    
</body>
</html>
