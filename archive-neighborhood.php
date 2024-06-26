<?php
/* Template Name: Archive Neighborhoods */
get_header();
?>
<style>
    .card-img-top {
        height: 230px;
        object-fit: cover;
    }
    .btn-primary {
        background-color: #fff3cf;
        border-color: var(--main-color);
        color: black;
    }
    .btn {
        font-size: 0.9rem;
    }
    .btn-grayed-out{
        background-color: #c9c9c9;
        color: grey;
        border-color: #c9c9c9;
    }
    .btn-grayed-out:hover{
        background-color: #c9c9c9;
        color: grey;
        border-color: #c9c9c9;
    }
    .card-body {
        padding: 0.8rem;
    }
    .card-title {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .flex-btn{
        margin: 0px 10px 0px 0px;
    }
    .flex-input {
        background-color: #ffffff;
        color: black;
        inset: 0px;
        border-radius: 4px;
        padding-left: 10px;
        padding-right: 10px;
        margin-right: 10px;
        border: 2px solid #f7cb00;
        width: inherit;
    }
    .btn-submit-flex {
        background-color: #ffd100;
        border-color: #f7cb00;
        color: #252525;
    }
    .top-search-bar{
        z-index: 9;
        display: flex;
        width: 100%;
        margin: 0px auto;
        position: relative;
        padding: 10px;
        border: 1px solid #eeeeee;
        margin-bottom: 10px;
        border-radius: 4px;
    }
</style>
<div class="page-header" style="background-image: url('https://condoy.com/wp-content/uploads/2023/09/250-Lawrence-Avenue-West-condos-8.jpg');">
    <div class="page-header-title text-center">
        <h3>Toronto Neighborhoods</h3>
        <h2 class="font-weight-bold">click the neighborhood to view the listings</h2>
    </div>
</div>
<div class="container my-5">
<div class="top-search-bar"><input type="search" id="searchInput" class="flex-input" placeholder="Search...">
    <button id="searchButton" class="btn btn-submit-flex flex-btn">Search</button>
    <button id="clearButton" class="btn btn-submit-flex flex-btn">Clear</button>
</div>
    <div class="row" id="searchResults">
        <!-- Your existing card elements will be dynamically added here -->
    </div>
    <div class="row">
        <?php
        // Query all terms from the 'neighborhood' taxonomy
        $neighborhoods = get_terms(array(
            'taxonomy'   => 'neighborhood',
            'hide_empty' => false, // Set to true if you want to hide empty neighborhoods
        ));

        // Loop through each neighborhood
        foreach ($neighborhoods as $neighborhood) :
            $meta        = get_term_meta($neighborhood->term_id, 'neighborhood_options', true);
            $neighborhood_id = $neighborhood->term_id;
            // Query the number of properties for each neighborhood
            $property_count_query = new WP_Query(array(
                'post_type'      => 'property',
                'posts_per_page' => -1,
                'tax_query'      => array(
                    array(
                        'taxonomy' => 'neighborhood',
                        'field'    => 'term_id',
                        'terms'    => $neighborhood_id,
                    ),
                ),
            ));
            $property_count = $property_count_query->found_posts;
            ?>

            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card mb-4">
                    <a href="<?= get_term_link($neighborhood); ?>">
                        <?php if (isset($meta['opt-neighborhood-image']) && !empty($meta['opt-neighborhood-image']['url'])) : ?>
                            <img loading="lazy" src="<?= $meta['opt-neighborhood-image']['url'] ?>" class="card-img-top" alt="<?= isset($meta['opt-neighborhood-image']['alt']) ? $meta['opt-neighborhood-image']['alt'] : $neighborhood->name ?>">
                        <?php else : ?>
                            <img loading="lazy" src="<?= HLR_THEME_ASSETS . 'images/No-Image-Placeholder.jpg' ?>" class="card-img-top" alt="Placeholder Image">
                        <?php endif; ?>
                    </a>
                    <div class="card-body">
                        <h6 class="card-title"><?= $neighborhood->name ?></h6>
                        <a href="<?= get_term_link($neighborhood); ?>" title="All listings in <?= $neighborhood->name ?>"  class="btn btn-primary"><?= get_post_count_taxonomy($neighborhood_id, 'neighborhood', 'properties') ?> Listing</a>
                        <a title="This option will be available soon" class="btn btn-primary btn-grayed-out">Explore on Map</a>
                    </div>
                </div>
            </div>
        <?php
        endforeach;
        ?>
    </div>
</div>

<script>
    // Function to filter cards based on search input
    function filterCards() {
        var input, filter, cards, card, parentCol, title, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        cards = document.getElementsByClassName("card");

        // Loop through all cards, and hide those who don't match the search query
        for (i = 0; i < cards.length; i++) {
            card = cards[i];
            parentCol = card.closest('.col-lg-3'); // Find the parent col-lg-3
            title = card.querySelector(".card-title");
            txtValue = title.textContent || title.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                parentCol.style.display = ""; // Show parent col-lg-3
            } else {
                parentCol.style.display = "none"; // Hide parent col-lg-3
            }
        }
    }

    // Function to clear search input and display all results
    function clearSearch() {
        document.getElementById("searchInput").value = "";
        var cols = document.querySelectorAll(".col-lg-3");
        cols.forEach(function(col) {
            col.style.display = "";
        });
    }

    // Add event listener for button click
    document.getElementById("searchButton").addEventListener("click", filterCards);

    // Add event listener for clear button click
    document.getElementById("clearButton").addEventListener("click", clearSearch);
</script>

<?php get_footer(); ?>
