<?php
require "db_connect.php"; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $book_name = mysqli_real_escape_string($conn, $_POST['book_name']);
    $author_name = mysqli_real_escape_string($conn, $_POST['author_name']);
    $copies = intval($_POST['copies']); // Convert copies to integer

    // Handle file upload
    $target_dir = "images/"; // Folder to store images
    $image_name = basename($_FILES["book_image"]["name"]);
    $target_file = $target_dir . time() . "_" . $image_name; // Unique filename
    move_uploaded_file($_FILES["book_image"]["tmp_name"], $target_file);

    // Insert into library_details
    $query1 = "INSERT INTO library_details (book_name, author_name, copies, images) 
               VALUES ('$book_name', '$author_name', '$copies', '$target_file')";

    if (mysqli_query($conn, $query1)) {
        // Get the last inserted ID to maintain consistency
        $book_id = mysqli_insert_id($conn);

        // Insert into book_details with additional columns
        $published_year = date("Y"); // Example: Use the current year (modify as needed)
        $description = "Default description"; // Placeholder, can be updated later

        $query2 = "INSERT INTO book_details (id, book_name, author_name, published_year, copies, description, images) 
                   VALUES ('$book_id', '$book_name', '$author_name', '$published_year', '$copies', '$description', '$target_file')";

        if (mysqli_query($conn, $query2)) {
            echo "<script>alert('Book added successfully!'); window.location.href='index.php';</script>";
        } else {
            echo "Error inserting into book_details: " . mysqli_error($conn);
        }
    } else {
        echo "Error inserting into library_details: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Book</title>
    <link rel="stylesheet" href="styles2.css">
</head>
<body>
    <header>
        <h1>Library Management System</h1>
    </header>

    <main>
        <h2 class="enter">Enter the details to add a new book</h2>
        <form action="add_book.php" method="POST" enctype="multipart/form-data" class="book-form">
            <label for="book_name">Book Name:</label>
            <input type="text" id="book_name" name="book_name" required>

            <label for="author_name">Author Name:</label>
            <input type="text" id="author_name" name="author_name" required>

            <label for="copies">Number of Copies:</label>
            <input type="number" id="copies" name="copies" min="1" required>

            <label for="book_image">Upload Book Image:</label>
            <input type="file" id="book_image" name="book_image" accept="image/*" required>

            <button type="submit">Add Book</button>
        </form>
    </main>
</body>
</html>
