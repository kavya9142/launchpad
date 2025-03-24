<?php
    require "db_connect.php" ;

if (isset($_GET['success'])) {
    echo "<p class='success-message'>Record " . htmlspecialchars($_GET['success']) . " successfully!</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <nav>
            <h1>Library Management System</h1>
            <ul>
            <li><a href="add_book.php" target="_blank">Add Book</a></li>
                <li><a href="#">Library</a></li>
                <li><a href="#">About</a></li>
            </ul>
            <div class="search-container">
                <input type="text" id="searchInput" placeholder="Search by title or author...">
                <button id="searchButton">Search</button>
                <button id="resetButton">Reset</button>
            </div>
        </nav>
    </header>
    
    <main>
        <section class="book-list">
            <?php
           $search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
           $query = "SELECT * FROM library_details WHERE book_name LIKE '%$search%' OR author_name LIKE '%$search%'";
           $result = mysqli_query($conn, $query);
           

            while ($book = mysqli_fetch_assoc($result)) { 
            ?>
           
           <div class="book">
    <a href="book_details.php?id=<?php echo $book['id']; ?>">
        <img src="<?php echo $book['images']; ?>" alt="Book Image">
        <h3><?php echo $book['book_name']; ?></h3>
        <p><?php echo $book['author_name']; ?></p>
    </a>
</div> 



            <?php
            }
            ?>
            <!-- <div class="book">
                <img src="images/img2.jpg" alt="Book Image">
                <h3>Where the Crawdads Sing </h3>
                <p>Delia Owens</p>
            </div>
            <div class="book">
                <img src="images/img3.jpg" alt="Book Image">
                <h3>The Midnight Library </h3>
                <p>Matt Haig</p>
            </div>
            <div class="book">
                <img src="images/img4.jpg" alt="Book Image">
                <h3>Atomic Habits </h3>
                <p>James Clear</p>
            </div>
            <div class="book">
                <img src="images/img5.jpg" alt="Book Image">
                <h3>The Alchemist </h3>
                <p>Paulo Coelho</p>
            </div> -->
            <link rel= "bookdetail" href = "book_details.php">
        </section>
    </main>
    
    <script src="script.js"></script>
</body>
</html>