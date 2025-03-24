document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("searchInput");
    const searchButton = document.getElementById("searchButton");
    const resetButton = document.getElementById("resetButton");

    function performSearch() {
        const query = searchInput.value.trim();
        if (query !== "") {
            window.location.href = "index.php?search=" + encodeURIComponent(query);
        }
    }

    if (searchButton) {
        searchButton.addEventListener("click", performSearch);
    }

    if (searchInput) {
        searchInput.addEventListener("keypress", function (event) {
            if (event.key === "Enter") {
                performSearch();
            }
        });
    }

    if (resetButton) {
        resetButton.addEventListener("click", function () {
            window.location.href = "index.php"; // Reset search
        });
    }
});
