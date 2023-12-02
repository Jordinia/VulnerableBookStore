<?php
require_once 'connect.php';

// Process user registration
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']); // Use a secure hash function, not MD5, for production
    $dateOfBirth = $_POST['date_of_birth'];
    $paymentCardNumber = $_POST['payment_card_number'];
    $cardExpiryDate = $_POST['card_expiry_date'];
    $cardCVV = $_POST['card_cvv'];
    $role = 'user'; // Set the role to 'user' for regular users
    $registrationDate = date('Y-m-d H:i:s');

    // Placeholder query for user registration
    $sqlRegister = "INSERT INTO users (username, email, password, date_of_birth, payment_card_number, card_expiry_date, card_cvv, role, registration_date) VALUES ('$username', '$email', '$password', '$dateOfBirth', '$paymentCardNumber', '$cardExpiryDate', '$cardCVV', '$role', '$registrationDate')";
    $resultRegister = $koneksi->query($sqlRegister);

    if ($resultRegister) {
        echo "Registration successful! Redirecting to login page...";
        header("refresh:2;url=index.php"); // Redirect to the login page after 2 seconds
        exit();
    } else {
        echo "Error registering user.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DVBS - Register</title>
</head>
<body>

    <h1>User Registration</h1>

    <form action="" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <label for="date_of_birth">Date of Birth:</label>
        <input type="date" id="date_of_birth" name="date_of_birth" required><br>

        <label for="payment_card_number">Payment Card Number:</label>
        <input type="text" id="payment_card_number" name="payment_card_number" required><br>

        <label for="card_expiry_date">Card Expiry Date:</label>
        <input type="text" id="card_expiry_date" name="card_expiry_date" required><br>

        <label for="card_cvv">Card CVV:</label>
        <input type="text" id="card_cvv" name="card_cvv" required><br>

        <button type="submit">Register</button>
    </form>

</body>
</html>