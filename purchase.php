<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DVBS - Purchase</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <img src="img/OIG.jpeg" alt="Logo" id="logo">

  <?php
  ini_set('display_errors', 1);
  error_reporting(E_ALL);

  require_once 'connect.php';
  session_start();

  // Redirect to login page if not logged in
  if (!isset($_SESSION['username'])) {
      header("Location: index.php");
      exit();
  }

  // Process book details based on ISBN
  if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['isbn'])) {
      $isbn = $_GET['isbn'];

      // Validate ISBN
      if (!preg_match('/^\d{10,13}$/', $isbn)) {
          die('Invalid ISBN');
      }

      // Fetch book details based on ISBN
      $stmt = $koneksi->prepare("SELECT title, cover_image_url FROM books WHERE isbn = ?");
      $stmt->bind_param("s", $isbn);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows > 0) {
          // Display book information
          $row = $result->fetch_assoc();

          // Add your purchase form here
          echo '<form action="" method="post">';
          echo "<h1>Book Purchase</h1>";
          echo "<p>Book Title: " . htmlspecialchars($row['title']) . "</p>";
          echo '<img class="book-cover-image" src="' . htmlspecialchars($row['cover_image_url']) . '" alt="Book Cover">';
          echo '<label for="quantity">Quantity:</label>';
          echo '<input type="number" id="quantity" name="quantity" class="quantity-input" required>';
          echo '<button type="submit">Purchase</button>';
          echo '<button type="submit" id="back" onclick="window.location.href=\'search_book.php\'">Go back to search page</button>';
          echo '</form>';
          
      } else {
          echo "<p>Book not found.</p>";
      }
  }
  ?>
  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Purchase successful!";
}
  ?>
</body>
<script>
document.getElementById('back').addEventListener('click', function() {
   document.getElementById('quantity').required = false;
});
</script>
</html>
