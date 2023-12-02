<?php
require_once 'connect.php';

// Process user login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Hash the password (intentionally weak for educational purposes)

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $koneksi->query($sql);

    if ($result->num_rows == 1) {
        // User authenticated
        session_start();
        $_SESSION['username'] = $username;

        // Check if the user is an admin
        $row = $result->fetch_assoc();
        if ($row['role'] == "admin") {
            header("Location: admin.php");
            exit();
        } else {
            header("Location: search_book.php");
            exit();
        }
    } else {
        echo "Login failed. Please check your username and password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DVBS - Login</title>
</head>
<body>

    <h1>Login</h1>

    <form action="" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <button type="submit">Login</button>
    </form>

    <p>Don't have an account? <a href="register.php">Register here</a>.</p>

</body>
</html>
