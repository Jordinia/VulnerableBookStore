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
            $sqlDeleteBook = "DELETE FROM books WHERE isbn = '$isbn'";
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

        case 'list_users':
            // Perform list users operation
            $sqlListUsers = "SELECT * FROM users";
            $resultListUsers = $koneksi->query($sqlListUsers);

            if ($resultListUsers->num_rows > 0) {
                echo "<div class='user-list'>";
                echo "<h2>List of Users</h2>";
                echo "<ul>";

                // Display user information
                while ($row = $resultListUsers->fetch_assoc()) {
                    echo "<li>Username: " . htmlspecialchars($row['username']) . ", Email: " . htmlspecialchars($row['email']) . "</li>";
                }

                echo "</ul>";
                echo "</div>";
            } else {
                echo "No users found.";
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
    <title>VBookStore - Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            color: #333;
        }

        form {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"] {
            padding: 8px;
            width: 300px;
        }

        select, button {
            padding: 8px;
            margin-top: 8px;
            cursor: pointer;
        }

        .user-list {
            margin-top: 20px;
        }

        .user-list li {
            list-style: none;
            margin-bottom: 8px;
        }
    </style>
</head>
<body>

    <h1>Admin Panel</h1>

    <!-- Admin actions form -->
    <form action="" method="post" id="adminForm">
        <label for="action">Select Admin Action:</label>
        <select id="action" name="action" required onchange="updateForm()">
            <option value="add_book">Add Book</option>
            <option value="edit_book">Edit Book</option>
            <option value="delete_book">Delete Book</option>
            <option value="delete_all_books">Delete All Books (Experimental)</option>
            <option value="list_users">List Users</option>
            <!-- Add more options for additional admin actions -->
        </select><br>

        <!-- Additional input fields based on the selected action -->
        <!-- You can customize this part based on the requirements of each admin action -->
        <label for="book_title">Book Title:</label>
        <input type="text" id="book_title" name="book_title"><br>

        <label for="book_author">Book Author:</label>
        <input type="text" id="book_author" name="book_author"><br>

        <?php
        // For editing or deleting a book, you might need additional input fields (e.g., ISBN)
        ?>
        <label for="book_isbn">Book ISBN:</label>
        <input type="text" id="book_isbn" name="book_isbn"><br>

        <!-- Add more input fields based on the requirements of each admin action -->

        <button type="submit">Perform Admin Action</button>
    </form>

    <!-- User list -->
    <?php
    // Display user list if available
    if (isset($resultListUsers) && $resultListUsers->num_rows > 0) {
        echo "<div class='user-list'>";
        echo "<h2>List of Users</h2>";
        echo "<ul>";

        // Display user information
        while ($row = $resultListUsers->fetch_assoc()) {
            echo "<li>Username: " . htmlspecialchars($row['username']) . ", Email: " . htmlspecialchars($row['email']) . "</li>";
        }

        echo "</ul>";
        echo "</div>";
    } elseif (isset($resultListUsers)) {
        echo "No users found.";
    }
    ?>

    <script>
        function updateForm() {
            var action = document.getElementById("action").value;
            var bookTitle = document.getElementById("book_title");
            var bookAuthor = document.getElementById("book_author");

            // Reset required attribute for book_title and book_author
            bookTitle.removeAttribute("required");
            bookAuthor.removeAttribute("required");

            // Set required attribute based on the selected action
            if (action === "add_book" || action === "edit_book") {
                bookTitle.setAttribute("required", "required");
                bookAuthor.setAttribute("required", "required");
            }
        }
    </script>

</body>
</html>
