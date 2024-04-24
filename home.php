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

        /* Navigation styles */
        .header-left,
        .header-right {
            float: left;
            font-size: 14px;
        }

        .header-right {
            float: right;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
        }

        nav ul li {
            display: inline;
            margin-right: 10px;
        }

        nav ul li a {
            color: #FFFFFF;
            text-decoration: none;
        }

        /* Sidebar styles */
        .sidebar {
            background-color: #645AA4;
            padding: 20px;
            color: #FFF;
            height: 100vh;
            overflow-y: auto;
        }

        .sidebar h2 {
            color: #FFFFFF;
        }

        /* Content styles */
        .content {
            padding: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        /* Pokémon styles */
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

        /* Button styles */
        .chat-button {
            background: #B986D7;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .header-left,
            .header-right {
                float: none;
                text-align: center;
            }

            .sidebar {
                height: auto;
            }

            .col-md-3.sidebar,
            .col-md-9.content {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <h1>Welcome to our PokémonGo Web Application!</h1>

    <center>Here you can log in to your account, or create an account if you don't already have one.</center><br>
    <center>Or, view the leaderboard of PokémonGo players and cheer on your friends!</center><br>
    <center>Once you log in, you can view your current Pokémon.</center><br>
    <br>
    <a href="login.php">
        <img src="css/login.png" alt="Login Icon" width="20" height="20">
        Log in to your account
    </a><br>
    <a href="create_account.php">Create an account</a><br>
    <a href="pokedex.php">View the Pokédex</a></li> <br>
    <a href="leaderboard.php">View the leaderboard</a><br>
    <a href="trading_page.php">View the Pokémon trading page</a> <br>
    
    <center>Pokémon Go Community Web Application created and designed by Group 5</center>

    
</body>
</html>
