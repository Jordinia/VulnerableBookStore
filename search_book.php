<?php
require_once 'connect.php';
session_start();

// Redirect to login page if not logged in
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// Process user input
// Process user input
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
 
    // If the search term is "*", return all books
    if ($searchTerm == "*") {
        $sql = "SELECT title, author, description, price, isbn, language, stock_quantity, cover_image_url FROM books";
    } else {
        // Otherwise, return books that match the search term
        $sql = "SELECT title, author, description, price, isbn, language, stock_quantity, cover_image_url FROM books WHERE title LIKE '%$searchTerm%'";
    }
 
    $result = $koneksi->query($sql);
 }
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Book Search</title>
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
   <img src="img/OIG.jpeg" alt="Logo" id="logo">
    <form action="" method="get">
        <label for="search">Search by Book Name:</label>
        <input type="text" id="search" name="search" required>
        <button type="submit">Search</button>
        <button type="submit" name="search" value="*" id="searchAll">Search All</button>
        
    </form>
   <div class="book-results-container">
   <?php
   // Display search results
   if (isset($result) && $result->num_rows > 0) {
       // Display results
       while ($row = $result->fetch_assoc()) {
           echo '<div class="book-result">';
           echo "<strong>Title:</strong> " . htmlspecialchars($row['title']) . "<br>";
           echo "<strong>Author:</strong> " . htmlspecialchars($row['author']) . "<br>";
           echo "<strong>Description:</strong> " . htmlspecialchars($row['description']) . "<br>";
           echo "<strong>Price:</strong> $" . htmlspecialchars($row['price']) . "<br>";
           echo "<strong>ISBN:</strong> " . htmlspecialchars($row['isbn']) . "<br>";
           echo '<img class="book-image" src="' . htmlspecialchars($row['cover_image_url']) . '" alt="Book Cover">';
           
           // Add purchase link
           echo '<a class="purchase-link" href="purchase.php?isbn=' . htmlspecialchars($row['isbn']) . '">Purchase</a>';
           
           echo '</div>';
       }
   } elseif (isset($result)) {
       echo "No results found";
   }
   ?>
</div>

</body>
<script>
document.getElementById('searchAll').addEventListener('click', function() {
   document.getElementById('search').required = false;
});
</script>


</html>

