<?php
require "db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $book_id = intval($_POST['book_id']);

    $query = "DELETE FROM book_details WHERE id = ?";
    $query = "DELETE FROM library_details WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $book_id);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: index.php?success=deleted");
        exit;
    } else {
        echo "<p class='error-message'>Error deleting book.</p>";
    }
}
?>
