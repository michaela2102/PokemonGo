<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokémon Log-In</title>
    <style>
        /* Basic CSS for styling */
        body {
            font-family: "Arial", sans-serif;
            background-color: #f5f5f5; /* Light gray background color */
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #ee5350; /* Pokémon red */
            padding: 10px;
            color: white;
            text-align: center;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        nav ul li {
            display: inline;
            margin-right: 20px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        h1 {
            text-align: center;
            color: #35477d; /* Pokémon blue */
        }

        .login-container {
            width: 300px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        input[type="text"],
        input[type="password"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #ee5350; /* Pokémon red */
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #d6413d; /* Darker red on hover */
        }

        .error {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
    <header>
        <h1>Pokémon Log In</h1>
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
            </ul>
        </nav>
    </header>

    <div class="login-container">
        <?php if(isset($login_err)) { ?>
            <p class="error"><?php echo $login_err; ?></p>
        <?php } ?>
        
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username"><br>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password"><br>
            <input type="submit" value="Log In">
        </form>
    </div>
</body>
</html>
