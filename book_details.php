<?php
require "db_connect.php";

if (isset($_GET['id'])) {
    $book_id = intval($_GET['id']);
    $query = "SELECT * FROM book_details WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $book_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $book = mysqli_fetch_assoc($result);

    if (!$book) {
        echo "<p class='error-message'>Book not found.</p>";
        exit;
    }
} else {
    echo "<p class='error-message'>No book selected.</p>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($book['book_name']); ?> - Details</title>
    <link rel="stylesheet" href="book_details.css">
    
   
</head>
<body>
    <div class="container">
        <h1><?php echo htmlspecialchars($book['book_name']); ?></h1>
        
        <img src="<?php echo htmlspecialchars($book['images']); ?>" alt="Book Image" width="200">
        
        <p><strong>Author:</strong> <?php echo htmlspecialchars($book['author_name']); ?></p>
        <p><strong>Published Year:</strong> <?php echo htmlspecialchars($book['published_year']); ?></p>
        <p><strong>Copies Available:</strong> <?php echo htmlspecialchars($book['copies']); ?></p>
        <p><strong>Description:</strong> <?php echo nl2br(htmlspecialchars($book['description'])); ?></p>

        <a href="index.php" class="back-button" id="btn">Back to Library</a>

        <!-- Edit Button -->
<a href="edit_book.php?id=<?php echo $book_id; ?>" class="button edit-button" id="btn">Edit</a>

<!-- Delete Button -->
<a href="delete_book.php?id=<?php echo $book_id; ?>" class="button delete-button" id="btn">Delete</a>

        
        
        </div>
    </div>
</body>
</html>
