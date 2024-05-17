<div class="hero-section-search-wrap">
    <div class="hero-section-search-input">
        <div class="btn hero-section-search-input-icon">
            <i class="fa fa-search"></i>
        </div>
        <input autocomplete="off" autocorrect="off" id="hero-search-field"  type="search" onkeyup="hlr_search()" class="form-control input-search-slider keyword" placeholder="Search by project name, city, neighborhood...">
    </div>
    <span></span>
    <a target="_blank" title="Search on map" class="btn hero-section-map-btn" href="https://hlric.com/">
        Map
        <i onclick="hlr_search()" class="fa fa-location-dot"></i>
    </a>
    <div class="search-result">

    </div>
</div>
<script>
    // Get references to the search box and search button
    const searchBox = document.getElementById('hero-search-field');

    // Add event listener for 'keypress' event on search box
    searchBox.addEventListener('keypress', function(event) {
        // Check if Enter key is pressed
        if (event.key === 'Enter') {
            hlr_search();
        }
    });
</script>