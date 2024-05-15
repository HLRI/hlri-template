<?php
/* Template Name: Archive Neighborhoods */
get_header();
echo '<div class="containerjj">';
// Query all terms from the 'neighborhood' taxonomy
$neighborhoods = get_terms( array(
    'taxonomy' => 'neighborhood',
    'hide_empty' => false, // Set to true if you want to hide empty neighborhoods
) );

// Loop through each neighborhood
foreach ( $neighborhoods as $neighborhood ) {
//    $thumbnail_id = get_term_meta( $neighborhood->term_id, 'thumbnail', true ); // Assuming 'thumbnail' is the meta key for the thumbnail image
    // Output the neighborhood name and its thumbnail image if available
    echo '<a href="https://condoy.com/neighborhood/' . $neighborhood->slug . '">' . $neighborhood->name . '</a>';
}
echo '</div>';

get_footer();
?>