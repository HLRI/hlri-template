<div class="wrap-search-slider">
    <div class="search-slider">
        <input name="topsearch" id="main-search-field" autocomplete="off" autocorrect="off"  type="search" onchange="hlr_search()" class="form-control input-search-slider keyword" placeholder="Search by project name, city, neighborhood...">
        <i onchange="hlr_search()" style="cursor: pointer" class="fa fa-search"></i>
    </div>
    <div class="search-result">
    </div>
</div>

<script>
    // Get references to the search box and search button
    const searchBox = document.getElementById('main-search-field');

    // Add event listener for 'keypress' event on search box
    searchBox.addEventListener('keypress', function(event) {
        // Check if Enter key is pressed
        if (event.key === 'Enter') {
            hlr_search();
        }
    });
</script>