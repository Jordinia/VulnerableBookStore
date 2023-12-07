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
        $sql = "SELECT title, author, description, price, isbn, cover_image_url FROM books";
    } else {
        // Otherwise, return books that match the search term
        $sql = "SELECT title, author, description, price, isbn, cover_image_url FROM books WHERE title LIKE '%$searchTerm%'";
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
   <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('img/pxfuel.jpg');
            background-size: cover; /* Adjust the background size as needed */
            background-repeat: no-repeat;
            margin: 0; /* Remove default body margin */
        }

        /* Add a style block to include specific styles for this page */
        .book-results-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin: 20px auto;
            padding: 20px;
            border: 0px solid #ddd;
            border-radius: 4px;
            width: 80%;
            overflow-x: auto; /* Add horizontal scroll if needed */
        }

        .book-result {
            flex: 1 0 auto;
            margin: 10px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            background-color: white; /* Set the background color to white */
        }

        .book-image {
            width: 100%;
            max-width: 200px;
            height: auto;
            margin-bottom: 10px;
        }

        .purchase-link {
            display: block;
            margin-top: 10px;
            color: #328f8a;
            text-decoration: none;
        }

        .purchase-link:hover {
            color: #08ac4b;
        }
        
        form button {
            margin-bottom: 10px; /* Adjust the margin as needed */
        }
    </style>
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

