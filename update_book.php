<?php
require "db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $book_id = intval($_POST['book_id']);
    $book_name = $_POST['book_name'];
    $author_name = $_POST['author_name'];
    $copies = intval($_POST['copies']);

    // Check if a new image is uploaded
    if ($_FILES['image']['size'] > 0) {
        $image_path = "uploads/" . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $image_path);

        // Update both tables with the new image
        $query1 = "UPDATE book_details SET book_name=?, author_name=?, copies=?, images=? WHERE id=?";
        $stmt1 = mysqli_prepare($conn, $query1);
        mysqli_stmt_bind_param($stmt1, "ssisi", $book_name, $author_name, $copies, $image_path, $book_id);

        $query2 = "UPDATE library_details SET book_name=?, author_name=?, images=? WHERE id=?";
        $stmt2 = mysqli_prepare($conn, $query2);
        mysqli_stmt_bind_param($stmt2, "sssi", $book_name, $author_name, $image_path, $book_id);
    } else {
        // Update without changing the image
        $query1 = "UPDATE book_details SET book_name=?, author_name=?, copies=? WHERE id=?";
        $stmt1 = mysqli_prepare($conn, $query1);
        mysqli_stmt_bind_param($stmt1, "ssii", $book_name, $author_name, $copies, $book_id);

        $query2 = "UPDATE library_details SET book_name=?, author_name=? WHERE id=?";
        $stmt2 = mysqli_prepare($conn, $query2);
        mysqli_stmt_bind_param($stmt2, "ssi", $book_name, $author_name, $book_id);
    }

    // Execute both queries
    if (mysqli_stmt_execute($stmt1) && mysqli_stmt_execute($stmt2)) {
        header("Location: index.php?success=updated");
        exit;
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>
