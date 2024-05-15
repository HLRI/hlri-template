<?php
/* Template Name: Archive Neighborhoods */
get_header();
echo '<div class="container">';
// Query all terms from the 'neighborhood' taxonomy
$neighborhoods = get_terms( array(
    'taxonomy' => 'neighborhood',
    'hide_empty' => false, // Set to true if you want to hide empty neighborhoods
) );

// Loop through each neighborhood
foreach ( $neighborhoods as $neighborhood ) {
//    $thumbnail_id = get_term_meta( $neighborhood->term_id, 'thumbnail', true ); // Assuming 'thumbnail' is the meta key for the thumbnail image

    // Output the neighborhood name and its thumbnail image if available
    echo '<div class="neighborhood">';
    echo '<h3>' . $neighborhood->name . '</h3>';

//    if ( $thumbnail_id ) {
//        $thumbnail_url = wp_get_attachment_image_src( $thumbnail_id, 'thumbnail' ); // Change 'thumbnail' to your desired image size
//        echo '<img src="' . $thumbnail_url[0] . '" alt="' . $neighborhood->name . ' Thumbnail">';
//    }

    echo '</div>';
}
echo '</div>';

get_footer();
?>
