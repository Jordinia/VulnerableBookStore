<?php
require_once 'connect.php';
session_start();

// Redirect to login page if not logged in
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// Process user input
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['search'])) {
    $searchTerm = $_GET['search'];

    // Intentionally vulnerable SQL query for educational purposes
    $sql = "SELECT title, author, description, price, isbn FROM books WHERE title LIKE '%$searchTerm%'";
    $result = $koneksi->query($sql);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DVBS - Search</title>
</head>
<body>

    <h1>Search Page</h1>

    <form action="search_book.php" method="get">
        <label for="search">Search by Book Name:</label>
        <input type="text" id="search" name="search" required>
        <button type="submit">Search</button>
    </form>

    <?php
    // Display search results
    if (isset($result) && $result->num_rows > 0) {
        // Display results
        while ($row = $result->fetch_assoc()) {
            echo "Title: " . $row['title'] . "<br>";
            echo "Author: " . $row['author'] . "<br>";
            echo "Description: " . $row['description'] . "<br>";
            echo "Price: $" . $row['price'] . "<br>";
            echo "ISBN: " . $row['isbn'] . "<br>";
            echo "<a href='purchase.php?isbn=" . $row['isbn'] . "'>Purchase</a><br><br>";
        }
    } elseif (isset($result)) {
        echo "No results found";
    }
    ?>

</body>
</html>
