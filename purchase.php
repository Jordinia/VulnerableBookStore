<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DVBS - Purchase</title>
</head>
<body>

    <h1>Book Purchase</h1>

    <form action="" method="post">
        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" required><br>

        <button type="submit">Purchase</button>
    </form>

    <?php
    require_once 'connect.php';
    session_start();

    // Redirect to login page if not logged in
    if (!isset($_SESSION['username'])) {
        header("Location: index.php");
        exit();
    }

    // Process book purchase
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo "Purchase successful!";
    }
    ?>

    <form action="search_book.php" method="get">
        <button type="submit">Go back to search page</button>
    </form>

</body>
</html>
