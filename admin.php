<?php
require_once 'connect.php';
session_start();

// Redirect to login page if not logged in
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// Check if the user is an admin
$sql = "SELECT * FROM users WHERE username = '{$_SESSION['username']}' AND role='admin'";
$result = $koneksi->query($sql);

// Redirect to search page if the user is not an admin
if ($result->num_rows != 1) {
    header("Location: search.php");
    exit();
}

// Process admin actions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];

    // Perform the admin action based on the action parameter
    switch ($action) {
        case 'add_book':
            // Perform add book operation
            $title = $_POST['book_title'];
            $author = $_POST['book_author'];

            // Placeholder query for adding a book
            $sqlAddBook = "INSERT INTO books (title, author) VALUES ('$title', '$author')";
            $resultAddBook = $koneksi->query($sqlAddBook);

            if ($resultAddBook) {
                echo "Book added successfully!";
            } else {
                echo "Error adding the book.";
            }
            break;

        case 'edit_book':
            // Perform edit book operation
            $title = $_POST['book_title'];
            $author = $_POST['book_author'];

            // Placeholder query for editing a book (assuming ISBN is used as a unique identifier)
            $isbn = $_POST['book_isbn'];
            $sqlEditBook = "UPDATE books SET title = '$title', author = '$author' WHERE isbn = '$isbn'";
            $resultEditBook = $koneksi->query($sqlEditBook);

            if ($resultEditBook) {
                echo "Book edited successfully!";
            } else {
                echo "Error editing the book.";
            }
            break;

        case 'delete_book':
            // Perform delete book operation
            $isbn = $_POST['book_isbn'];

            // Placeholder query for deleting a book
            $sqlDeleteBook = "DELETE FROM books WHERE title = '$isbn'";
            $resultDeleteBook = $koneksi->query($sqlDeleteBook);

            if ($resultDeleteBook) {
                echo "Book deleted successfully!";
            } else {
                echo "Error deleting the book.";
            }
            break;

        case 'delete_all_books':
            // Placeholder query for deleting all books
            $sqlDeleteAllBooks = "DELETE FROM books";
            $resultDeleteAllBooks = $koneksi->query($sqlDeleteAllBooks);

            if ($resultDeleteAllBooks) {
                echo "All books deleted successfully!";
            } else {
                echo "Error deleting all books.";
            }
            break;

        // Add more cases for additional admin actions
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DVBS - Admin</title>
</head>
<body>

    <h1>Admin Panel</h1>

    <!-- Admin actions form -->
    <form action="" method="post">
        <label for="action">Select Admin Action:</label>
        <select id="action" name="action" required>
            <option value="add_book">Add Book</option>
            <option value="edit_book">Edit Book</option>
            <option value="delete_book">Delete Book</option>
            <option value="delete_all_books">Delete All Books (Experimental)</option>
            <!-- Add more options for additional admin actions -->
        </select><br>

        <!-- Additional input fields based on the selected action -->
        <!-- You can customize this part based on the requirements of each admin action -->
        <?php
        // For example, if you are adding or editing a book, you might need fields like title, author, etc.
        // You can adjust the input fields accordingly for each admin action.
        ?>
        <label for="book_title">Book Title:</label>
        <input type="text" id="book_title" name="book_title" required><br>

        <label for="book_author">Book Author:</label>
        <input type="text" id="book_author" name="book_author" required><br>

        <?php
        // For editing or deleting a book, you might need additional input fields (e.g., ISBN)
        ?>
        <label for="book_isbn">Book ISBN:</label>
        <input type="text" id="book_isbn" name="book_isbn"><br>

        <!-- Add more input fields based on the requirements of each admin action -->

        <button type="submit">Perform Admin Action</button>
    </form>

</body>
</html>
