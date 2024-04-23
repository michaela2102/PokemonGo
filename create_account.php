<?php
session_start();
require 'includes/database-connection.php'; // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    // Hash the password for security
    // $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    // Prepare SQL statement to insert user data into the database
    $sql = "INSERT INTO login_info (username, password, email) VALUES (:username, :password, :email)";
    $params = ['username' => $username, 'password' => $password, 'email' => $email];
    var_dump($password);
    $stmt = $pdo->prepare($sql);
    var_dump($username);
    $stmt->execute($params);
    var_dump($email);

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
</head>

<body>
    <h2>Create Account</h2>
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
