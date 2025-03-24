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
    <title>Delete Book - <?php echo htmlspecialchars($book['book_name']); ?></title>
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
        .confirm-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px gray;
            text-align: center;
        }
        h2 {
            color: red;
            margin-bottom: 20px;
        }
        button, .cancel-button {
            padding: 10px 15px;
            margin: 10px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }
        .delete-button {
            background: red;
            color: white;
        }
        .cancel-button {
            background: gray;
            color: white;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="confirm-container">
    <h2>Are you sure you want to delete this book?</h2>
    <p><strong><?php echo htmlspecialchars($book['book_name']); ?></strong> by <?php echo htmlspecialchars($book['author_name']); ?></p>

    <form action="delete_book_action.php" method="POST">
        <input type="hidden" name="book_id" value="<?php echo $book_id; ?>">
        <button type="submit" class="delete-button">Yes, Delete</button>
        <a href="book_details.php?id=<?php echo $book_id; ?>" class="cancel-button">Cancel</a>
    </form>
</div>

</body>
</html>
