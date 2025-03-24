<?php
require "db_connect.php";

if (!isset($_GET['id'])) {
    die("<p class='error-message'>No book selected.</p>");
}

$book_id = intval($_GET['id']);
$query = "SELECT * FROM book_details WHERE id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $book_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$book = mysqli_fetch_assoc($result);

if (!$book) {
    die("<p class='error-message'>Book not found.</p>");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book - <?php echo htmlspecialchars($book['book_name']); ?></title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px gray;
            width: 400px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            display: block;
            font-weight: bold;
            margin-top: 10px;
        }
        input, button {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            cursor: pointer;
            background: blue;
            color: white;
            border: none;
            margin-top: 20px;
        }
        .cancel-button {
            background: gray;
            text-align: center;
            display: block;
            text-decoration: none;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Edit Book</h2>
    <form action="update_book.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="book_id" value="<?php echo $book_id; ?>">

        <label>Book Name:</label>
        <input type="text" name="book_name" value="<?php echo htmlspecialchars($book['book_name']); ?>" required>

        <label>Author Name:</label>
        <input type="text" name="author_name" value="<?php echo htmlspecialchars($book['author_name']); ?>" required>

        <label>Number of Copies:</label>
        <input type="number" name="copies" value="<?php echo htmlspecialchars($book['copies']); ?>" required>

        <label>Upload New Image:</label>
        <input type="file" name="image">

        <button type="submit">Save Changes</button>
        <a href="book_details.php?id=<?php echo $book_id; ?>" class="cancel-button">Cancel</a>
    </form>
</div>

</body>
</html>
