document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("searchInput");
    const searchButton = document.getElementById("searchButton");
    const resetButton = document.getElementById("resetButton");
    const bookList = document.querySelectorAll(".book");

    function filterBooks() {
        const query = searchInput.value.toLowerCase();
        bookList.forEach(book => {
            const title = book.querySelector("h3").textContent.toLowerCase();
            const author = book.querySelector("p").textContent.toLowerCase();
            if (title.includes(query) || author.includes(query)) {
                book.style.display = "block";
            } else {
                book.style.display = "none";
            }
        });
    }

    searchButton.addEventListener("click", filterBooks);
    searchInput.addEventListener("input", filterBooks);

    resetButton.addEventListener("click", function () {
        searchInput.value = "";
        bookList.forEach(book => book.style.display = "block");
    });
});