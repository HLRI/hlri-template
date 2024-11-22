<?php
/* Template Name: Archive Tags */
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
        padding: .375rem .6rem;
    }
    .btn-grayed-out {
        background-color: #c9c9c9;
        color: grey;
        border-color: #c9c9c9;
    }
    .btn-grayed-out:hover {
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
    .flex-btn {
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
    .top-search-bar {
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
        <h3>Property Tags</h3>
        <h2 class="font-weight-bold">Click a tag to explore properties</h2>
    </div>
</div>
<div class="container my-5">
    <div class="top-search-bar">
        <input type="search" id="searchInput" class="flex-input" placeholder="Search...">
        <button id="searchButton" class="btn btn-submit-flex flex-btn">Search</button>
        <button id="clearButton" class="btn btn-submit-flex flex-btn">Clear</button>
    </div>
    <div class="row" id="searchResults">
        <!-- Search results will dynamically appear here -->
    </div>
    <div class="row">
        <?php
        // Query all terms from the 'tag' taxonomy
        $tags = get_terms([
            'taxonomy'   => 'tag',
            'hide_empty' => false, // Set to true to hide tags with no properties
        ]);

        // Loop through each tag
        foreach ($tags as $tag) :
            $tag_id = $tag->term_id;
            $meta = get_term_meta($tag_id, 'tag_options', true);

            // Query the number of properties for each tag
            $property_count_query = new WP_Query([
                'post_type'      => 'property',
                'posts_per_page' => -1,
                'tax_query'      => [
                    [
                        'taxonomy' => 'tag',
                        'field'    => 'term_id',
                        'terms'    => $tag_id,
                    ],
                ],
            ]);
            $property_count = $property_count_query->found_posts;
            ?>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card mb-4">
                    <a href="<?= get_term_link($tag); ?>">
                        <?php if (isset($meta['opt-tag-image']) && !empty($meta['opt-tag-image']['url'])) : ?>
                            <img loading="lazy" src="<?= $meta['opt-tag-image']['url'] ?>" class="card-img-top" alt="<?= isset($meta['opt-tag-image']['alt']) ? $meta['opt-tag-image']['alt'] : $tag->name ?>">
                        <?php else : ?>
                            <img loading="lazy" src="<?= HLR_THEME_ASSETS . 'images/No-Image-Placeholder.jpg' ?>" class="card-img-top" alt="Placeholder Image">
                        <?php endif; ?>
                    </a>
                    <div class="card-body">
                        <h6 class="card-title"><?= $tag->name ?></h6>
                        <a href="<?= get_term_link($tag); ?>" title="All listings in <?= $tag->name ?>" class="btn btn-primary"><?= $property_count ?> Listings</a>
                        <a title="This option will be available soon" class="btn btn-primary btn-grayed-out">Explore on Map</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
    function filterCards() {
        var input, filter, cards, card, parentCol, title, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        cards = document.getElementsByClassName("card");

        for (i = 0; i < cards.length; i++) {
            card = cards[i];
            parentCol = card.closest('.col-lg-3');
            title = card.querySelector(".card-title");
            txtValue = title.textContent || title.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                parentCol.style.display = "";
            } else {
                parentCol.style.display = "none";
            }
        }
    }

    function clearSearch() {
        document.getElementById("searchInput").value = "";
        var cols = document.querySelectorAll(".col-lg-3");
        cols.forEach(function(col) {
            col.style.display = "";
        });
    }

    document.getElementById("searchButton").addEventListener("click", filterCards);
    document.getElementById("clearButton").addEventListener("click", clearSearch);
</script>

<?php get_footer(); ?>
