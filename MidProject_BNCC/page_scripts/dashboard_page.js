document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("search");
    const searchIcon = document.querySelector(".search_Container i");

    function handleSearch() {
        const query = searchInput.value.trim().toLowerCase();
        console.log("Searching for:", query);
        
        const rows = document.querySelectorAll("tbody tr");
        rows.forEach(row => {
            const email = row.querySelector("td:nth-child(4)").textContent.toLowerCase();
            if (email.includes(query)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    }

    searchInput.addEventListener("keydown", function (event) {
        if (event.key === "Enter") {
            event.preventDefault();
            handleSearch();
        }
    });

    searchIcon.addEventListener("click", handleSearch);
});
